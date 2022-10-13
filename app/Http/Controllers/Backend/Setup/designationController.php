<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Designation;
use App\Model\Subject;
use DB;


class designationController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = Designation::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.designation.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.designation.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:designations,name',
          ]);
        
       $data = new Designation;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.designation.view')->with('success', 'Subject Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = Designation::find($id);
        return view('backend.layouts.setup.designation.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = Designation::find($id);
        $request->validate([
            'name'    => 'required|unique:designations,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.designation.view')->with('success', 'Subject Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.designation.view')->with('success', 'Student Class Deleted Successfully');

    }
}
