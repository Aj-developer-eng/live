<?php

namespace App\Repository;
use App\Models\Student;
use App\Repository\Interface\StudentInterface;

class StudentRepository implements StudentInterface
{
    public function getAllStudents()
    {
        return Student::with(['profile', 'subjects', 'fee'])->get();
    }

    public function getStudentById($StudentId)
    {
        return Student::with('profile', 'subjects', 'fee')->findOrFail($StudentId);
    }

    public function deleteStudent($StudentId)
    {
        Student::destroy($StudentId);
    }

    public function createStudent(array $StudentData)
    {
        return Student::create($StudentData);
    }

    public function updateStudent($StudentId, array $StudentData)
    {
        return Student::whereId($StudentId)->update($StudentData);
    }

    public function getAvailableStudents()
    {
        return Student::where('is_available', true);
    }
}
