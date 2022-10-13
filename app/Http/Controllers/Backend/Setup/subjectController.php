<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Subject;
use DB;

class subjectController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = Subject::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.subject.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.subject.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:subjects,name',
          ]);
        
       $data = new Subject;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.subject.view')->with('success', 'Subject Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = Subject::find($id);
        return view('backend.layouts.setup.subject.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = Subject::find($id);
        $request->validate([
            'name'    => 'required|unique:subjects,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.subject.view')->with('success', 'Subject Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.subject.view')->with('success', 'Student Class Deleted Successfully');

    }
}
