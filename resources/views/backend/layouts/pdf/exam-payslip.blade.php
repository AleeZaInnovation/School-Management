<!DOCTYPE html>
<html>
<head>
	<style type ="text/css" >
   .footer{ 
       position: fixed;         
       bottom: 100px; 
       width: 100%;
   }  
</style>
	<title>Registraion Pay Slip </title>
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
                <td   style="text-align: center;"><img width="50" src=" {{(!empty($details['student']['image']))?url('public/assets/backend/images/student/'.$details['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 90px; height: 90px; border:1px solid #000;"></td>
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Monthly Pay Slip  </strong></h4></td>
		</tr>
	</tbody>
</table>
@php
    $regfee=
    App\Model\FeeAmount::where('fee_category_id','3')->where('class_id',$details->class_id)->first();
    $originalfee = $regfee->amount;
    $discount = $details['discount']['discount'];
    $discountablefee = $discount/100*$originalfee;
    $finalfee = (float)$originalfee-(float)$discountablefee;
@endphp

<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>Particular </th>
           <th>Details</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    	<td style="text-align: left;"> Id No </td>
    	<td style="text-align: left;">{{ $details['student']['id_no']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Roll </td>
    	<td style="text-align: left;">{{ $details->roll}}</td>
    </tr> 
    <tr>
    	<td style="text-align: left;">Student Name </td>
    	<td style="text-align: left;">{{ $details['student']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Father's Name </td>
    	<td style="text-align: left;">{{ $details['student']['fname']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Mothers's Name </td>
    	<td style="text-align: left;">{{ $details['student']['mname']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Session </td>
    	<td style="text-align: left;">{{ $details['year']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Class </td>
    	<td style="text-align: left;">{{ $details['student_class']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Exam Fee </td>
    	<td style="text-align: left;">{{ $regfee->amount }} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Discount Amount  </td>
    	<td style="text-align: left;">{{ $discountablefee}} TK</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Fee (This student) of {{ $exam_name}} </td>
    	<td style="text-align: left;">{{ $finalfee}} Tk</td>
    </tr>
    </tbody>
</table>
@php 
$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<i style=" font-size: 10px; float: right;"> Printing Time:- {{ $date->format('F j, Y, g:i a') }} </i>

<table border="0" width="100%">
	<tbody>
		<tr>
			<td style="width: 30%;"></td>
            <td style="width: 30%;"></td>
			<td style="width: 40%; text-align: center;">
            <hr style="width: 60%; border: solid 1px; color: #000; margin-bottom: 0px;">
            Head Master Signature
            </td>
		</tr>
	</tbody>
</table>
<hr>
<div class="col-md-12">
    <table width="80%">
            <tr>
                <td width="33%" class="text-center"><img width="50" src=" {{url('public/assets/backend/school_logo.jpeg')}}" style="width: 90px; height: 90px; border:1px solid #000;"></td>
                <td  style="text-align: center;" width="63%" >
                    <h4><strong>Abc School</strong></h4>
                    <h4><strong>Lamabazar, Sylhet</strong></h4>
                    <h4><strong>www.aleezainnovation.com</strong></h4>
                </td>
                <td   style="text-align: center;"><img width="50" src=" {{(!empty($details['student']['image']))?url('public/assets/backend/images/student/'.$details['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 90px; height: 90px; border:1px solid #000;"></td>
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Monthly Pay Slip  </strong></h4></td>
		</tr>
	</tbody>
</table>
@php
    $regfee=
    App\Model\FeeAmount::where('fee_category_id','3')->where('class_id',$details->class_id)->first();
    $originalfee = $regfee->amount;
    $discount = $details['discount']['discount'];
    $discountablefee = $discount/100*$originalfee;
    $finalfee = (float)$originalfee-(float)$discountablefee;
@endphp

<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>Particular </th>
           <th>Details</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    	<td style="text-align: left;"> Id No </td>
    	<td style="text-align: left;">{{ $details['student']['id_no']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Roll </td>
    	<td style="text-align: left;">{{ $details->roll}}</td>
    </tr> 
    <tr>
    	<td style="text-align: left;">Student Name </td>
    	<td style="text-align: left;">{{ $details['student']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Father's Name </td>
    	<td style="text-align: left;">{{ $details['student']['fname']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Mothers's Name </td>
    	<td style="text-align: left;">{{ $details['student']['mname']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Session </td>
    	<td style="text-align: left;">{{ $details['year']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Class </td>
    	<td style="text-align: left;">{{ $details['student_class']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Exam Fee </td>
    	<td style="text-align: left;">{{ $regfee->amount }} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Discount Amount  </td>
    	<td style="text-align: left;">{{ $discountablefee}} TK</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Fee (This student) of {{$exam_name}} </td>
    	<td style="text-align: left;">{{ $finalfee}} Tk</td>
    </tr>
    </tbody>
</table>
@php 
$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<i style=" font-size: 10px; float: right;"> Printing Time:- {{ $date->format('F j, Y, g:i a') }} </i>

<table border="0" width="100%">
	<tbody>
		<tr>
			<td style="width: 30%;"></td>
            <td style="width: 30%;"></td>
			<td style="width: 40%; text-align: center;">
            <hr style="width: 60%; border: solid 1px; color: #000; margin-bottom: 0px;">
            Head Master Signature
            </td>
		</tr>
	</tbody>
</table>




</body>
</html>