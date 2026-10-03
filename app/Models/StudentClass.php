<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = ['class_code', 'class_name'];

    // Một lớp có nhiều sinh viên
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
