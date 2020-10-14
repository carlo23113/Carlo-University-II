<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\AssignOp\Concat;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $data = new students([
           'firstname' => $request->input('firstname'),
           'middlename' => $request->input('middlename'),
           'lastname' => $request->input('lastname'),
           'year' => $request->input('year'),
           'course' => $request->input('course'),
           'valid' => 1
       ]);
       $data->save();

       return response()->json("student enrolled");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(students $students)
    {
        $data = DB::select('select * from students');

        return response()->json($data);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\students  $students
     * @return \Illuminate\Http\Response
     */

     public function filter(Request $request)
    {
        $year = $request->input('year');
        $course = $request->input('course');
            $data = students::where('year',  ($year))->where('course', $course)->get();
        
        
        return response()->json($data);
        
    }

    public function search(Request $request)
    {
        $name = $request->get('q');
        $data = students::where('firstname','like', '%'.$name.'%')->get();
        
        
        return response()->json($data);
        
    }
    public function edit(students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(students $students)
    {
        //
    }
}