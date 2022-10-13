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
	<title>Student Details</title>
</head>
<body>

<div class="col-md-12">
    <table width="80%">
            <tr>
                <td width="33%" class="text-center"><img width="50" src=" {{url('public/assets/backend/school_logo.jpeg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
                <td  style="text-align: center;" width="63%" >
                    <h4><strong>Abc School</strong></h4>
                    <h4><strong>Lamabazar, Sylhet</strong></h4>
                    <h4><strong>www.aleezainnovation.com</strong></h4>
                </td>
                <td   style="text-align: center;"><img width="50" src=" {{(!empty($details['student']['image']))?url('public/assets/backend/images/student/'.$details['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 10px 0px; font-size: 20px;"><h4><strong> Student Registraion Card</strong></h4></td>
		</tr>
	</tbody>
</table>
<hr>
<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>Particular </th>
           <th>Details</th>
        </tr>
    </thead>
    <tbody>
 
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
    	<td style="text-align: left;"> Year </td>
    	<td style="text-align: left;">{{ $details['year']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Class </td>
    	<td style="text-align: left;">{{ $details['student_class']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Id No </td>
    	<td style="text-align: left;">{{ $details['student']['id_no']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Roll </td>
    	<td style="text-align: left;">{{ $details->roll}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Mobile No </td>
    	<td style="text-align: left;">{{ $details['student']['mobile']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Address </td>
    	<td style="text-align: left;">{{ $details['student']['address']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Gender </td>
    	<td style="text-align: left;">{{ $details['student']['gender']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Religion </td>
    	<td style="text-align: left;">{{ $details['student']['religion']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Date of Birth </td>
    	<td style="text-align: left;">{{ $details['student']['dob']}}</td>
    </tr>

    </tbody>
</table>
<div class="footer">
<hr>
<table width="100%">

	<tbody>
		<tr>
			<td style="text-align: left;">Class Teacher Signature</td>
			<td style="text-align: right;">Head Master Signature</td>
		</tr>
	</tbody>
</table>

@php 
$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<br>
<strong>
	Printing Time:- {{ $date->format('F j, Y, g:i a') }}
</strong>
</div>

</body>
</html>