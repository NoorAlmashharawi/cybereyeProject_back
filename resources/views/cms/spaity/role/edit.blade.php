@extends('cms.parent')

@section('title' , 'Edit Role')

@section('main_title' , 'Edit Role')

@section('sub_title' , 'Edit Role')


@section('styles')
<style>
    /* ========== تنسيق صفحة Edit Role ========== */

/* Card Styling */
.card {
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #ffffff;
}

.card:hover {
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
}

.card-primary {
    border-top: 4px solid #4361ee;
}

/* Card Header */
.card-header {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    border-bottom: none;
    border-radius: 20px 20px 0 0 !important;
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
    background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
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

.card-title {
    color: white;
    font-weight: 700;
    font-size: 1.4rem;
    margin: 0;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-title::before {
    content: '✎';
    font-size: 1.2rem;
    opacity: 0.9;
}

/* Form Styling */
.card-body {
    padding: 40px 35px;
    background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
}

.form-group {
    margin-bottom: 30px;
    position: relative;
}

.form-group label {
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 12px;
    display: block;
    font-size: 14px;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
    position: relative;
    padding-right: 12px;
}

.form-group label::before {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 16px;
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    border-radius: 4px;
}

.form-group label::after {
    content: '*';
    color: #e74c3c;
    margin-right: 4px;
    font-weight: 700;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.form-group.required label::after {
    opacity: 1;
}

/* Input Fields */
.form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 14px 18px;
    font-size: 14px;
    transition: all 0.3s ease;
    width: 100%;
    background-color: #ffffff;
    color: #2c3e50;
    font-weight: 500;
}

.form-control:hover {
    border-color: #4361ee;
    background-color: #f8f9ff;
}

.form-control:focus {
    border-color: #4361ee;
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    outline: none;
    background-color: #ffffff;
    transform: translateY(-2px);
}

/* Select Dropdown */
.form-select {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 14px 18px;
    font-size: 14px;
    background-color: white;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    color: #2c3e50;
    font-weight: 500;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234361ee' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: left 18px center;
    background-size: 16px;
}

.form-select:hover {
    border-color: #4361ee;
    background-color: #f8f9ff;
}

.form-select:focus {
    border-color: #4361ee;
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    outline: none;
}

/* Column Spacing */
.col-md-6 {
    padding-left: 12px;
    padding-right: 12px;
}

/* Button Styling */
.card-footer {
    background: #f8f9fc;
    border-top: 1px solid #e9ecef;
    border-radius: 0 0 20px 20px;
    padding: 25px 35px;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 32px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: 0.5px;
    border: none;
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
    background: rgba(255,255,255,0.4);
    transform: translate(-50%, -50%);
    transition: width 0.5s, height 0.5s;
}

.btn:hover::before {
    width: 200px;
    height: 200px;
}

.btn-primary {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
    background: linear-gradient(135deg, #3a56d4 0%, #2c0b8a 100%);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
    text-decoration: none;
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.4);
    background: linear-gradient(135deg, #138496 0%, #0f6674 100%);
    color: white;
    text-decoration: none;
}

/* Loading State for Button */
.btn-primary.loading {
    opacity: 0.7;
    pointer-events: none;
    position: relative;
}

.btn-primary.loading::after {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    top: 50%;
    right: 20px;
    margin-top: -9px;
    border: 2px solid #fff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spinner 0.6s linear infinite;
}

@keyframes spinner {
    to { transform: rotate(360deg); }
}

/* Animations */
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

.form-group {
    animation: fadeInUp 0.5s ease-out;
    animation-fill-mode: both;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }

/* Placeholder Styling */
::placeholder {
    color: #adb5bd;
    opacity: 0.6;
    font-size: 13px;
    font-weight: 400;
}

/* Input Focus Effects */
.form-control:focus, .form-select:focus {
    animation: glow 0.3s ease-out;
}

@keyframes glow {
    0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.2); }
    100% { box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1); }
}

/* Validation States */
.form-control.is-valid {
    border-color: #2ecc71;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%232ecc71' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: left 15px center;
    background-size: 16px;
    padding-left: 45px;
}

.form-control.is-invalid {
    border-color: #e74c3c;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e74c3c'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e74c3c' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: left 15px center;
    background-size: 16px;
    padding-left: 45px;
}

/* Section Background */
section.content {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    padding: 50px 0;
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

/* Container */
.container-fluid {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Row */
.row {
    margin-left: -12px;
    margin-right: -12px;
}

/* Hover Effects */
.form-group:hover label {
    color: #4361ee;
    transform: translateX(-3px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header {
        padding: 20px;
    }
    
    .card-title {
        font-size: 1.2rem;
    }
    
    .card-body {
        padding: 25px 20px;
    }
    
    .card-footer {
        padding: 20px;
        flex-direction: column;
        gap: 12px;
    }
    
    .btn {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    
    .form-group {
        margin-bottom: 22px;
    }
    
    .col-md-6 {
        padding-left: 0;
        padding-right: 0;
    }
    
    section.content {
        padding: 30px 0;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 20px 15px;
    }
    
    .form-control, .form-select {
        padding: 11px 14px;
        font-size: 13px;
    }
    
    .form-group label {
        font-size: 13px;
        margin-bottom: 8px;
    }
    
    .btn {
        font-size: 13px;
        padding: 10px 20px;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
}

/* Print Styles */
@media print {
    .btn, .card-footer {
        display: none;
    }
    
    .card {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .card-header {
        background: #f8f9fa;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    .card-title {
        color: #000;
    }
    
    .form-control, .form-select {
        border: 1px solid #ddd;
        background: white;
    }
    
    section.content {
        background: white;
        padding: 0;
    }
}

/* Accessibility */
.form-control:focus-visible,
.form-select:focus-visible,
.btn:focus-visible {
    outline: 2px solid #4361ee;
    outline-offset: 2px;
}

/* Smooth Scroll */
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
