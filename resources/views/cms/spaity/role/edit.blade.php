@extends('cms.parent')

@section('title' , 'Edit Role')

@section('main_title' , 'Edit Role')

@section('sub_title' , 'Edit Role')


@section('styles')
<style>
  /* Card Styling */
.card {
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: #ffffff;
}

.card:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.card-primary {
    border-top: 4px solid #007bff;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom: none;
    border-radius: 15px 15px 0 0 !important;
    padding: 20px 25px;
    position: relative;
    overflow: hidden;
}

.card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform: rotate(45deg);
}

.card-title {
    color: white;
    font-weight: 700;
    font-size: 1.3rem;
    margin: 0;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
}

/* Form Styling */
.card-body {
    padding: 35px 30px;
    background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%);
}

.form-group {
    margin-bottom: 28px;
    position: relative;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    display: block;
    font-size: 14px;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
}

.form-group label::after {
    content: '*';
    color: #dc3545;
    margin-left: 4px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.form-group.required label::after {
    opacity: 1;
}

/* Input Fields */
.form-control {
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.3s ease;
    width: 100%;
    background-color: #ffffff;
    color: #2c3e50;
}

.form-control:hover {
    border-color: #667eea;
    background-color: #f8f9ff;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    outline: none;
    background-color: #ffffff;
    transform: translateY(-1px);
}

/* Select Dropdown */
.form-select {
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 14px;
    background-color: white;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    color: #2c3e50;
}

.form-select:hover {
    border-color: #667eea;
    background-color: #f8f9ff;
}

.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    outline: none;
}

/* Col-md-6 specific */
.col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
}

/* Button Styling */
.card-footer {
    background: linear-gradient(to top, #ffffff 0%, #f8f9fa 100%);
    border-top: 1px solid #e1e8ed;
    border-radius: 0 0 15px 15px;
    padding: 25px 30px;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: 0.5px;
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    background: linear-gradient(135deg, #5a67d8 0%, #6b46a0 100%);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
    background: linear-gradient(135deg, #3a9be0 0%, #00d4e0 100%);
    color: white;
    text-decoration: none;
}

.btn:active {
    transform: translateY(0);
}

/* Animation Effects */
@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

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

.card {
    animation: slideInFromLeft 0.5s ease-out;
}

.form-group {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }

/* Input Placeholder */
::placeholder {
    color: #adb5bd;
    opacity: 0.7;
    font-size: 13px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-body {
        padding: 25px 20px;
    }
    
    .card-footer {
        flex-direction: column;
        gap: 12px;
        padding: 20px;
    }
    
    .btn {
        width: 100%;
        text-align: center;
        padding: 10px 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
    
    .col-md-6 {
        padding-left: 0;
        padding-right: 0;
    }
}

/* Small screens */
@media (max-width: 576px) {
    .card-body {
        padding: 20px 15px;
    }
    
    .form-control,
    .form-select {
        padding: 10px 12px;
        font-size: 13px;
    }
    
    .form-group label {
        font-size: 13px;
    }
    
    .btn {
        font-size: 13px;
    }
}

/* Validation States */
.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
}

.form-control.is-invalid {
    border-color: #dc3545;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
}

/* Disabled State */
.form-control:disabled,
.form-select:disabled {
    background-color: #e9ecef;
    opacity: 0.7;
    cursor: not-allowed;
}

/* Loading Animation for Button */
.btn-primary:disabled {
    opacity: 0.6;
    transform: none;
    cursor: not-allowed;
    position: relative;
}

.btn-primary:disabled::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    right: 15px;
    margin-top: -8px;
    border: 2px solid #fff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spinner 0.6s linear infinite;
}

@keyframes spinner {
    to {transform: rotate(360deg);}
}

/* Background for Section */
section.content {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 40px 0;
    min-height: 100vh;
}

/* Container Styling */
.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Row Styling */
.row {
    margin-left: -10px;
    margin-right: -10px;
}

/* Tooltip on Hover */
.form-group:hover label {
    color: #667eea;
    transform: translateX(2px);
}

/* Focus Visible for Accessibility */
.form-control:focus-visible,
.form-select:focus-visible,
.btn:focus-visible {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Print Styles */
@media print {
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
    
    section.content {
        background: white;
        padding: 0;
    }
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
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
            <div class="card-header">
              <h3 class="card-title">Edit Data of Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name of Role</label>
                  <input type="text" class="form-control" name="name" id="name"
                  value="{{ $roles->name }}" placeholder="Enter Name of Role">
                </div>
                <div class="form-group col-md-6">
                    <label for="guard_name"> Guard Name</label>
                    <select class="form-select form-select-sm" name="guard_name" style="width: 100%;"
                          id="guard_name" aria-label=".form-select-sm example">

                          <option value="admin" @if($roles->guard_name == 'admin') selected @endif>Admin</option>
                          <option value="student" @if($roles->guard_name == 'student') selected @endif>student</option>
                          <option value="instructor" @if($roles->guard_name == 'instructor') selected @endif>instructor</option>
                          {{-- <option value="web" @if($roles->guard_name == 'web') selected @endif>User</option> --}}

                      </select>
                 </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick=" performUpdate({{ $roles->id }}) " class="btn btn-primary">Store</button>

                <a href="{{route('roles.index')}}" type="submit" class="btn btn-info">Cancel</a>

              </div>
            </form>
          </div>
          <!-- /.card -->


        </div>

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


@endsection


@section('scripts')

<script>
     function performUpdate(id){
        let formData = new FormData();

        formData.append('name',document.getElementById('name').value);
        formData.append('guard_name',document.getElementById('guard_name').value);

        storeRoute('/cms/admin/roles-update/' +id , formData);
    }
</script>

@endsection
