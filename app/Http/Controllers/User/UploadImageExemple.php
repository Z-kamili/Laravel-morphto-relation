<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UploadImageExemple extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Students = Student::get()->all();
        return view('show',compact('Students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         DB::beginTransaction();
        try{
         $i = 1;
         $Student = new Student();
         $Student->name = $request->name;
         $Student->email = $request->email;
         $Student->password = Hash::make($request->password);
         $Student->save();
         $photo = $request->file('file');
        // $name = \Str::slug($request->input('name'));
            $filename = $i . '.' . $photo->getClientOriginalExtension();
        //insert Image 
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = $Student->id;
            $Image->imageable_type = 'App\Models\Student';
            $Image->save();
            $request->file('file')->storeAs('Student', $filename,'upload_file');
            DB::commit();
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
