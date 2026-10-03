<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject_name', 'score'];

    // Một con điểm thuộc về một sinh viên
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
