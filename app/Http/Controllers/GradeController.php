<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('student')->get();
        $students = Student::all();

        return view('grades.index', compact('grades', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'subject_name' => ['required', 'string', 'max:255'],
            'score' => ['required', 'decimal:0,2', 'between:0,10'],
        ]);

        Grade::create($validated);

        return redirect()->back()->with('success', 'Thêm điểm thành công!');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->back()->with('success', 'Xóa điểm thành công!');
    }
}
