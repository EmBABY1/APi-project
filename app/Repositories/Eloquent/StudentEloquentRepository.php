<?php
namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use App\Repositories\StudentRepositoryInterface;

class StudentEloquentRepository implements StudentRepositoryInterface
{
    public function getAll()
    {
        return Student::paginate(10);
    }
    public function get_student_subject()
    {
        $students = Student::with('subjects')->limit(10)->get();

        return response()->json($students);
    }

    public function create_student_subject(array $data)
    {
        // Validate the incoming data
        $validatedData = Validator::make($data, [
            'stname' => 'required|string',
            'subname' => 'required|string',
        ])->validate();

        // Find or create the Student node
        $student = Student::firstOrCreate(['name' => $validatedData['stname']]);

        // Find or create the Subject node
        $subject = Subject::firstOrCreate(['name' => $validatedData['subname']]);

        // Check if the relationship already exists
        if (!$student->subjects()->where('name', $subject->name)->exists()) {
            // Create the relationship (REGISTERED_IN)
            $student->subjects()->save($subject);
        }

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Student successfully registered in the subject.',
            'student' => $student->name,
            'subject' => $subject->name
        ], 200);
    }
    public function getById($id)
    {
        return Student::find($id);
    }

    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update($id, array $data)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update($data);
        }
        return $student;
    }

    public function delete($id)
    {
        return Student::destroy($id);
    }
}