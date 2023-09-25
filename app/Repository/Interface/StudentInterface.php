<?php

namespace App\Repository\Interface;

interface StudentInterface
{
    public function getAllStudents();
    public function getStudentById($StudentId);
    public function deleteStudent($StudentId);
    public function createStudent(array $StudentData);
    public function updateStudent($StudentId, array $StudentData);
    public function getAvailableStudents();

    // Add more methods as per your application needs
}
