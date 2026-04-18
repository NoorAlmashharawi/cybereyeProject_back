@extends('cms.parent')

@section('title' , 'Index Role')

@section('main_title' , 'Index Role')

@section('sub_title' , 'index of role')


@section('styles')

<style>
  /* Card Styling */
.card {
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: #ffffff;
}

.card:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom: none;
    padding: 20px 25px;
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
    padding: 10px 35px 10px 15px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.95);
    transition: all 0.3s ease;
    font-size: 14px;
    width: 100%;
}

.input-icon input:focus {
    border-color: #ffffff;
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.3);
    outline: none;
    background: #ffffff;
    transform: translateY(-1px);
}

.input-icon span {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
}

.input-icon i {
    font-size: 18px;
    color: #667eea;
}

/* Button Styling */
.btn {
    padding: 8px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
    letter-spacing: 0.3px;
    border: none;
    margin-right: 8px;
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(40, 167, 69, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    background: linear-gradient(135deg, #218838 0%, #1ba87e 100%);
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
    background: linear-gradient(135deg, #0069d9 0%, #004a99 100%);
}

.btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(23, 162, 184, 0.3);
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
    background: linear-gradient(135deg, #138496 0%, #0f6674 100%);
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
    color: #2c3e50;
    font-weight: 700;
    padding: 15px 12px;
    vertical-align: middle;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-top: none;
}

.table tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
    color: #495057;
    font-size: 14px;
    transition: all 0.3s ease;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f8f9ff;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.table tbody tr:hover td {
    color: #2c3e50;
}

/* ID Column */
.table thead th:first-child,
.table tbody td:first-child {
    font-weight: 600;
    color: #667eea;
    width: 70px;
    text-align: center;
}

/* Button Group */
.btn-group {
    display: flex;
    gap: 8px;
}

.btn-group .btn {
    margin: 0;
    padding: 6px 12px;
    font-size: 12px;
}

.btn-group .btn-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.btn-group .btn-danger {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

/* Permissions Button */
a.btn-info {
    display: inline-block;
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
}

a.btn-info:hover {
    transform: translateY(-2px);
    text-decoration: none;
    color: white;
}

/* Pagination Styling */
.card-body + nav,
.pagination-container {
    padding: 20px 25px;
    background: #f8f9fa;
    border-top: 1px solid #e1e8ed;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pagination {
    margin-bottom: 0;
    gap: 5px;
}

.page-link {
    color: #667eea;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 8px 12px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.page-link:hover {
    background-color: #667eea;
    border-color: #667eea;
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header .row {
        flex-direction: column;
        gap: 10px;
    }
    
    .input-icon {
        margin-bottom: 10px;
    }
    
    .col-md-4 {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .btn {
        width: 100%;
        margin-right: 0;
        text-align: center;
    }
    
    .btn-group {
        flex-direction: column;
        gap: 5px;
    }
    
    .btn-group .btn {
        width: 100%;
    }
    
    .table {
        font-size: 13px;
    }
    
    .table thead th,
    .table tbody td {
        padding: 8px;
    }
}

/* Small screens */
@media (max-width: 576px) {
    .card-header {
        padding: 15px;
    }
    
    .input-icon input {
        font-size: 13px;
        padding: 8px 30px 8px 12px;
    }
    
    .btn {
        font-size: 12px;
        padding: 6px 15px;
    }
    
    .table thead th {
        font-size: 12px;
        padding: 8px;
    }
    
    .table tbody td {
        font-size: 12px;
        padding: 8px;
    }
}

/* Animation Effects */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeIn 0.5s ease-out;
}

.table tbody tr {
    animation: fadeIn 0.3s ease-out;
    animation-fill-mode: both;
}

.table tbody tr:nth-child(1) { animation-delay: 0.05s; }
.table tbody tr:nth-child(2) { animation-delay: 0.1s; }
.table tbody tr:nth-child(3) { animation-delay: 0.15s; }
.table tbody tr:nth-child(4) { animation-delay: 0.2s; }
.table tbody tr:nth-child(5) { animation-delay: 0.25s; }
.table tbody tr:nth-child(6) { animation-delay: 0.3s; }

/* Custom Scrollbar for Table */
.card-body::-webkit-scrollbar {
    height: 8px;
}

.card-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.card-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
}

.card-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46a0 100%);
}

/* Search Input Placeholder */
::placeholder {
    color: #adb5bd;
    opacity: 0.7;
    font-size: 13px;
}

/* Background Section */
section.content {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 30px 0;
    min-height: 100vh;
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
    padding: 40px;
    color: #6c757d;
    font-size: 16px;
}

/* Badge/Permission Count Styling */
.btn-info .badge {
    background-color: rgba(255, 255, 255, 0.3);
    padding: 2px 6px;
    border-radius: 20px;
    margin-left: 5px;
}

/* Loading State for Delete Button */
.btn-danger:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Tooltip on Hover */
[data-tooltip] {
    position: relative;
    cursor: pointer;
}

[data-tooltip]:before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 5px 10px;
    background: #2c3e50;
    color: white;
    border-radius: 5px;
    font-size: 12px;
    white-space: nowrap;
    display: none;
    z-index: 1000;
}

[data-tooltip]:hover:before {
    display: block;
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
