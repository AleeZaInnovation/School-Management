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
	<title>Mark Sheet Report </title>
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
					<h5><strong><u><i>Academic Transcript</i></u> </strong></h5>
					<h6><strong>{{$allmarks['0']['exam_type']['name']}}</strong></h6>
                </td>
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Mark Sheet Report  </strong></h4></td>
		</tr>
	</tbody>
</table>
<div class="col-md-12 " style="text-align: center;">

</div>
<br>
<div id="container">
	<div class="row">
		<div class="column">
			<table width="100%" border="1" style="text-align: center;" cellpadding="6" cellspacing="2">
				<thead style="background:#cdced2;">
					<tr>
						<th>Particular </th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>
						<tr>
							<td style="text-align: left;"> ID No </td>
							<td style="text-align: right;">{{$allmarks['0']['id_no']}}</td>
						</tr>
						<tr>
							<td style="text-align: left;"> Roll No </td>
							<td style="text-align: right;">{{$assign_student['roll']}}</td>
						</tr>
						<tr>
							<td style="text-align: left;"> Name </td>
							<td style="text-align: right;">{{$allmarks['0']['student']['name']}}</td>
						</tr>
						<tr>
							<td style="text-align: left;"> Class </td>
							<td style="text-align: right;">{{$allmarks['0']['student_class']['name']}}</td>
						</tr>
						<tr>
							<td style="text-align: left;"> Session </td>
							<td style="text-align: right;">{{$allmarks['0']['year']['name']}}</td>
						</tr>
											
				</tbody>
			</table>
		</div>
		<div class="column">
			<table width="100%" border="1" style="text-align: center;">
				<thead style="background:#cdced2;">
					<tr>
						<th>Letter Grade </th>
						<th>Marks Interval</th>
						<th>Grade Point</th>
					</tr>
				</thead>
				<tbody>
					@foreach($allgreades as $item)
						<tr>
							<td style="text-align: left;">{{$item->grade_name}} </td>
							<td style="text-align: center;">{{$item->start_marks}} - {{$item->end_marks}} </td>
							<td style="text-align: center;">{{number_format((float)$item->start_point,2)}} - {{number_format((float)$item->end_point,2)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12 " style="text-align: center;">
	        <table width="100%" border="1" style="text-align: center;" cellpadding="1" cellspacing="1">
				<thead style="background:#cdced2;">
					<tr>
						<th>SL No </th>
						<th>Subjects</th>
						<th>Full Marks</th>
						<th>Get Marks</th>
						<th>Letter Grade</th>
						<th>Grade Point</th>
					</tr>
				</thead>
				<tbody>
						@php 
							$total_marks = 0;
							$total_point = 0;
						@endphp
						@foreach($allmarks as $key => $item)
							@php 
							 $get_marks = $item->marks;
							 $total_marks = (float)$total_marks + (float)$get_marks;
							 $total_subject = App\Model\StudentMarks::where('year_id',$item->year_id)->where('class_id',$item->class_id)->where('exam_type_id',$item->exam_type_id)->where('student_id',$item->student_id)->get()->count();
							 
							@endphp
								<tr>
									<td style="text-align: center;"> {{$key+1}} </td>
									<td style="text-align: center;">{{$item['assign_subject']['subject']['name']}}</td>
									<td style="text-align: center;">{{$item['assign_subject']['full_mark']}}</td>
									<td style="text-align: center;">{{$get_marks}}</td>
							@php
								$grade_marks = App\Model\MarksGrade::where([['start_marks','<=', (int)$get_marks],['end_marks','>=', (int)$get_marks]])->first();
								$grade_name = $grade_marks->grade_name;
								$grade_point = number_format((float)$grade_marks->grade_point,2);
								$total_point = (float)$total_point + (float)$grade_point;
							@endphp
									<td style="text-align: center;">{{$grade_name}}</td>
									<td style="text-align: center;">{{$grade_point}}</td>
								</tr>
						@endforeach	
						<tr>
							<td colspan="3"><strong style="padding-left: 30px;">Total Marks</strong></td>
							<td colspan="3" style="padding-left: 37px;"><strong >{{$total_marks}}</strong></td>
						</tr>										
				</tbody>
			</table>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12 " style="text-align: center;">
	        <table width="100%" border="1" style="text-align: center;" cellpadding="1" cellspacing="1">
				<tbody>
							@php 
							$total_grade= 0;
							$point_for_letter_grade = (float)$total_point/(float)$total_subject;
							$total_grade= App\Model\MarksGrade::where([['start_point','<=', $point_for_letter_grade],['end_point','>=', $point_for_letter_grade]])->first();
							$grade_point_avg = (float)$total_point/(float)$total_subject;				 
							@endphp
								<tr>
									<td width="50%"> Grade Point Average </td>
									<td width="50%"> 
									@if($count_fail>0)
									0.00
									@else
									{{number_format((float)$grade_point_avg,2)}}
									@endif</td>
								</tr>
								<tr>
									<td width="50%"> Letter Grade </td>
									<td width="50%"> 
									@if($count_fail>0)
									F
									@else
									{{$total_grade->grade_name}}
									@endif
									</td>
								</tr>

						<tr>
							<td width="50%">Total Marks With Fraction</strong></td>
							<td width="50%"><strong >{{$total_marks}}</strong></td>
						</tr>										
				</tbody>
			</table>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12 " style="text-align: left;">
	        <table width="100%" border="1"  cellpadding="10" cellspacing="2">
				<tbody>
					<tr>
						<td width="50%"> <strong> Remarks:</strong>

						@if($count_fail>0)
						Fail
						@else
						{{$total_grade->remarks}}
						@endif
						</td>
					</tr>									
				</tbody>
			</table>
	</div>
</div>

<br>
<br>
<table border="0" width="100%">
	<tbody>
		<tr>
			<td style="width: 30%; text-align: center;">
			<hr style="width: 40%; border: solid 1px; color: #000; margin-bottom: -3px;">
             Teacher </td>
            <td style="width: 30%; text-align: center;">
			<hr style="width: 40%; border: solid 1px; color: #000; margin-bottom: -3px;">
            Guardian</td>
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