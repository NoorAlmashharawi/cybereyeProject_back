@extends('cms.parent')

@section('title' , 'Index Role')

@section('main_title' , 'Index Role')

@section('sub_title' , 'index of role')


@section('styles')

<style>
    /* ========== تنسيق صفحة Index Role ========== */

/* Card Styling */
.card {
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #ffffff;
}

.card:hover {
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.card-header {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    border-bottom: none;
    padding: 25px 30px;
    position: relative;
    overflow: hidden;
}

.card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -30%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform: rotate(25deg);
}

.card-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
}

/* Search Form Styling */
form {
    margin-bottom: 0;
}

.input-icon {
    position: relative;
    margin-bottom: 0;
}

.input-icon input {
    padding: 12px 40px 12px 15px;
    border: 2px solid rgba(255, 255, 255, 0.25);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.95);
    transition: all 0.3s ease;
    font-size: 14px;
    width: 100%;
    font-weight: 500;
}

.input-icon input:focus {
    border-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
    outline: none;
    background: #ffffff;
    transform: translateY(-2px);
}

.input-icon span {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
}

.input-icon i {
    font-size: 18px;
    color: #4361ee;
    transition: all 0.3s ease;
}

.input-icon input:focus + span i {
    color: #3a0ca3;
    transform: scale(1.1);
}

/* Button Styling */
.btn {
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: 0.5px;
    border: none;
    margin-left: 8px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.5s, height 0.5s;
}

.btn:hover::before {
    width: 200px;
    height: 200px;
}

.btn-success {
    background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
    background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
}

.btn-danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
}

.btn-primary {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    background: linear-gradient(135deg, #2980b9 0%, #2471a3 100%);
}

.btn-info {
    background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3);
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26, 188, 156, 0.4);
    background: linear-gradient(135deg, #16a085 0%, #138d75 100%);
}

.btn:active {
    transform: translateY(0);
}

/* Table Styling */
.card-body {
    padding: 0;
    overflow-x: auto;
}

.table {
    margin-bottom: 0;
    width: 100%;
    min-width: 650px;
}

.table-bordered {
    border: none;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #dee2e6;
    color: #1a1a2e;
    font-weight: 700;
    padding: 16px 14px;
    vertical-align: middle;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    border-top: none;
    position: relative;
}

.table thead th::after {
    content: '';
    position: absolute;
    bottom: -2px;
    right: 0;
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, #4361ee, #3a0ca3);
}

.table tbody td {
    padding: 14px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
    color: #495057;
    font-size: 14px;
    transition: all 0.3s ease;
}

.table tbody tr {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.table tbody tr:hover {
    background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.table tbody tr:hover td {
    color: #1a1a2e;
}

/* ID Column */
.table thead th:first-child,
.table tbody td:first-child {
    font-weight: 700;
    color: #4361ee;
    width: 80px;
    text-align: center;
    font-size: 15px;
}

/* Button Group */
.btn-group {
    display: flex;
    gap: 8px;
}

.btn-group .btn {
    margin: 0;
    padding: 7px 14px;
    font-size: 12px;
    border-radius: 8px;
}

.btn-group .btn-info {
    background: linear-gradient(135deg, #3498db, #2980b9);
}

.btn-group .btn-danger {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.btn-group .btn:hover {
    transform: translateY(-2px);
}

/* Permissions Button */
a.btn-info {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 14px;
    font-size: 12px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #1abc9c, #16a085);
}

a.btn-info:hover {
    transform: translateY(-2px);
    text-decoration: none;
    color: white;
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.4);
}

/* Pagination Styling */
.card-body + nav,
.pagination-container {
    padding: 25px 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #f1f4f9 100%);
    border-top: 1px solid #e1e8ed;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pagination {
    margin-bottom: 0;
    gap: 8px;
}

.page-link {
    color: #4361ee;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 8px 14px;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.page-link:hover {
    background-color: #4361ee;
    border-color: #4361ee;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    border-color: #4361ee;
    color: white;
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
    opacity: 0.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header .row {
        flex-direction: column;
        gap: 12px;
    }
    
    .input-icon {
        margin-bottom: 10px;
    }
    
    .col-md-4 {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .btn {
        width: 100%;
        margin-left: 0;
        text-align: center;
        justify-content: center;
    }
    
    .btn-group {
        flex-direction: column;
        gap: 8px;
    }
    
    .btn-group .btn {
        width: 100%;
    }
    
    .table {
        font-size: 13px;
    }
    
    .table thead th,
    .table tbody td {
        padding: 10px 8px;
    }
    
    .pagination {
        gap: 4px;
    }
    
    .page-link {
        padding: 6px 10px;
        font-size: 12px;
    }
}

/* Small screens */
@media (max-width: 576px) {
    .card-header {
        padding: 20px;
    }
    
    .input-icon input {
        font-size: 13px;
        padding: 10px 35px 10px 12px;
    }
    
    .btn {
        font-size: 12px;
        padding: 8px 16px;
    }
    
    .table thead th {
        font-size: 11px;
        padding: 8px 6px;
    }
    
    .table tbody td {
        font-size: 11px;
        padding: 8px 6px;
    }
    
    .btn-group .btn {
        padding: 6px 10px;
        font-size: 11px;
    }
    
    a.btn-info {
        padding: 6px 10px;
        font-size: 11px;
    }
}

/* Animation Effects */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.card {
    animation: slideInRight 0.5s ease-out;
}

.table tbody tr {
    animation: fadeInUp 0.4s ease-out;
    animation-fill-mode: both;
}

.table tbody tr:nth-child(1) { animation-delay: 0.05s; }
.table tbody tr:nth-child(2) { animation-delay: 0.1s; }
.table tbody tr:nth-child(3) { animation-delay: 0.15s; }
.table tbody tr:nth-child(4) { animation-delay: 0.2s; }
.table tbody tr:nth-child(5) { animation-delay: 0.25s; }
.table tbody tr:nth-child(6) { animation-delay: 0.3s; }
.table tbody tr:nth-child(7) { animation-delay: 0.35s; }
.table tbody tr:nth-child(8) { animation-delay: 0.4s; }
.table tbody tr:nth-child(9) { animation-delay: 0.45s; }
.table tbody tr:nth-child(10) { animation-delay: 0.5s; }

/* Custom Scrollbar for Table */
.card-body::-webkit-scrollbar {
    height: 8px;
}

.card-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.card-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    border-radius: 10px;
}

.card-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #3a56d4 0%, #2c0b8a 100%);
}

/* Search Input Placeholder */
::placeholder {
    color: #adb5bd;
    opacity: 0.7;
    font-size: 13px;
}

/* Background Section */
section.content {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    padding: 40px 0;
    min-height: 100vh;
    position: relative;
}

section.content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(67, 97, 238, 0.03) 0%, transparent 50%);
    pointer-events: none;
}

/* Container Fluid */
.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Empty State Styling */
.table tbody tr td[colspan] {
    text-align: center;
    padding: 50px;
    color: #6c757d;
    font-size: 16px;
}

/* Permission Count Badge */
.btn-info .badge {
    background-color: rgba(255, 255, 255, 0.25);
    padding: 3px 8px;
    border-radius: 20px;
    margin-left: 6px;
    font-weight: 600;
}

/* Loading State for Delete Button */
.btn-danger:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Print Styles */
@media print {
    .btn,
    .card-header form,
    .pagination {
        display: none;
    }
    
    .card {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .table tbody tr:hover {
        background-color: transparent;
        transform: none;
    }
    
    .card-header {
        background: #f8f9fa;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}

/* Focus States for Accessibility */
.btn:focus-visible,
.input-icon input:focus-visible,
.page-link:focus-visible {
    outline: 2px solid #4361ee;
    outline-offset: 2px;
}
</style>
@endsection

@section('content')

{{-- <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
                <th>Reason</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="tag tag-success">Approved</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
              </tr>
              <tr>
                <td>219</td>
                <td>Alexander Pierce</td>
                <td>11-7-2014</td>
                <td><span class="tag tag-warning">Pending</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
              </tr>
              <tr>
                <td>657</td>
                <td>Bob Doe</td>
                <td>11-7-2014</td>
                <td><span class="tag tag-primary">Approved</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
              </tr>
              <tr>
                <td>175</td>
                <td>Mike Doe</td>
                <td>11-7-2014</td>
                <td><span class="tag tag-danger">Denied</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection --}}


<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{-- <a href="{{route('countries.create')}}" type="submit" class="btn btn-info">Add New role</a> --}}

          <form action="" method="get" style="margin-bottom:2%;">
            <div class="row">
                <div class="input-icon col-md-2">
                    <input type="text" class="form-control" placeholder="Search By Name"
                       name='name' @if( request()->name) value={{request()->name}} @endif/>
                      <span>
                          <i class="flaticon2-search-1 text-muted"></i>
                      </span>
                    </div>

                    <div class="input-icon col-md-2">
                        <input type="text" class="form-control" placeholder="Search By Code"
                           name='guard_name' @if( request()->guard_name) value={{request()->guard_name}} @endif/>
                          <span>
                              <i class="flaticon2-search-1 text-muted"></i>
                          </span>
                        </div>




            <div class="col-md-4">
                  <button class="btn btn-success btn-md" type="submit"> Filter</button>
                  <a href="{{route('roles.index')}}"  class="btn btn-danger">End Filter</a>
                  {{-- @can('Create-City') --}}

                  <a href="{{route('roles.create')}}"><button type="button" class="btn btn-md btn-primary"> Add New role </button></a>
                  {{-- @endcan --}}
            </div>

                 </div>
        </form>
        </div>


        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">id</th>
                <th>Role Name</th>
                <th>Guard Name</th>
                <th>Permissions</th>

                <th>Setting</th>

              </tr>
            </thead>
            <tbody>

                @foreach ($roles as $role )
                <tr>
                    <td>{{$role->id  }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>

                    <td><a href="{{route('roles.permissions.index', $role->id)}}"
                      class="btn btn-info">({{$role->permissions_count}})
                      permissions/s</a> </td>
                  <td>
                    <td>
                        <div class="btn-group">
                          <a href="{{route('roles.edit' , $role->id )}}" type="button" class="btn btn-info">edit</a>
                          <button type="button" onclick="performDestroy({{$role->id }} , this)" class="btn btn-danger">delete</button>
                        </div>
                      </td>
                  </tr>
                @endforeach




            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        {{ $roles->links() }}
      </div>
      <!-- /.card -->

    </div>

      <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->

    @endsection

@section('scripts')

<script>
    function performDestroy(id , reference){

        confirmDestroy('/cms/admin/roles/'+id  ,reference );

    }

    </script>
@endsection
