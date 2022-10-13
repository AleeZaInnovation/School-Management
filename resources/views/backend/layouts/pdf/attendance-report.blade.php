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
	<title>Employee Attendace Report </title>
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
                <td   style="text-align: center;"><img width="50" src=" {{(!empty($details['0']['user']['image']))?url('public/assets/backend/images/employee/'.$details['0']['user']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 90px; height: 90px; border:1px solid #000;"></td>
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Employee Attendace Report  </strong></h4></td>
		</tr>
	</tbody>
</table>
<div class="col-md-12 " style="text-align: center;">
    <strong>Employee Name :</strong>{{ $details['0']['user']['name']}} || <strong>Employee ID No :</strong>{{ $details['0']['user']['id_no']}} || <strong>Month :</strong>{{ $month}}
</div>
<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>Date </th>
           <th>Attendace Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($details as $item)
            <tr>
                <td style="text-align: left;">{{date('d-m-Y',strtotime($item->date))}}  </td>
                <td style="text-align: left;">{{ $item->attend_status}}</td>
            </tr>
        @endforeach
    <tr>
    	<td colspan="2" style="text-align: center;" >  
        <strong>Total Absent :</strong>{{ $absent}} || <strong>Total Leave :</strong>{{ $leave}}
        </td>
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
<br>
<br/>



</body>
</html>