<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentScholarship extends Model
{
    use HasFactory;

    protected $table = 'student_scholarships';

    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function tagihan()
    {
        return $this->belongsTo(TagihanKuliah::class, 'tagihan_id');
    }
}
