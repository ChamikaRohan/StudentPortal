<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Dotenv\Exception\ValidationException;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
