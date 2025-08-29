<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Models\Mahasiswa;
use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Models\TagihanKuliah;
use App\Models\StudentScholarship;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class StudentScholarshipController extends Controller
{
    use RoleTrait;

    // List all students to select
    public function index()
    {
        $data['prefix'] = $this->setPrefix();
        $data['students'] = Mahasiswa::all();
        return view('user.finance.student-scholarships.index', $data);
    }

    // Show student's bills and scholarships
    public function show($mahasiswa_id)
    {
        $data['prefix'] = $this->setPrefix();
        $data['student'] = Mahasiswa::findOrFail($mahasiswa_id);

        // Get student's kelas proku_id and prodi_id
        $kelas = $data['student']->kelas->first();
        $proku_id = $kelas ? $kelas->proku_id : 0;
        $prodi_id = $kelas ? $kelas->pstudi_id : 0;

        // Get global bills (users_id == 0) that apply to student's proku_id or prodi_id
        $globalBills = TagihanKuliah::where('users_id', 0)
            ->where(function ($query) use ($proku_id, $prodi_id) {
                $query->where('proku_id', $proku_id)
                    ->orWhere('prodi_id', $prodi_id);
            })
            ->get();

        // Get individual bills for the student
        $individualBills = TagihanKuliah::where('users_id', $mahasiswa_id)->get();

        // Merge bills
        $bills = $globalBills->merge($individualBills);

        $scholarships = StudentScholarship::where('mahasiswa_id', $mahasiswa_id)->get();

        // Calculate discount and final amount for each bill
        foreach ($bills as $bill) {
            $scholarship = $scholarships->firstWhere('tagihan_id', $bill->id) ?? $scholarships->firstWhere('tagihan_id', null);
            $percentage = $scholarship->scholarship_percentage ?? 0;
            $discount = ($bill->price * $percentage) / 100;
            $finalAmount = $bill->price - $discount;

            $bill->discount = $discount;
            $bill->finalAmount = $finalAmount;
            $bill->scholarship_percentage = $percentage;
            $bill->scholarship_type = $scholarship->scholarship_type ?? null;
            $bill->scholarship_note = $scholarship->scholarship_note ?? null;
        }

        $data['bills'] = $bills;
        $data['scholarships'] = $scholarships;

        return view('user.finance.student-scholarships.show', $data);
    }

    // Store or update scholarship for a student and bill type
    public function store(Request $request, $mahasiswa_id)
    {
        $request->validate([
            'scholarship_percentage' => 'required|integer|min:0|max:100',
            'scholarship_type' => 'nullable|string|max:255',
            'scholarship_note' => 'nullable|string',
            'tagihan_id' => 'nullable|exists:tagihan_kuliahs,id',
        ]);

        if (is_null($request->tagihan_id)) {
            StudentScholarship::where('mahasiswa_id', $mahasiswa_id)->delete();
        }

        $scholarship = StudentScholarship::updateOrCreate(
            [
                'mahasiswa_id' => $mahasiswa_id,
                'tagihan_id' => $request->tagihan_id,
            ],
            [
                'scholarship_percentage' => $request->scholarship_percentage,
                'scholarship_type' => $request->scholarship_type,
                'scholarship_note' => $request->scholarship_note,
            ]
        );

        Alert::success('Success', 'Beasiswa berhasil disimpan.');

        return redirect()->route($this->setPrefix() . 'finance.scholarship-show', $mahasiswa_id);
    }
}
