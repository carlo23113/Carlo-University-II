<?php

namespace App\Http\Controllers;

use App\Models\newsfeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsfeedController extends Controller
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
        
        $usertype = 
        $time = 
        $post = 

        $datas = new newsfeed([
            'fullname' =>  request()->input('fullname'),
            'usertype' => request()->input('usertype'),
            'time' => request()->input('time'),
            'post' => request()->input('post')
        ]);

        $datas->save();

        return response()->json("newsfeed post");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function show(newsfeed $newsfeed)
    {
        $data = DB::select('select * from newsfeeds order by id desc');

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function edit(newsfeed $newsfeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, newsfeed $newsfeed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, newsfeed $newsfeed)
    {
        DB::table('newsfeeds')->where('id', '=',$id)->delete();

        return response()->json("newsfeed deleted");
    }
}