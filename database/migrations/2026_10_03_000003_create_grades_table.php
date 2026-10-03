<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết tới bảng students
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('subject_name'); // Tên môn học
            $table->float('score');          // Điểm số (Hệ 10)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
