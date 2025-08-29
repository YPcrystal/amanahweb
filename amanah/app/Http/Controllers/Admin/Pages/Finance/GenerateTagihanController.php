<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Helpers\RoleTrait;
use Illuminate\Support\Str;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\ProgramKuliah;
use App\Models\TagihanKuliah;
use App\Models\HistoryTagihan;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GenerateTagihanController extends Controller
{
    use RoleTrait;

    public function index(Request $request)
    {
        $data['income'] = HistoryTagihan::where('stat', 1)->whereHas('tagihan', function ($query) use ($request) {
            $query->select('price');
        })->with('tagihan')->get()->sum(function ($history) {
            return $history->tagihan->price;
        });
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['tagihan'] = TagihanKuliah::all();
        $data['history'] = HistoryTagihan::all();
        $data['mahasiswa'] = Mahasiswa::all();
        $data['prodi'] = ProgramStudi::all();
        $data['proku'] = ProgramKuliah::all();
        $data['prefix'] = $this->setPrefix();

        // dd($data);

        return view('user.finance.pages.tagihan-index', $data);
    }
    public function create(Request $request)
    {
        $data['income'] = HistoryTagihan::where('stat', 1)->whereHas('tagihan', function ($query) use ($request) {
            $query->select('price');
        })->with('tagihan')->get()->sum(function ($history) {
            return $history->tagihan->price;
        });
        $data['tagihan'] = TagihanKuliah::latest()->paginate(3);
        $data['history'] = HistoryTagihan::all();

        $kelas_id = $request->input('kelas_id', 0);
        if ($kelas_id > 0) {
            $kelas = \App\Models\Kelas::find($kelas_id);
            if ($kelas) {
                $data['mahasiswa'] = $kelas->mahasiswa()->get();
            } else {
                $data['mahasiswa'] = collect();
            }
        } else {
            $data['mahasiswa'] = Mahasiswa::all();
        }

        $data['prodi'] = ProgramStudi::all();
        $data['proku'] = ProgramKuliah::all();
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['selected_kelas_id'] = $kelas_id;

        return view('user.finance.pages.tagihan-create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'string|max:255',
            'prodi_id' => 'required_without_all:users_id,proku_id,kelas_id|nullable|integer|min:0',
            'proku_id' => 'required_without_all:users_id,prodi_id,kelas_id|nullable|integer|min:0',
            'users_id' => 'required_without_all:proku_id,prodi_id,kelas_id|nullable|integer|min:0',
            'kelas_id' => 'required_without_all:proku_id,prodi_id,users_id|nullable|integer|min:0',
        ]);

        // Menghitung jumlah nilai yang valid
        $count = count(array_filter([$request->prodi_id, $request->proku_id, $request->users_id, $request->kelas_id], function ($value) {
            return $value > 0;
        }));

        // Validasi jika hanya satu nilai yang valid
        if ($count != 1) {
            Alert::error('error', 'Hanya boleh memilih salah satu.');
            return back()->withInput();
        }

        if ($request->kelas_id > 0) {
            $kelas = Kelas::find($request->kelas_id);
            if (!$kelas) {
                Alert::error('error', 'Kelas tidak ditemukan.');
                return back()->withInput();
            }
            $mahasiswaList = $kelas->mahasiswa()->get();
            foreach ($mahasiswaList as $mahasiswa) {
                $tagihan = new TagihanKuliah;
                $tagihan->name = $request->name;
                $tagihan->price = $request->price;
                $tagihan->prodi_id = $request->prodi_id;
                $tagihan->proku_id = $request->proku_id;
                $tagihan->users_id = $mahasiswa->id;
                $tagihan->kelas_id = $request->kelas_id;
                $tagihan->author_id = Auth::user()->id;
                $tagihan->code = 'UKT-' . Str::random(8);
            }
        } else {
            $tagihan = new TagihanKuliah;
            $tagihan->name = $request->name;
            $tagihan->price = $request->price;
            $tagihan->prodi_id = $request->prodi_id;
            $tagihan->proku_id = $request->proku_id;
            $tagihan->users_id = $request->users_id;
            $tagihan->kelas_id = $request->kelas_id;
            $tagihan->author_id = Auth::user()->id;
            $tagihan->code = 'UKT-' . Str::random(8);
            $tagihan->save();
        }

        Alert::success('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'string|max:255',
            'prodi_id' => 'required_without_all:users_id,proku_id,kelas_id|nullable|integer|min:0',
            'proku_id' => 'required_without_all:users_id,prodi_id,kelas_id|nullable|integer|min:0',
            'users_id' => 'required_without_all:proku_id,prodi_id,kelas_id|nullable|integer|min:0',
            'kelas_id' => 'required_without_all:proku_id,prodi_id,users_id|nullable|integer|min:0',
        ]);

        // Menghitung jumlah nilai yang valid
        $count = count(array_filter([$request->prodi_id, $request->proku_id, $request->users_id, $request->kelas_id], function ($value) {
            return $value > 0;
        }));

        // Validasi jika hanya satu nilai yang valid
        if ($count != 1) {
            Alert::error('error', 'Hanya boleh memilih salah satu.');
            return back()->withInput();
        }

        $tagihan = TagihanKuliah::where('code', $code)->first();
        $tagihan->name = $request->name;
        $tagihan->price = $request->price;
        $tagihan->prodi_id = $request->prodi_id;
        $tagihan->proku_id = $request->proku_id;
        $tagihan->users_id = $request->users_id;
        $tagihan->kelas_id = $request->kelas_id;
        $tagihan->author_id = Auth::user()->id;
        // $tagihan->code = 'UKT-'.Str::random(8);

        $tagihan->save();

        Alert::success('success', 'Data berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {
        $tagihan = TagihanKuliah::where('code', $code)->first();
        $tagihan->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
