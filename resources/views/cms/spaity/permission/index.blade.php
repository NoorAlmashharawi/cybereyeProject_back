@extends('cms.parent')

@section('title' , 'Index Permission')

@section('main_title' , 'Index Permission')

@section('sub_title' , 'index of permission')
<style>
  
</style>

@section('styles')
<style>
  /* Card Styling */
.card {
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
    padding: 20px;
}

/* Form Styling */
form {
    margin-bottom: 2%;
}

.input-icon {
    position: relative;
}

.input-icon input {
    padding-right: 30px;
    border-radius: 5px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
}

.input-icon input:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.input-icon span {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

.input-icon i {
    font-size: 18px;
    color: #6c757d;
}

/* Button Styling */
.btn {
    border-radius: 5px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-right: 5px;
}

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.btn-info:hover {
    background-color: #138496;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-success:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
}

/* Table Styling */
.table {
    margin-bottom: 0;
    width: 100%;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    color: #495057;
    font-weight: 600;
    padding: 12px;
    vertical-align: middle;
}

.table tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}

.table tbody tr:hover {
    background-color: #f5f5f5;
    transition: background-color 0.3s ease;
}

/* Button Group Styling */
.btn-group {
    display: flex;
    gap: 8px;
}

.btn-group .btn {
    margin: 0;
    padding: 6px 12px;
    font-size: 14px;
}

/* Pagination Styling */
.card-body + nav {
    padding: 20px;
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    border-radius: 0 0 10px 10px;
}

.pagination {
    margin-bottom: 0;
    justify-content: center;
}

.page-link {
    color: #007bff;
    border-radius: 5px;
    margin: 0 3px;
}

.page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header .row {
        flex-direction: column;
    }
    
    .input-icon {
        margin-bottom: 10px;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin-bottom: 5px;
        width: 100%;
    }
    
    .table {
        font-size: 14px;
    }
    
    .table thead th,
    .table tbody td {
        padding: 8px;
    }
}

/* Animations */
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
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Input Placeholder Styling */
::placeholder {
    color: #6c757d;
    opacity: 0.7;
}

/* Focus Effects */
input:focus,
button:focus {
    outline: none;
}

/* Loading State for Buttons */
.btn:active {
    transform: translateY(0);
}

/* Table Striped Effect (Optional) */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.02);
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
          {{-- <a href="{{route('countries.create')}}" type="submit" class="btn btn-info">Add New permission</a> --}}

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
                  <a href="{{route('permissions.index')}}"  class="btn btn-danger">End Filter</a>
                  {{-- @can('Create-City') --}}

                  <a href="{{route('permissions.create')}}"><button type="button" class="btn btn-md btn-primary"> Add New permission </button></a>
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
                <th>Permission Name</th>
                <th>Guard Name</th>

                <th>Setting</th>

              </tr>
            </thead>
            <tbody>

                @foreach ($permissions as $permission )
                <tr>
                    <td>{{$permission->id  }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>

                    <td>
                        <div class="btn-group">
                          <a href="{{route('permissions.edit' , $permission->id )}}" type="button" class="btn btn-info">edit</a>
                          <button type="button" onclick="performDestroy({{$permission->id }} , this)" class="btn btn-danger">delete</button>
                        </div>
                      </td>
                  </tr>
                @endforeach




            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        {{ $permissions->links() }}
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

        confirmDestroy('/cms/admin/permissions/'+id  ,reference );

    }

    </script>
@endsection
