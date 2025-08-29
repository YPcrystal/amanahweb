<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentScholarshipsTable extends Migration
{
    public function up()
    {
        Schema::create('student_scholarships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreignId('tagihan_id')->nullable()->constrained('tagihan_kuliahs')->onDelete('cascade'); // null means applies to all bills foregnign key to tagihan_kuliahs
            $table->integer('scholarship_percentage')->default(0);
            $table->string('scholarship_type')->nullable();
            $table->text('scholarship_note')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_scholarships');
    }
}
