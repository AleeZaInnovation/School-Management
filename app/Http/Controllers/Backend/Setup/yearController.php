<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use DB;

class yearController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = Year::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.year.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.year.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:years,name',
          ]);
        
       $data = new Year;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.student.year.view')->with('success', 'Year Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = Year::find($id);
        return view('backend.layouts.setup.year.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = Year::find($id);
        $request->validate([
            'name'    => 'required|unique:years,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.student.year.view')->with('success', 'Year Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
