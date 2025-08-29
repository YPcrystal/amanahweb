<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Models\Mahasiswa;
use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Models\TagihanKuliah;
use App\Models\HistoryTagihan;
use App\Models\StudentScholarship;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    use RoleTrait;

    private function applyScholarshipDiscounts($mahasiswa_id)
    {
        $student = Mahasiswa::findOrFail($mahasiswa_id);

        // Get kelas, proku, dan prodi
        $kelas = $student->kelas->first();
        $proku_id = $kelas ? $kelas->proku_id : 0;
        $prodi_id = $kelas ? $kelas->pstudi_id : 0;

        // Tagihan Global
        $globalBills = TagihanKuliah::where('users_id', 0)
            ->where(function ($query) use ($proku_id, $prodi_id) {
                $query->where('proku_id', $proku_id)
                    ->orWhere('prodi_id', $prodi_id);
            })
            ->get();

        // Tagihan Individu
        $individualBills = TagihanKuliah::where('users_id', $mahasiswa_id)->get();

        // Gabung
        $bills = $globalBills->merge($individualBills);

        // Ambil beasiswa
        $scholarships = StudentScholarship::where('mahasiswa_id', $mahasiswa_id)->get();

        // Hitung diskon dan total
        foreach ($bills as $bill) {
            $scholarship = $scholarships->firstWhere('tagihan_id', $bill->id)
                ?? $scholarships->firstWhere('tagihan_id', null);

            $percentage = $scholarship->scholarship_percentage ?? 0;
            $discount = ($bill->price * $percentage) / 100;
            $finalAmount = $bill->price - $discount;

            $bill->discount = $discount;
            $bill->finalAmount = $finalAmount;
            $bill->scholarship_percentage = $percentage;
            $bill->scholarship_type = $scholarship->scholarship_type ?? null;
            $bill->scholarship_note = $scholarship->scholarship_note ?? null;
        }

        return [
            'student' => $student,
            'bills' => $bills,
        ];
    }

    public function index(Request $request)
    {
        $data['income'] = HistoryTagihan::where('stat', 1)->whereHas('tagihan', function ($query) use ($request) {
            $query->select('price');
        })->with('tagihan')->get()->sum(function ($history) {
            return $history->tagihan->price;
        });
        $data['tagihan'] = TagihanKuliah::all();
        $data['history'] = HistoryTagihan::where('stat', 1)->latest()->get();
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();


        return view('user.finance.pages.pembayaran-index', $data);
    }

    public function unpaidMahasantri(Request $request)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();

        $filterStatus = $request->input('filter_status', 'unpaid'); // unpaid, paid, all
        $filterType = $request->input('filter_type', null);
        $filterName = $request->input('filter_name', null);

        $students = Mahasiswa::query();

        if ($filterName) {
            $students->where('mhs_name', 'like', '%' . $filterName . '%');
        }

        $students = $students->get();

        $billsCollection = collect();

        foreach ($students as $student) {
            $result = $this->applyScholarshipDiscounts($student->id);
            $bills = $result['bills'];

            // Filter bills by type and payment status
            $filteredBills = $bills->filter(function ($bill) use ($filterType, $filterStatus, $student) {
                $matchType = true;
                $matchStatus = true;

                if ($filterType) {
                    $matchType = str_contains($bill->name, $filterType);
                }

                if ($filterStatus === 'paid') {
                    $matchStatus = HistoryTagihan::where('tagihan_code', $bill->code)
                        ->where('users_id', $student->id)
                        ->where('stat', 1)
                        ->exists();
                } elseif ($filterStatus === 'unpaid') {
                    $matchStatus = !HistoryTagihan::where('tagihan_code', $bill->code)
                        ->where('users_id', $student->id)
                        ->where('stat', 1)
                        ->exists();
                }

                return $matchType && $matchStatus;
            });

            foreach ($filteredBills as $bill) {
                // Calculate scholarship discount per student per bill
                $scholarships = StudentScholarship::where('mahasiswa_id', $student->id)->get();
                $scholarship = $scholarships->firstWhere('tagihan_id', $bill->id) ?? $scholarships->firstWhere('tagihan_id', null);
                $percentage = $scholarship->scholarship_percentage ?? 0;
                $discount = ($bill->price * $percentage) / 100;
                $finalAmount = $bill->price - $discount;

                // Clone bill object to avoid mutating original
                $billCopy = clone $bill;
                $billCopy->discount = $discount;
                $billCopy->finalAmount = $finalAmount;
                $billCopy->scholarship_percentage = $percentage;
                $billCopy->scholarship_type = $scholarship->scholarship_type ?? null;
                $billCopy->scholarship_note = $scholarship->scholarship_note ?? null;

                $isPaid = HistoryTagihan::where('tagihan_code', $bill->code)
                    ->where('users_id', $student->id)
                    ->where('stat', 1)
                    ->exists();

                $billCopy->paid = $isPaid;

                $billsCollection->push([
                    'bill' => $billCopy,
                    'student' => $student,
                ]);
            }
        }

        $data['bills'] = $billsCollection;
        unset($data['globalBills'], $data['individualBills']);
        $data['filterStatus'] = $filterStatus;
        $data['filterType'] = $filterType;
        $data['filterName'] = $filterName;

        // Fetch distinct bill types for dropdown
        $data['billTypes'] = TagihanKuliah::select('name')->distinct()->pluck('name');

        return view('user.finance.pages.unpaid-mahasantri', $data);
    }

    public function markAsPaid(Request $request, $code, $userId)
    {
        // Check if payment record already exists
        $existingPayment = HistoryTagihan::where('tagihan_code', $code)
            ->where('users_id', $userId)
            ->where('stat', 1)
            ->first();

        if ($existingPayment) {
            Alert::error('Gagal', 'Pembayaran sudah ditandai sebagai lunas.');
            return redirect()->route($this->setPrefix() . 'finance.pembayaran-unpaid-mahasantri');
        }

        // Create new payment record
        $payment = new HistoryTagihan();
        $payment->users_id = $userId;
        $payment->tagihan_code = $code;
        $payment->code = uniqid('pay_');
        $payment->desc = 'Pembayaran ditandai lunas oleh admin';
        $payment->stat = 1;
        $payment->save();

        // Create balance record
        $result = $this->applyScholarshipDiscounts($userId);
        $bills = $result['bills'];
        $bill = $bills->firstWhere('code', $code);

        $price = $bill ? $bill->finalAmount : 0;

        if ($bill) {
            $balance = new \App\Models\Balance();
            $balance->value = $price;
            $balance->type = 1; // income
            $balance->desc = 'Pembayaran tagihan oleh mahasiswa #' . $userId;
            $balance->code = uniqid('bal_');
            $balance->author_id = $userId;
            $balance->save();
        }

        Alert::success('Success', 'Pembayaran berhasil ditandai lunas.');

        return redirect()->route($this->setPrefix() . 'finance.pembayaran-unpaid-mahasantri');
    }

    public function markAsUnpaid(Request $request, $code, $userId)
    {
        // Find the payment record
        $payment = HistoryTagihan::where('tagihan_code', $code)
            ->where('users_id', $userId)
            ->where('stat', 1)
            ->first();

        if (!$payment) {
            return redirect()->route($this->setPrefix() . 'finance.pembayaran-unpaid-mahasantri')->with('error', 'Pembayaran belum ditandai lunas.');
        }

        // Delete the payment record or mark as unpaid
        $payment->delete();

        // Delete or adjust the balance record
        $result = $this->applyScholarshipDiscounts($userId);
        $bills = $result['bills'];
        $bill = $bills->firstWhere('code', $code);

        $price = $bill ? $bill->finalAmount : 0;

        $balance = \App\Models\Balance::where('desc', 'Pembayaran tagihan oleh mahasiswa #' . $userId)
            ->where('value', $price)
            ->first();

        if ($balance) {
            $balance->delete();
        }

        Alert::success('Success', 'Pembayaran berhasil dikembalikan menjadi belum lunas.');

        return redirect()->route($this->setPrefix() . 'finance.pembayaran-unpaid-mahasantri');
    }
}
