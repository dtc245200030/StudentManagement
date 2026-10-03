<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->unique(); // Mã SV (VD: SV001)
            $table->string('fullname');              // Họ tên
            // Khóa ngoại liên kết tới bảng student_classes
            $table->foreignId('class_id')->constrained('student_classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
