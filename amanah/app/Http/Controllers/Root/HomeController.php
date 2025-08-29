<?php

namespace App\Http\Controllers\Root;

use App\Models\Fakultas;
use App\Models\NewsPost;
use App\Models\KotakSaran;
use App\Models\DocsResource;
use App\Models\GalleryAlbum;
use App\Models\Notification;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\ProgramKuliah;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\SiteManage;

class HomeController extends Controller
{
    private function setPrefix()
    {
        if (Auth::user()) {
            $rawType = Auth::user()->raw_type;
            switch ($rawType) {
                case 1:
                    return 'finance.';
                case 2:
                    return 'absen.';
                case 3:
                    return 'academic.';
                case 4:
                    return 'musyrif.';
                case 5:
                    return 'support.';
                case 6:
                    return 'sitemanager.';
                default:
                    return 'web-admin.';
            }
        }
        return '';
    }

    public function kurikulumIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['album'] = GalleryAlbum::where('is_public', 1)->latest()->paginate(3);
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Halaman Utama";
        
        return view('root.pages.kurikulum-index', $data);
    }

    public function tentangKamiIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['album'] = GalleryAlbum::where('is_public', 1)->latest()->paginate(3);
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Halaman Utama";
        
        return view('root.pages.tentang-kami', $data);
    }

    public function designIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['album'] = GalleryAlbum::where('is_public', 1)->latest()->paginate(3);
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Halaman Utama";
        
        return view('root.pages.kompetensi-design', $data);
    }

    public function kompetensiIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['album'] = GalleryAlbum::where('is_public', 1)->latest()->paginate(3);
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Halaman Utama";
        
        return view('root.pages.kompetensi-prog', $data);
    }

    public function index()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['album'] = GalleryAlbum::where('is_public', 1)->latest()->paginate(3);
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Halaman Utama";
        
        return view('root.root-index', $data);
    }

    public function galleryIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        // $data['album'] = GalleryAlbum::where('slug', $slug)->first();
        $data['albums'] = GalleryAlbum::where('is_public', true)->latest()->paginate(24);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Daftar Album Foto ";
        return view('root.pages.gallery-index', $data);
    }

    public function gallerySearch(Request $request)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        // $data['album'] = GalleryAlbum::where('slug', $slug)->first();
        $search = $request->input('search');
        $albums = GalleryAlbum::where('is_public', true)->where('name', 'like', "%$search%")->paginate(24);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Daftar Album Foto ";
        return view('root.pages.gallery-index', compact('albums'), $data);
    }

    public function galleryShow($slug)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['album'] = GalleryAlbum::where('is_public', true)->where('slug', $slug)->first();
        $data['albums'] = GalleryAlbum::where('is_public', true)->latest()->paginate(7);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Lihat Album " . $data['album']->name;
        
        return view('root.pages.gallery-view', $data);
    }

    public function newsIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(10);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Semua Berita";

        return view('root.pages.news-index', $data);
    }

    public function postView($slug)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['post'] = NewsPost::where('slug', $slug)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC";
        $data['menu'] = "Lihat Postingan " . $data['post']->name;
        
        return view('root.pages.news-view', $data);
    }

    public function newsAll()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['posts'] = newsPost::with(['category', 'author'])
                               ->where('is_published', 1)
                               ->latest()
                               ->paginate(12);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - IDBC Institute";
        $data['menu'] = "Semua Berita";
        
        return view('root.pages.news-all', $data);
    }

    public function downloadIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['title'] = " - IDBC";
        $data['menu'] = "Download";
        $data['prefix'] = $this->setPrefix();
        $data['docs'] = DocsResource::orderBy('created_at', 'desc')->get();

        return view('root.pages.document-index', $data);
    }

    public function adviceIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['title'] = " - IDBC";
        $data['menu'] = "Kotak Saran";
        $data['prefix'] = $this->setPrefix();
        
        return view('root.pages.advice-index', $data);
    }

    public function prodiIndex($slug)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['pstudi'] = ProgramStudi::where('slug', $slug)->first();
        $data['title'] = " - IDBC";
        $data['menu'] = "Program Studi " . $data['pstudi']->name;
        $data['prefix'] = $this->setPrefix();
        
        return view('root.pages.prodi-index', $data);
    }

    public function prokuIndex($code)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['pstudi'] = ProgramKuliah::where('code', $code)->first();
        $data['title'] = " -IDBC";
        $data['menu'] = "Program Kuliah " . $data['pstudi']->name;
        $data['prefix'] = $this->setPrefix();

        return view('root.pages.prodi-index', $data);
    }

    public function about()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['title'] = " - IDBC Institute";
        $data['menu'] = "Tentang Kami";
        $data['prefix'] = $this->setPrefix();
        
        return view('root.pages.about', $data);
    }

    public function register()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['title'] = " - IDBC Institute";
        $data['menu'] = "Pendaftaran";
        $data['prefix'] = $this->setPrefix();
        
        return view('root.pages.register', $data);
    }

    public function adviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'desc' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek wajib diisi',
            'desc.required' => 'Pesan wajib diisi',
        ]);

        try {
            $saran = new KotakSaran;
            $saran->name = $request->name;
            $saran->email = $request->email;
            $saran->subject = $request->subject;
            $saran->desc = $request->desc;
            $saran->save();

            // Send email notification
            Mail::send('base.resource.mail-kotak-saran-admin', ['saran' => $saran], function ($message) use ($saran) {
                $message->to([
                    'admin@idbc.ac.id', // Update with actual admin email
                    'info@idbc.ac.id'   // Update with actual info email
                ]);
                $message->subject('[ SARAN ] - IDBC - ' . $saran->subject);
                $message->from('admin@internal-dev.id', 'SIAKAD PT by Internal-Dev');
            });

            Alert::success('Sukses', 'Terima kasih telah mengirimkan saran. Kami akan segera merespons pesan Anda.');
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
            return back()->withInput();
        }
    }
}
