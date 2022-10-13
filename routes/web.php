<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/','Frontend\FrontenController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Users Route //
Route::group(['as'=>'users.','prefix'=>'users', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
    Route::get('/view', 'usersController@view')->name('view');
    Route::get('/add', 'usersController@add')->name('add');
    Route::post('/store', 'usersController@store')->name('store');
    Route::get('/edit/{id}', 'usersController@edit')->name('edit');
    Route::post('/update/{id}', 'usersController@update')->name('update');
    Route::get('/delete/{id}', 'usersController@delete')->name('delete');
    // password Update
    
});
// Users Profile Route //
Route::group(['as'=>'profile.','prefix'=>'profile', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
    Route::get('/view', 'profileController@view')->name('view');
    Route::get('/edit', 'profileController@edit')->name('edit');
    Route::post('/store', 'profileController@update')->name('update');
    Route::get('/password/view', 'profileController@passwordView')->name('password.view');
    Route::post('/password/update', 'profileController@passwordUpdate')->name('password.update');
});
// Setup Route //
Route::group(['as'=>'setups.','prefix'=>'setups', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
    //Student Class
    Route::get('/students/class/view', 'Setup\studentController@view')->name('student.class.view');
    Route::get('/students/class/add', 'Setup\studentController@add')->name('student.class.add');
    Route::post('/students/class/store', 'Setup\studentController@store')->name('student.class.store');
    Route::get('/students/class/edit/{id}', 'Setup\studentController@edit')->name('student.class.edit');
    Route::post('/students/class/update/{id}', 'Setup\studentController@update')->name('student.class.update');
    Route::get('/students/class/delete/{id}', 'Setup\studentController@delete')->name('student.class.delete');
    // Year
    Route::get('/students/year/view', 'Setup\yearController@view')->name('student.year.view');
    Route::get('/students/year/add', 'Setup\yearController@add')->name('student.year.add');
    Route::post('/students/year/store', 'Setup\yearController@store')->name('student.year.store');
    Route::get('/students/year/edit/{id}', 'Setup\yearController@edit')->name('student.year.edit');
    Route::post('/students/year/update/{id}', 'Setup\yearController@update')->name('student.year.update');
    Route::get('/students/year/delete/{id}', 'Setup\yearController@delete')->name('student.year.delete');

    // Student Group
    Route::get('/students/group/view', 'Setup\groupController@view')->name('student.group.view');
    Route::get('/students/group/add', 'Setup\groupController@add')->name('student.group.add');
    Route::post('/students/group/store', 'Setup\groupController@store')->name('student.group.store');
    Route::get('/students/group/edit/{id}', 'Setup\groupController@edit')->name('student.group.edit');
    Route::post('/students/group/update/{id}', 'Setup\groupController@update')->name('student.group.update');
    Route::get('/students/group/delete/{id}', 'Setup\groupController@delete')->name('student.group.delete');

    // Student Shift
    Route::get('/students/shift/view', 'Setup\shiftController@view')->name('student.shift.view');
    Route::get('/students/shift/add', 'Setup\shiftController@add')->name('student.shift.add');
    Route::post('/students/shift/store', 'Setup\shiftController@store')->name('student.shift.store');
    Route::get('/students/shift/edit/{id}', 'Setup\shiftController@edit')->name('student.shift.edit');
    Route::post('/students/shift/update/{id}', 'Setup\shiftController@update')->name('student.shift.update');
    Route::get('/students/shift/delete/{id}', 'Setup\shiftController@delete')->name('student.shift.delete');

    // Fee Category
    Route::get('/students/fee/category/view', 'Setup\feeCategoryController@view')->name('student.fee.category.view');
    Route::get('/students/fee/category/add', 'Setup\feeCategoryController@add')->name('student.fee.category.add');
    Route::post('/students/fee/category/store', 'Setup\feeCategoryController@store')->name('student.fee.category.store');
    Route::get('/students/fee/category/edit/{id}', 'Setup\feeCategoryController@edit')->name('student.fee.category.edit');
    Route::post('/students/fee/category/update/{id}', 'Setup\feeCategoryController@update')->name('student.fee.category.update');
    Route::get('/students/fee/category/delete/{id}', 'Setup\feeCategoryController@delete')->name('student.fee.category.delete');
    
    
    // Fee  Amount
    Route::get('/students/fee/amount/view', 'Setup\feeAmountController@view')->name('student.fee.amount.view');
    Route::get('/students/fee/amount/add', 'Setup\feeAmountController@add')->name('student.fee.amount.add');
    Route::post('/students/fee/amount/store', 'Setup\feeAmountController@store')->name('student.fee.amount.store');
    Route::get('/students/fee/amount/edit/{fee_category_id}', 'Setup\feeAmountController@edit')->name('student.fee.amount.edit');
    Route::post('/students/fee/amount/update/{fee_category_id}', 'Setup\feeAmountController@update')->name('student.fee.amount.update');
    Route::get('/students/fee/amount/delete/{fee_category_id}', 'Setup\feeAmountController@delete')->name('student.fee.amount.delete');
    Route::get('/students/fee/amount/details/{fee_category_id}', 'Setup\feeAmountController@details')->name('student.fee.amount.details');

     // Exam Type
     Route::get('/exam/type/view', 'Setup\examTypeController@view')->name('exam.type.view');
     Route::get('/exam/type/add', 'Setup\examTypeController@add')->name('exam.type.add');
     Route::post('/exam/type/store', 'Setup\examTypeController@store')->name('exam.type.store');
     Route::get('/exam/type/edit/{id}', 'Setup\examTypeController@edit')->name('exam.type.edit');
     Route::post('/exam/type/update/{id}', 'Setup\examTypeController@update')->name('exam.type.update');
     Route::get('/exam/type/delete/{id}', 'Setup\examTypeController@delete')->name('exam.type.delete');
    
     // Subject
     Route::get('/subject/view', 'Setup\subjectController@view')->name('subject.view');
     Route::get('/subject/add', 'Setup\subjectController@add')->name('subject.add');
     Route::post('/subject/store', 'Setup\subjectController@store')->name('subject.store');
     Route::get('/subject/edit/{id}', 'Setup\subjectController@edit')->name('subject.edit');
     Route::post('/subject/update/{id}', 'Setup\subjectController@update')->name('subject.update');
     Route::get('/subject/delete/{id}', 'Setup\subjectController@delete')->name('subject.delete');

     // Assign Subject
     Route::get('/assign/subject/view', 'Setup\assignSubjectController@view')->name('assign.subject.view');
     Route::get('/assign/subject/add', 'Setup\assignSubjectController@add')->name('assign.subject.add');
     Route::post('/assign/subject/store', 'Setup\assignSubjectController@store')->name('assign.subject.store');
     Route::get('/assign/subject/edit/{class_id}', 'Setup\assignSubjectController@edit')->name('assign.subject.edit');
     Route::post('/assign/subject/update/{class_id}', 'Setup\assignSubjectController@update')->name('assign.subject.update');
     Route::get('/assign/subject/delete/{class_id}', 'Setup\assignSubjectController@delete')->name('assign.subject.delete');
     Route::get('/assign/subject/details/{class_id}', 'Setup\assignSubjectController@details')->name('assign.subject.details');

     // Designation
     Route::get('/designation/view', 'Setup\designationController@view')->name('designation.view');
     Route::get('/designation/add', 'Setup\designationController@add')->name('designation.add');
     Route::post('/designation/store', 'Setup\designationController@store')->name('designation.store');
     Route::get('/designation/edit/{id}', 'Setup\designationController@edit')->name('designation.edit');
     Route::post('/designation/update/{id}', 'Setup\designationController@update')->name('designation.update');
     Route::get('/designation/delete/{id}', 'Setup\designationController@delete')->name('designation.delete');

    
});

// Student Route //
Route::group(['as'=>'student.','prefix'=>'students', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
      // Student Registration //
    Route::get('/reg/view', 'Student\RegController@view')->name('reg.view');
    Route::get('/reg/add', 'Student\RegController@add')->name('reg.add');
    Route::post('/reg/store', 'Student\RegController@store')->name('reg.store');
    Route::get('/reg/edit/{student_id}', 'Student\RegController@edit')->name('reg.edit');
    Route::post('/reg/update/{student_id}', 'Student\RegController@update')->name('reg.update');
    Route::get('/reg/delete/{id}', 'Student\RegController@delete')->name('reg.delete');
    Route::get('/year-class-wise', 'Student\RegController@yearClassWise')->name('year.class');
    Route::get('/reg/promotion/{id}', 'Student\RegController@promotion')->name('reg.promotion');
    Route::post('/reg/promotion/store/{student_id}', 'Student\RegController@promotionStore')->name('reg.promotion.store');

    Route::get('/reg/details/{student_id}', 'Student\RegController@details')->name('reg.details');

    // Student Roll Generate
    Route::get('/roll/view', 'Student\RollController@view')->name('roll.view');
    Route::get('/reg/get', 'Student\RollController@getStudent')->name('reg.get');
    Route::post('/roll/store', 'Student\RollController@store')->name('roll.store');

    // Student Registraion Fee
    Route::get('/reg/fee/view', 'Student\RegFeeController@view')->name('reg.fee.view');
    Route::get('/reg/fee/get', 'Student\RegFeeController@getRegFee')->name('reg.fee.get');
    Route::get('/reg/fee/payslip', 'Student\RegFeeController@regFeePayslip')->name('reg.fee.payslip');
   
    // Student Registraion Fee
    Route::get('/monthly/fee/view', 'Student\MonthlyFeeController@view')->name('monthly.fee.view');
    Route::get('/monthly/fee/get', 'Student\MonthlyFeeController@getMonthlyFee')->name('monthly.fee.get');
    Route::get('/monthly/fee/payslip', 'Student\MonthlyFeeController@monthlyFeePayslip')->name('monthly.fee.payslip');
   
    // Student Registraion Fee
    Route::get('/exam/fee/view', 'Student\ExamFeeController@view')->name('exam.fee.view');
    Route::get('/exam/fee/get', 'Student\ExamFeeController@getExamFee')->name('exam.fee.get');
    Route::get('/exam/fee/payslip', 'Student\ExamFeeController@examFeePayslip')->name('exam.fee.payslip');
    // password Update
    
});

// Employee Route //
Route::group(['as'=>'employee.','prefix'=>'employees', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
      // Employee Registration //
    Route::get('/reg/view', 'Employee\RegController@view')->name('reg.view');
    Route::get('/reg/add', 'Employee\RegController@add')->name('reg.add');
    Route::post('/reg/store', 'Employee\RegController@store')->name('reg.store');
    Route::get('/reg/edit/{id}', 'Employee\RegController@edit')->name('reg.edit');
    Route::get('/reg/details/{id}', 'Employee\RegController@details')->name('reg.details');
    Route::post('/reg/update/{id}', 'Employee\RegController@update')->name('reg.update');
    
    // Employee Salary //
    Route::get('/salary/view', 'Employee\SalaryController@view')->name('salary.view');
    Route::get('/salary/increment/{id}', 'Employee\SalaryController@increment')->name('salary.increment');
    Route::get('/salary/details/{id}', 'Employee\SalaryController@details')->name('salary.details');
    Route::post('/salary/store/{id}', 'Employee\SalaryController@store')->name('salary.store');
    
      // Employee Leave //
      Route::get('/leave/view', 'Employee\LeaveController@view')->name('leave.view');
      Route::get('/leave/add', 'Employee\LeaveController@add')->name('leave.add');
      Route::post('/leave/store', 'Employee\LeaveController@store')->name('leave.store');
      Route::get('/leave/edit/{id}', 'Employee\LeaveController@edit')->name('leave.edit');
      Route::post('/leave/update/{id}', 'Employee\LeaveController@update')->name('leave.update');
      Route::get('/leave/details/{id}', 'Employee\LeaveController@details')->name('leave.details');

      // Employee Attendance //
      Route::get('/attend/view', 'Employee\AttendController@view')->name('attend.view');
      Route::get('/attend/add', 'Employee\AttendController@add')->name('attend.add');
      Route::post('/attend/store', 'Employee\AttendController@store')->name('attend.store');
      Route::get('/attend/edit/{date}', 'Employee\AttendController@edit')->name('attend.edit');
      Route::get('/attend/details/{date}', 'Employee\AttendController@details')->name('attend.details');

      // Employee Monthly Salary
    Route::get('/monthly/salary/view', 'Employee\MonthlySalaryController@view')->name('monthly.salary.view');
    Route::get('/monthly/salary/get', 'Employee\MonthlySalaryController@getMonthlySalary')->name('monthly.salary.get');
    Route::get('/monthly/salary/payslip/{employee_id}', 'Employee\MonthlySalaryController@salaryPayslip')->name('monthly.salary.payslip');
});

Route::group(['as'=>'mark.','prefix'=>'marks', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
    // Marks Add and Edit
    Route::get('/view', 'Mark\MarksController@view')->name('view');
    Route::get('/add', 'Mark\MarksController@add')->name('add');
    Route::post('/store', 'Mark\MarksController@store')->name('store');
    Route::get('/edit', 'Mark\MarksController@edit')->name('edit');
    Route::get('/get-marks', 'Mark\MarksController@getMarks')->name('student.get');
    Route::post('/update', 'Mark\MarksController@update')->name('update');
    // Grade Point
    Route::get('/grade/view', 'Mark\GradeController@view')->name('grade.view');
    Route::get('/grade/add', 'Mark\GradeController@add')->name('grade.add');
    Route::post('/grade/store', 'Mark\GradeController@store')->name('grade.store');
    Route::get('/grade/edit/{id}', 'Mark\GradeController@edit')->name('grade.edit');
    Route::post('/grade/update/{id}', 'Mark\GradeController@update')->name('grade.update');
    Route::get('/grade/details/{id}', 'Mark\GradeController@details')->name('grade.details');
    
});
Route::group(['as'=>'accounts.','prefix'=>'accounts', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
    // Student Fee Account
    Route::get('/student/fee/view', 'Account\StudentFeeController@view')->name('student.fee.view');
    Route::get('/student/fee/add', 'Account\StudentFeeController@add')->name('student.fee.add');
    Route::post('/student/fee/store', 'Account\StudentFeeController@store')->name('student.fee.store');
    Route::get('/student/fee/get/student', 'Account\StudentFeeController@feeGetStudent')->name('fee.getstudent');
   // Employee Salary Account
    Route::get('/employee/salary/view', 'Account\EmployeeSalaryController@view')->name('employee.salary.view');
    Route::get('/employee/salary/add', 'Account\EmployeeSalaryController@add')->name('employee.salary.add');
    Route::post('/employee/salary/store', 'Account\EmployeeSalaryController@store')->name('employee.salary.store');
    Route::get('/employee/salary/get/employee', 'Account\EmployeeSalaryController@feeGetEmployee')->name('salary.getemployee');

    // Employee Salary Account
    Route::get('/others/cost/view', 'Account\OtherCostController@view')->name('others.cost.view');
    Route::get('/others/cost/add', 'Account\OtherCostController@add')->name('others.cost.add');
    Route::post('/others/cost/store', 'Account\OtherCostController@store')->name('others.cost.store');
    Route::get('/others/cost/edit/{id}', 'Account\OtherCostController@edit')->name('others.cost.edit');
    Route::post('/others/cost/update/{id}', 'Account\OtherCostController@update')->name('others.cost.update');
    
});

Route::group(['as'=>'reports.','prefix'=>'reports', 'namespace'=>'Backend', 'middleware'=>'test'], 
   function(){
    // Profit Report
    Route::get('/profit/view', 'Report\ProfitController@view')->name('profit.view');
    Route::get('/profit/add', 'Report\ProfitController@add')->name('profit.add');
    Route::post('/profit/store', 'Report\ProfitController@store')->name('profit.store');
    Route::get('/profit/pdf', 'Report\ProfitController@profitPdf')->name('profit.pdf');
    Route::get('/profit/get-marks', 'Report\ProfitController@profit')->name('profit.get');
    Route::post('/profit/update', 'Report\ProfitController@update')->name('profit.update');
    
    // Marks Sheet Report
    Route::get('/marksheet/view', 'Report\ProfitController@marksheetView')->name('marksheet.view');
    Route::get('/marksheet/get', 'Report\ProfitController@marksheetGet')->name('marksheet.get');
    // Attendance Report
    Route::get('/attendance/view', 'Report\ProfitController@attendanceView')->name('attendance.view');
    Route::get('/attendance/get', 'Report\ProfitController@attendanceGet')->name('attendance.get');
    // Result Report
    Route::get('/result/view', 'Report\ProfitController@resultView')->name('result.view');
    Route::get('/result/get', 'Report\ProfitController@resultGet')->name('result.get');

    // ID Card Report
    Route::get('/id-card/view', 'Report\ProfitController@idCardView')->name('id-card.view');
    Route::get('/id-card/get', 'Report\ProfitController@idCardGet')->name('id-card.get');
    
});
Route::get('/get-student', 'Backend\DefaultController@getStudent')->name('get-student');
Route::get('/get-subject', 'Backend\DefaultController@getSubject')->name('get-subject');
Auth::routes();
   