<?php

namespace App\Http\Controllers;

use App\Events\NotificationStudent;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function getNotifactionStudent()
    {
        $absents = Student::where('status', 'absent')->count();
        $presents = Student::where('status', 'present')->count();
        $studentStatus = Student::all()->pluck('status', 'id');
        $student = User::find(Auth::id());

        return compact('absents', 'presents', 'student', 'studentStatus');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absents = Student::where('status', 'absent')->count();
        $presents = Student::where('status', 'present')->count();
        $students = Student::all();

        $notificationStudent = $this->getNotifactionStudent();
        event(new NotificationStudent(...array_values($notificationStudent)));

        return view('students.student', ['students' => $students, 'absents' => $absents, 'presents' => $presents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function status($id)
    {
        $decryptedId = decrypt($id);
        $studentStatus = Student::find($decryptedId);

        $studentStatus->status = request()->status === 'present' ? 'absent' : 'present';
        // if(request()->status == 'present'){
        //     $student->status = 'absent';
        // }
        // if(request()->status == 'absent'){
        //     $student->status = 'present';
        // }

        $studentStatus->save();

        $notificationStudent = $this->getNotifactionStudent();
        event(new NotificationStudent(...array_values($notificationStudent)));

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decryptedId = decrypt($id);
        $student = Student::find($decryptedId);

        return view('students.student-form', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $updateStudentRequest, $id)
    {
        $decryptedId = decrypt($id);
        $validatedUpdateStudent = $updateStudentRequest->validated();

        $student = Student::find($decryptedId);
        $student->update($validatedUpdateStudent);
        $student->save();

        return redirect()->route('students');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
