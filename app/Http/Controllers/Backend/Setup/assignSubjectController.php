<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignSubject;
use App\Model\Subject;
use App\Model\StudentClass;
use DB;

class assignSubjectController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.assign_subject.view', $data);
    }
    //---- users Add ----//
    public function add(){
        $data['subjects'] = Subject::all();
        $data['studentclass'] = StudentClass::all();
        return view('backend.layouts.setup.assign_subject.add', $data);
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $countSubject = count($request->subject_id);
        if($countSubject !=NULL){
            for($i=0; $i < $countSubject; $i++){
                $assign_sub = new AssignSubject();
                $assign_sub->class_id = $request->class_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->subjective_mark = $request->subjective_mark[$i];
                $assign_sub->save();
                
            }
        }

       // Redirect 
      return redirect()->route('setups.assign.subject.view')->with('success', 'Subject Assign Added Successfully');

    }
    //---- users Edit ----//
    public function edit($class_id){
        //dd('ok');
        $data['edits'] = AssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        //dd($data['edits']);
        $data['subjects'] = Subject::all();
        $data['studentclass'] = StudentClass::all();
        return view('backend.layouts.setup.assign_subject.add-edit', $data);
    }
    //---- users Update ----//
    public function update($class_id, Request $request){
         // Validation 
        // update
        if($request->subject_id==NULL){
            return redirect()->back()->with('error', 'Sorry, There in no item selected!!');
        }else{
            AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();
            foreach($request->subject_id as $key => $value){
                $assign_subject_exist = AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
                if ($assign_subject_exist) {
                    $assign_sub = $assign_subject_exist;
                }else{
                    $assign_sub = new AssignSubject();
            }
                    $assign_sub->class_id = $request->class_id;
                    $assign_sub->subject_id = $request->subject_id[$key];
                    $assign_sub->full_mark = $request->full_mark[$key];
                    $assign_sub->pass_mark = $request->pass_mark[$key];
                    $assign_sub->subjective_mark = $request->subjective_mark[$key];
                    $assign_sub->save();

            }
            
        }
       return redirect()->route('setups.assign.subject.view')->with('success', 'Subject Assign Updated Successfully');
    }

    //---- users Details ----//
    public function details($class_id){
        //dd('ok');
        $data['items'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        $data['studentclass'] = StudentClass::find($class_id);
        //dd($data['feecategory'] );
        $data['subjects'] = Subject::all();
        return view('backend.layouts.setup.assign_subject.details', $data);
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
