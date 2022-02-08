<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateValidationRequest;
use App\Models\Image;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $Students = Student::where('user_id',Auth::user()->id)->with('user')->get()->all();
        $User = User::where('id',Auth::user()->id)->with('images')->get()->first();
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
    public function store(CreateValidationRequest $request)
    {
        
        DB::beginTransaction();

        try{
         $i = 3;
         $Student = new Student();
        //  $Student->name = $request->name;
        //  $Student->email = $request->email;
        //  $Student->password = Hash::make($request->password);
         $Student->user_id = Auth::user()->id;
         $Student->save();
         $photo = $request->file('file');
         $filename = $i . '.' . $photo->getClientOriginalExtension();
        //insert Image 
         $Image = new Image();
         $Image->filename = $filename;
         $Image->user_id = Auth::user()->id;
         $Image->save();
         $request->file('file')->storeAs('Student', $filename,'upload_file');
         $filename = 2 . '.' . $photo->getClientOriginalExtension();
         $Image = new Image();
         $Image->filename = $filename;
         $Image->user_id = Auth::user()->id;
         $Image->save();
         $request->file('file')->storeAs('Student', $filename,'upload_file');
         DB::commit();
         return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
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
