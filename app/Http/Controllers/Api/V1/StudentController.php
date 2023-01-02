<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use App\Http\Requests\V1\StoreStudentRequest;
use App\Http\Requests\V1\UpdateStudentRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StudentCollection;
use App\Http\Resources\V1\StudentResource;
use App\Traits\HttpResponses;

class StudentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Student::paginate();
        return new StudentCollection(Student::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        return new StudentResource(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
        return $this->success('', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $studentid = $student->id;
        $studentname = $student->name;
        $studentaddr = $student->address;
        $studentcourse = $student->course;
        $student->delete();
        return $this->success([
            'message'=>'Successfully deleted',
            'id'=>$studentid,
            'name'=>$studentname,
            'address'=>$studentaddr
        ]);

    }

    public function searchByName($name){

        return new StudentCollection(Student::where('name', 'like', '%'.$name.'%')->paginate());
        //return Student::where('name', 'like', '%'.$name.'%')->get();
        

    }

    public function searchByEmail($email){
        //return Student::where('email', 'like', '%'.$email.'%')->get();
        return new StudentCollection(Student::where('email', 'like', '%'.$email.'%')->paginate());
    }
}
