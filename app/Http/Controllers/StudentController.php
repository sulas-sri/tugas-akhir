<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Repositories\SchoolClassRepository;
use App\Repositories\SchoolMajorRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository,
        private SchoolClassRepository $schoolClassRepository,
        private SchoolMajorRepository $schoolMajorRepository,
    ) {
    }

    public function index()
    {
        return view('students.index', [
            'students' => $this->studentRepository->studentsOrderBy('name')->get(),
            'school_classes' => $this->schoolClassRepository->schoolClassesOrderBy('name')->get(),
            'school_majors' => $this->schoolMajorRepository->schoolMajorsOrderBy('name')->get()
        ]);
    }

    public function store(StudentStoreRequest $request)
    {
        $this->studentRepository->store($request);

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(StudentUpdateRequest $request, Student $pelajar)
    {
        $this->studentRepository->update($request, $pelajar);

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Student $pelajar)
    {
        $this->studentRepository->findStudent($pelajar)->delete();

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil dihapus!');
    }
}
