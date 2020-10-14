<?php

namespace App\Http\Controllers;

use App\Models\announcements;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AnnouncementsController extends Controller
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
        if($request->hasFile('image')){

             $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = time().'_'.$imageName;
            $image->move(public_path('/images'), $imageName);
            $datas = new announcements([
            'announcement' => $request['text'], 
        ]);

        $datas->image = '/images/'.$imageName;
        $datas->save();
        }
        else{
        $datas = new announcements([
            'announcement' => $request['text'], 
        ]);
        $datas->save();
        }
        

        

        

        return response()->json("Success");
    }

      public function upload(Request $request)
    {
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\announcements  $announcements
     * @return \Illuminate\Http\Response
     */


    public function show(announcements $announcements)
    {
        $data = DB::select('select * from announcements order by id desc');

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function edit(announcements $announcements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, announcements $announcements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, announcements $announcements)
    {

        DB::table('announcements')->where('id','=',$id)->delete();     

        return response()->json("Announcement deleted");
    }
}