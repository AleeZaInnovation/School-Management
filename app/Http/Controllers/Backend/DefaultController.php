<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use Hash;
use App\Model\Group;
use App\Model\Shift;
use App\Model\Year;
use App\Model\StudentClass;
use App\Model\StudentMarks;
use App\Model\AssignSubject;
use App\User;
use DB;
use PDF;

class DefaultController extends Controller
{
    //
    public function getStudent(Request $request){
        //dd('ok');
        $data = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
  
        return response()->json($data);
    }

    public function getSubject(Request $request){
        //dd('ok');
        $data = AssignSubject::with(['subject'])->where('class_id',$request->class_id)->get();
  
        return response()->json($data);
    }

}
