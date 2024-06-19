<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'class' => 'required',
            'status' => 'required'
        ]);

        Student::create($request->all());

        return response()->json(['success' => 'Student added successfully.']);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return response()->json(['success' => 'Student deleted successfully.']);
    }

    public function getStudents()
    {
        $students = Student::all();

        return response()->json(['data' => $students]);
    }
}

