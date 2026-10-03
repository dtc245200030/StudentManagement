<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_code')->unique(); // Mã lớp (VD: CNTT_K61)
            $table->string('class_name');          // Tên lớp
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};
