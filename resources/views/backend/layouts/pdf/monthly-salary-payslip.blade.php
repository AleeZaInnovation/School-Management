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
	<title>Monthly Salary Pay Slip </title>
</head>
<body>
    @php 
    $date = date('Y-m',strtotime($details['0']->date));
  
        if($date != ''){
          $where[] = ['date','like',$date.'%'];
        } 
        $totalattend = App\Model\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$details['0']->employee_id)->get();
        $salary = (float)$details['0']['user']['salary'];
        $perdaysalary = (float)$salary/30;
        $absentcount=count($totalattend->where('attend_status','Absent'));
        $totalsalarydeduct = (int)$absentcount*(float)$perdaysalary;
        $totalsalary = (int)$salary-(int)$totalsalarydeduct;
    @endphp

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
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Monthly Salary Pay Slip  </strong></h4></td>
		</tr>
	</tbody>
</table>
<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>Particular </th>
           <th>Details</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    	<td style="text-align: left;">Employee Name </td>
    	<td style="text-align: left;">{{ $details['0']['user']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Basic Salary </td>
    	<td style="text-align: left;">{{ number_format($details['0']['user']['salary'],2)}} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Total Absent of This Month  </td>
    	<td style="text-align: left;">{{ $absentcount}} Days</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Month  </td>
    	<td style="text-align: left;">{{ date('M Y',strtotime($details['0']->date))}} </td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Salary for This Month </td>
    	<td style="text-align: left;">{{ number_format($totalsalary,2)}} Tk</td>
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
<br>
<br/>
<hr>
<br>
<br/>
<br>
<br/>

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
			<td width="100%" style="text-align: center; color: black;  padding: 5px 0px; font-size: 15px;"><h4><strong> Monthly Salary Pay Slip  </strong></h4></td>
		</tr>
	</tbody>
</table>
<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>Particular </th>
           <th>Details</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    	<td style="text-align: left;">Employee Name </td>
    	<td style="text-align: left;">{{ $details['0']['user']['name']}}</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Basic Salary </td>
    	<td style="text-align: left;">{{ number_format($details['0']['user']['salary'],2)}} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Total Absent of This Month  </td>
    	<td style="text-align: left;">{{ $absentcount}} Days</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Month  </td>
    	<td style="text-align: left;">{{ date('M Y',strtotime($details['0']->date))}} </td>
    </tr>
    <tr>
    	<td style="text-align: left;"> Salary for This Month </td>
    	<td style="text-align: left;">{{ number_format($totalsalary,2)}} Tk</td>
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