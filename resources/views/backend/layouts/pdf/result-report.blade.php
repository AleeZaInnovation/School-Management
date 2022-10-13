<!DOCTYPE html>
<html>
<head>
<style type ="text/css" >
body{
	margin: 0;
	padding: 0;
}
#container{
	width: 900px;
	margin: 10px auto 0;
	display: table;
	box-sizing: border-box;
}

.row{
	margin: 20px 0;
}

.column{
	width: 47%;
	float: left;
	display: table-cell;

	padding: 10px;
	text-align: center;
}
</style>
	<title>Result Report </title>
</head>
<body>

<div class="col-md-12">
    
    <table width="80%">
            <tr>
                <td width="33%" class="text-center"><img width="50" src=" {{url('public/assets/backend/school_logo.jpeg')}}" style="width: 90px; height: 90px; border:1px solid #000;"></td>
                <td  style="text-align: center;" width="63%" >
                    <h4><strong>Abc School</strong></h4>
                    <h4><strong>Lamabazar, Sylhet</strong></h4>
                    <h4><strong>www.aleezainnovation.com</strong></h4>
                </td>
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Result Report of {{@$allmarks['0']['exam_type']['name']}}  </strong></h4></td>
		</tr>
	</tbody>
</table>
<div class="col-md-12 " style="text-align: center;">
	<table width="100%" border="0" style="text-align: center;">
		<tbody style="background:#cdced2;">
			<tr>
				<td> <strong>Year/Session:: </strong> {{@$allmarks['0']['year']['name']}} </td>
				<td></td>
				<td></td>
				<td> <strong>Class:: </strong> {{@$allmarks['0']['student_class']['name']}} </td>
			</tr>
		</tbody>
	</table>

</div>
<div class="row">
	<div class="col-md-12 " style="text-align: center;">
	        <table width="100%" border="1" style="text-align: center;" cellpadding="1" cellspacing="1">
				<thead style="background:#cdced2;">
					<tr>
						<th width="10%">SL No </th>
						<th>Student Name</th>
						<th>ID No</th>
						<th width="10%">Letter Grade</th>
						<th width="10%">Grade Point</th>
						<th width="15%">Remarks</th>
					</tr>
				</thead>
				<tbody>
						@foreach($allmarks as $key=>$item)
						    @php
							 $totalMarks = App\Model\StudentMarks::where('year_id',$item->year_id)->where('class_id',$item->class_id)->where('exam_type_id',$item->exam_type_id)->where('student_id',$item->student_id)->get();
							 $total_marks = 0;
							 $total_point = 0;
							  foreach($totalMarks as $value){
							  $count_fail= App\Model\StudentMarks::where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->where('marks','<','33')->get()->count();
							  $get_marks = $value->marks;
							  $grade_marks = App\Model\MarksGrade::where([['start_marks','<=', (int)$get_marks],['end_marks','>=', (int)$get_marks]])->first();
							  $grade_name = $grade_marks->grade_name;
							  $grade_point = number_format((float)$grade_marks->grade_point,2);
							  $total_point = (float)$total_point + (float)$grade_point; 
							  }
							@endphp
						<tr>
							<td style="text-align: center;"> {{$key+1}} </td>
							<td style="text-align: center;">{{$item['student']['name']}}</td>
							<td style="text-align: center;">{{$item['student']['id_no']}}</td>
							@php 
							$total_grade= 0;
							$total_subject = App\Model\StudentMarks::where('year_id',$item->year_id)->where('class_id',$item->class_id)->where('exam_type_id',$item->exam_type_id)->where('student_id',$item->student_id)->get()->count();
							$point_for_letter_grade = (float)$total_point/(float)$total_subject;
							$total_grade= App\Model\MarksGrade::where([['start_point','<=', $point_for_letter_grade],['end_point','>=', $point_for_letter_grade]])->first();
							$grade_point_avg = (float)$total_point/(float)$total_subject;				 
							@endphp
							<td > 
							@if($count_fail>0)
							F
							@else
							{{$total_grade->grade_name}}
							@endif</td>
							<td > 
							@if($count_fail>0)
							0.00
							@else
							{{number_format((float)$grade_point_avg,2)}}
							@endif</td>
							<td > 
							@if($count_fail>0)
							Fail
							@else
							{{$total_grade->remarks}}
							@endif
							</td>
									
						</tr>
						@endforeach										
				</tbody>
			</table>
	</div>
</div>
<br>


<br>
<br>
<table border="0" width="100%">
	<tbody>
		<tr>
			<td style="width: 30%; text-align: center;">
			<hr style="width: 40%; border: solid 1px; color: #000; margin-bottom: -3px;">
             Teacher </td>
            <td style="width: 30%;"></td>
			<td style="width: 40%; text-align: center;">
            <hr style="width: 40%; border: solid 1px; color: #000; margin-bottom: -3px;">
            HeadMaster 
            </td>
		</tr>
	</tbody>
</table>
<br>
<br/>
@php 
$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<i style=" font-size: 10px; float: right;"> Printing Time:- {{ $date->format('F j, Y, g:i a') }} </i>



</body>
</html>