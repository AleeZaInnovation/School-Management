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
	<title>Student ID Card</title>
</head>
<body>
<div class="container">
    @foreach($details as $item)
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-3" style="border: 1px solid #000; margin: 0px 110px 0px 110px">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="30%" style="text-align: left;" ><img width="50" src=" {{url('public/assets/backend/school_logo.jpeg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
                            <td  style="text-align: center;" width="40%" >
                                <h4><strong>Abc School</strong></h4>
                                <h4><strong>Lamabazar, Sylhet</strong></h4>
                                <h4><strong>Student ID Card</strong></h4>
                            </td>
                            <td   style="text-align: right;" width="30%"><img width="50" src=" {{(!empty($item['student']['image']))?url('public/assets/backend/images/student/'.$item['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
                        </tr>
                        <tr>
                            <td width="45%" style="padding: 10px 3px 10px 5px; text-align: left"><p style="font-size: 16px;"><strong> Name </strong>{{$item['student']['name']}} </p></td>
                            <td width="10%" style="padding: 10px 3px 10px 5px"></td>
							<td width="45%" style="text-align: right; padding: 10px 3px 10px 5px "><p style="font-size: 16px;"><strong> ID No </strong> {{$item['student']['id_no']}} </p> </td>
                        </tr>
                        <tr>
                            <td width="40%" style="text-align: left; padding: 10px 3px 10px 5px"><p style="font-size: 16px;"><strong> Session </strong>{{$item['year']['name']}} </p></td>
                            <td width="20%" style="text-align: center; padding: 10px 3px 10px 5px"><p style="font-size: 16px;"><strong> Class </strong>{{$item['student_class']['name']}} </p></td>
							<td width="40%" style="text-align: right; padding: 10px 3px 10px 5px"><p style="font-size: 16px;"><strong> Roll </strong> {{$item['roll']}} </p> </td>
                        </tr>
                        <tr>
                            <td width="33.33%" style="padding: 10px 3px 10px 5px"></td>
                            <td width="33.33%" style="padding: 10px 3px 10px 5px"></td>
                            <td width="33.33%" style="padding: 10px 3px 10px 5px"></td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: left; padding: 10px 3px 10px 5px"><p style="font-size: 16px;"><strong> Mobile No: </strong>{{$item['student']['mobile']}} </p></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td ></td>
                            <td style="width: 45%; text-align: center;">
                            <hr style="width: 45%; border: solid 1px; color: #000; margin-bottom: 0px; margin-left: 290px;">
                            HeadMaster 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>