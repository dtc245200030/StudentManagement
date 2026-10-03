<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['student_code', 'fullname', 'class_id'];

    // Một sinh viên thuộc về một lớp
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    // Một sinh viên có nhiều điểm số
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
