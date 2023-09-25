<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Repository\Interface\StudentInterface;

class StudentController extends Controller
{
    private $StudentRepository;

    public function __construct(StudentInterface $StudentRepository)
    {
        $this->StudentRepository = $StudentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json([
            'data' => $this->StudentRepository->getAllStudents(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {

// dd('dd');
        return response()->json(
            [
                'data' => $this->StudentRepository->createStudent($request->validated()),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($student)
    {
        // dd($student);
        return response()->json([
            'data' => $this->StudentRepository->getStudentById($student),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request,  $student)
    {

        return response()->json([
            'data' => $this->StudentRepository->updateStudent($student, $request->validated()),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($student)
    {
        $this->StudentRepository->deleteStudent($student);

        return response(['message' => 'Resource deleted successfully'], 200);
    }
}
