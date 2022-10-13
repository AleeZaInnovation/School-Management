@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(!empty(Auth::User()->image))?url('public/assets/backend/images/'.Auth::User()->image):url('public/assets/backend/no_image.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        
        <div class="info">
          <a href="#" class="d-block">{{ Auth::User()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              @if(Auth::User()->role=='Admin')
                <li class="nav-item {{($prefix=='/users')?'menu-open':''}}">
                  <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      Manage Team
                      <i class="fas fa-angle-left right"></i>
                      <span class="badge badge-info right">1</span>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('users.view')}}" class="nav-link {{($route=='users.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p> View Team</p>
                      </a>
                    </li>
                    
                  </ul>
                </li>
              @endif               

          <li class="nav-item {{($prefix=='/profile')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profile.view')}}" class="nav-link {{($route=='profile.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Your Profile </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('profile.password.view')}}" class="nav-link {{($route=='profile.password.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Change Password </p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/setups')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Setup
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('setups.student.class.view')}}" class="nav-link {{($route=='setups.student.class.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Student Class </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.year.view')}}" class="nav-link {{($route=='setups.student.year.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> View Year </p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{route('setups.student.group.view')}}" class="nav-link {{($route=='setups.student.group.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Student Group </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.shift.view')}}" class="nav-link {{($route=='setups.student.shift.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Student Shift </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.fee.category.view')}}" class="nav-link {{($route=='setups.student.fee.category.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Fee Category </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.fee.amount.view')}}" class="nav-link {{($route=='setups.student.fee.amount.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Fee Amount </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.exam.type.view')}}" class="nav-link {{($route=='setups.exam.type.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Exam Type </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.subject.view')}}" class="nav-link {{($route=='setups.subject.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Subject </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.assign.subject.view')}}" class="nav-link {{($route=='setups.assign.subject.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Assign Subject </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.designation.view')}}" class="nav-link {{($route=='setups.designation.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Designation </p>
                </a>
              </li>             
            </ul>
          </li> 
          <li class="nav-item {{($prefix=='/students')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Student
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student.reg.view')}}" class="nav-link {{($route=='student.reg.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Student Registration </p>
                </a>
              </li>              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student.roll.view')}}" class="nav-link {{($route=='student.roll.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Roll Generate </p>
                </a>
              </li>              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student.reg.fee.view')}}" class="nav-link {{($route=='student.reg.fee.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Registraion Fee </p>
                </a>
              </li>              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student.monthly.fee.view')}}" class="nav-link {{($route=='student.monthly.fee.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Monthly Fee </p>
                </a>
              </li>              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student.exam.fee.view')}}" class="nav-link {{($route=='student.exam.fee.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Exam Fee </p>
                </a>
              </li>              
            </ul>
          </li>  
          <li class="nav-item {{($prefix=='/employees')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Employee
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee.reg.view')}}" class="nav-link {{($route=='employee.reg.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Employee Registration </p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{route('employee.salary.view')}}" class="nav-link {{($route=='employee.salary.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Employee Salary </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.leave.view')}}" class="nav-link {{($route=='employee.leave.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Employee Leave </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.attend.view')}}" class="nav-link {{($route=='employee.attend.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Employee Attendance </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.monthly.salary.view')}}" class="nav-link {{($route=='employee.monthly.salary.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Monthly Salary</p>
                </a>
              </li>             
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/marks')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Marks
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('mark.add')}}" class="nav-link {{($route=='mark.add')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Marks Entry </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mark.edit')}}" class="nav-link {{($route=='mark.edit')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Marks Edit </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mark.grade.view')}}" class="nav-link {{($route=='mark.grade.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Grade Point </p>
                </a>
              </li>             
            </ul>
          </li>
          
          <li class="nav-item {{($prefix=='/accounts')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Accounts
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('accounts.student.fee.view')}}" class="nav-link {{($route=='accounts.student.fee.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Student Fee </p>
                </a>
              </li>            
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('accounts.employee.salary.view')}}" class="nav-link {{($route=='accounts.employee.salary.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Employee Salary </p>
                </a>
              </li>            
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('accounts.others.cost.view')}}" class="nav-link {{($route=='accounts.others.cost.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Other Cost </p>
                </a>
              </li>            
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/reports')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Report
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reports.profit.view')}}" class="nav-link {{($route=='reports.profit.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Profit Report </p>
                </a>
              </li>            
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reports.marksheet.view')}}" class="nav-link {{($route=='reports.marksheet.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Mark Sheet </p>
                </a>
              </li>            
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reports.attendance.view')}}" class="nav-link {{($route=='reports.attendance.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Attendance Report </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reports.result.view')}}" class="nav-link {{($route=='reports.result.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Result Report </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reports.id-card.view')}}" class="nav-link {{($route=='reports.id-card.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Student ID Card </p>
                </a>
              </li>              
            </ul>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->