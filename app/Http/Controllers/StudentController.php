<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json("works", 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|numeric',
                'gender' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students,email',
                'pnumber' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
            ]);
    
            $student = Student::create($validatedData);
    
            return response()->json([
                'message' => 'Student created successfully!',
                'student' => $student,
            ], 201);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Student creation unsuccessfull!', "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try
        {
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'age' => 'sometimes|required|numeric',
                'gender' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:students,email',
                'pnumber' => 'sometimes|required|string|max:255',
                'address' => 'sometimes|nullable|string|max:255',
            ]);
    
            $student = Student::findOrFail($id);
            $student->update($validatedData);
            
            return response()->json([
                'message' => 'Student updated successfully!',
                'student' => $student,
            ], 200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => "Student update unsuccessfull!",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            $student = Student::findOrFail($id);

            $student -> delete();

            return response()->json([
                'message' => 'Student deleted successfully!',
                'student' => $student,
            ], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Student deletion unsuccessfull!', "error" => $e->getMessage()], 500);
        }
    }
}
