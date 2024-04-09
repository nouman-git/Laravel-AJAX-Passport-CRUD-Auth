<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    //

    public function index()
    {
        // dd(auth()->user());
        return view('students.index');

    }

    public function getData()
    {
        // dd('sad');
        // $students = Student::all(); // Retrieve all students from the database

        // dd($students);
        $students = Student::get();
        // dd($students);

        // return json_encode(array('data'=>$students));
        // return response()->json(['data' => $students]);

        // return view('students.index');

        // dd(response()->json(array('students'=> $students), 200));
        // return json_encode(array('data'=>$students));


        return response()->json(array('students'=> $students), 200);



    }


    public function store(Request $request)
{
    // Validate the request data if necessary

        // Define validation rules
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'city' => 'required|string|max:255',
            'phone' => 'required|numeric',
        ]);


    // Store the data in the database
    $student = new Student();
    $student->name = $request->input('name');
    $student->email = $request->input('email');
    $student->city = $request->input('city');
    $student->phone = $request->input('phone');
    $student->save();

    // Return a response, e.g., a success message
    return response()->json(['message' => 'Student created successfully']);
}
public function destroy($id)
{
    // dd('sada');
    // Find the student by ID
    $student = Student::findOrFail($id);

    // dd($student);

    // Delete the student record
    $student->delete();

    // Return a response, such as a success message
    return response()->json(['message' => 'Student record deleted successfully']);
}

 // Edit a student's information
 public function edit($id)
{
    // Find the student by ID
    $student = Student::findOrFail($id);

    // Return the student data as a JSON response
    return response()->json(['student' => $student]);
}

public function update(Request $request, $id)
{
    // Validate the request data (similar to the edit method)
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'city' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
    ]);

    // Find the student by ID
    $student = Student::findOrFail($id);

    // Update the student's information
    $student->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'city' => $validatedData['city'],
        'phone' => $validatedData['phone'],
    ]);

    // You can return a response or redirect to a different page
    return response()->json(['message' => 'Student updated successfully']);
}



}


