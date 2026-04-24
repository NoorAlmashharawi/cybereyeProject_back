@extends('cms.parent')

@section('title' , 'Roles')

@section('main-title' , 'Roles')

@section('small-title' , 'Roles')

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

.card-primary {
    border-top: 4px solid #007bff;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom: none;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.card-title {
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
    margin: 0;
    letter-spacing: 0.5px;
}

/* Search Form Styling */
.card-tools {
    margin: 0;
}

.mx-auto.pull-right {
    float: right;
}

.input-group {
    width: 250px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-control.mr-2 {
    border: 2px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.95);
    border-radius: 10px 0 0 10px;
    padding: 8px 12px;
    font-size: 13px;
    transition: all 0.3s ease;
}

.form-control.mr-2:focus {
    border-color: #ffffff;
    box-shadow: none;
    background: #ffffff;
    outline: none;
}

.input-group-append .btn {
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-left: none;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 0 10px 10px 0;
    padding: 8px 15px;
    transition: all 0.3s ease;
}

.input-group-append .btn:hover {
    background: #ffffff;
    transform: scale(1.02);
}

.input-group-append .btn i {
    color: #667eea;
    font-size: 14px;
}

/* Table Styling */
.card-body {
    padding: 0;
    overflow-x: auto;
}

.table {
    margin-bottom: 0;
    width: 100%;
    min-width: 500px;
}

.table-bordered {
    border: 1px solid #e1e8ed;
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
    text-align: center;
}

.table tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
    color: #495057;
    font-size: 14px;
    transition: all 0.3s ease;
    text-align: center;
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

/* Table Striped Effect */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(102, 126, 234, 0.02);
}

/* ID Column Styling */
.table tbody td:first-child {
    font-weight: 700;
    color: #667eea;
    width: 80px;
}

/* Custom Checkbox Styling - iCheck Primary */
.icheck-primary {
    display: inline-block;
    margin: 0;
    position: relative;
}

.icheck-primary input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    width: 0;
    height: 0;
}

.icheck-primary label {
    position: relative;
    display: inline-block;
    padding-left: 30px;
    cursor: pointer;
    margin-bottom: 0;
    min-width: 20px;
    min-height: 20px;
}

.icheck-primary label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 20px;
    border: 2px solid #ced4da;
    border-radius: 5px;
    background: white;
    transition: all 0.3s ease;
}

.icheck-primary label:after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 5px;
    background: #667eea;
    transform: scale(0);
    transition: all 0.3s ease;
    opacity: 0;
}

.icheck-primary input[type="checkbox"]:checked + label:after {
    transform: scale(1);
    opacity: 1;
}

.icheck-primary input[type="checkbox"]:checked + label:before {
    border-color: #667eea;
    background: #667eea;
}

.icheck-primary input[type="checkbox"]:checked + label:after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 12px;
}

.icheck-primary:hover label:before {
    border-color: #667eea;
    transform: scale(1.05);
}

.icheck-primary input[type="checkbox"]:focus + label:before {
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Animation for Checkbox */
.icheck-primary label:before,
.icheck-primary label:after {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .card-tools {
        width: 100%;
    }
    
    .mx-auto.pull-right {
        float: none;
        width: 100%;
    }
    
    .input-group {
        width: 100%;
    }
    
    .table {
        font-size: 13px;
    }
    
    .table thead th,
    .table tbody td {
        padding: 10px 8px;
    }
    
    .icheck-primary label {
        padding-left: 25px;
    }
    
    .icheck-primary label:before,
    .icheck-primary label:after {
        width: 18px;
        height: 18px;
    }
}

/* Small screens */
@media (max-width: 576px) {
    .card-header {
        padding: 15px;
    }
    
    .card-title {
        font-size: 1rem;
    }
    
    .table thead th {
        font-size: 12px;
        padding: 8px;
    }
    
    .table tbody td {
        font-size: 12px;
        padding: 8px;
    }
    
    .icheck-primary label {
        padding-left: 22px;
    }
    
    .icheck-primary label:before,
    .icheck-primary label:after {
        width: 16px;
        height: 16px;
    }
}

/* Animation Effects */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.card {
    animation: fadeInUp 0.5s ease-out;
}

.table tbody tr {
    animation: slideInRight 0.4s ease-out;
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

/* Custom Scrollbar */
.card-body::-webkit-scrollbar {
    height: 8px;
    width: 8px;
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
    font-size: 12px;
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

/* Status Badge Styling (if needed) */
.tag {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tag-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.tag-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
    color: white;
}

.tag-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.tag-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
}

/* Loading State for Checkbox */
.icheck-primary input[type="checkbox"]:disabled + label {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Checkbox Hover Effect */
.icheck-primary:hover {
    transform: scale(1.05);
    display: inline-block;
}

/* Print Styles */
@media print {
    .card-tools,
    .input-group-append,
    .btn {
        display: none;
    }
    
    .card {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .card-header {
        background: #f8f9fa;
    }
    
    .card-title {
        color: #000;
    }
    
    .table tbody tr:hover {
        background-color: transparent;
        transform: none;
    }
    
    .icheck-primary label:before {
        border-color: #000;
    }
}

/* Focus Visible for Accessibility */
.icheck-primary input[type="checkbox"]:focus-visible + label:before {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Tooltip for Checkbox (optional) */
.icheck-primary {
    position: relative;
}

.icheck-primary[data-tooltip]:hover:before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    background: #2c3e50;
    color: white;
    font-size: 11px;
    border-radius: 4px;
    white-space: nowrap;
    z-index: 1000;
    pointer-events: none;
}
</style>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header ">
                        <h3 class="card-title"></h3>
                        {{-- <a href="{{ route('roles.index') }}" type="button"  class="btn btn-success">الأدوار</a> --}}

                                  <div class="card-tools">
                            <div class="mx-auto pull-right">
                                <div class="">
                                    <form action="{{('roles.permissions.index')}}" method="GET" role="search">
                                        <div class="input-group input-group-sm" style="width: 200px;">

                                            <input type="text" class="form-control mr-2" name="name" placeholder="Search Role Permissions" id="name">

                                            <div class="input-group-append">
                                              <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                              </button>
                                            </div>
                                          </div>
                                </div>
                            </div>

                        </div>
                     </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered table-striped text-nowrap">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th> Permission </th>
                              <th> Guard Name</th>
                              <th> Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                              {{-- <span class="tag tag-success">Approved</span>s --}}
                              <td>{{$permission->id}}</td>
                              <td>{{$permission->name}}</td>
                              <td>{{$permission->guard_name}}</td>
                              <td>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="permission_{{$permission->id}}"
                                        onchange="storeRolePermission({{$roleId}},{{$permission->id}})" 
                                        @if($permission->active) checked @endif>
                                    <label for="permission_{{$permission->id}}"></label>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
            </section>
            @endsection

            @section('scripts')

            <script>

    let rolePermissionsStoreUrl = '{{ route("roles.permissions.store", ":roleId") }}';
    
    function storeRolePermission(roleId, permissionId) {
        let url = rolePermissionsStoreUrl.replace(':roleId', roleId);
        let data = { permission_id: permissionId };
        
        axios.post(url, data)
            .then(function(response) {
                if(response.data.icon === 'success') {
                    console.log('تم التحديث');
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }

// function storeRolePermission(roleId, permissionId) {
//     axios.post('/cms/admin/roles/' + roleId + '/permissions', {
//         permission_id: permissionId
//     }).then(response => {
//         if(response.data.icon === 'success') {
//             // نجاح
//         }
//     }).catch(error => {
//         console.log(error);
//         // إذا فشل، أرجع الـ checkbox إلى حالته السابقة
//         document.getElementById('permission_' + permissionId).checked = !document.getElementById('permission_' + permissionId).checked;
//     });
// }

            //   function storeRolePermission(roleId, permissionId){
            //     let data = {
            //       permission_id: permissionId,
            //     };

            //     store('/cms/admin/roles/'+roleId+'/permissions',data);

            //   }

 
            </script>
            @endsection

