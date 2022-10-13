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
	<title>Profit Report</title>
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
            </tr>

    </table>
</div>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 10px 0px; font-size: 20px;"><h4><strong> Profit Report </strong></h4></td>
		</tr>
	</tbody>
</table>
<hr>
<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
            <td colspan="2" style="text-align: center;"><h4>Reporting Date : {{date('d M Y',strtotime($sdate))}} to {{date('d M Y',strtotime($edate))}}</h4></td>
        </tr>
        <tr>
           <th>Particular </th>
           <th>Details</th>
        </tr>
    </thead>
    <tbody>
    
    <tr>
    	<td style="text-align: left;">Student Fee </td>
    	<td style="text-align: right;">{{ number_format($student_fee,2)}} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Employee Salary </td>
    	<td style="text-align: right;">{{ number_format($employee_salary,2)}} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;">Other Costs </td>
    	<td style="text-align: right;">{{ number_format($other_cost,2)}} Tk</td>
    </tr>
    <tr>
    	<td style="text-align: left;"> <h4>Total Cost</h4> </td>
    	<td style="text-align: right;"><h4>{{ number_format($total_cost,2)}} Tk</h4></td>
    </tr>
    <tr>
    	<td style="text-align: left;"> <h4>Profit or Loss</h4> </td>
    	<td style="text-align: right;"><h4>{{ number_format($profit,2)}} Tk</h4></td>
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
            Accountant Signature
            </td>
		</tr>
	</tbody>
</table>
<hr>


</body>
</html>