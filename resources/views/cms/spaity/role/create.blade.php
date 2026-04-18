@extends('cms.parent')

@section('title' , 'Create Role')

@section('main_title' , 'Create Role')

@section('sub_title' , 'Create Role')


@section('styles')
<style>
  /* Card Styling */
.card {
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.card-primary {
    border-top: 3px solid #007bff;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom: none;
    border-radius: 12px 12px 0 0 !important;
    padding: 20px 25px;
}

.card-title {
    color: white;
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
    letter-spacing: 0.5px;
}

/* Form Styling */
.card-body {
    padding: 30px 25px;
    background-color: #ffffff;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
    letter-spacing: 0.3px;
}

.form-control {
    border: 2px solid #e1e5eb;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.form-control:hover {
    border-color: #667eea;
}

/* Select Dropdown Styling */
.form-select {
    border: 2px solid #e1e5eb;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
    background-color: white;
    transition: all 0.3s ease;
    cursor: pointer;
}

.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

/* Button Styling */
.card-footer {
    background-color: #f8f9fc;
    border-top: 1px solid #e1e5eb;
    border-radius: 0 0 12px 12px;
    padding: 20px 25px;
    display: flex;
    gap: 15px;
}

.btn {
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    background: linear-gradient(135deg, #5a67d8 0%, #6b46a0 100%);
}

.btn-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(79, 172, 254, 0.3);
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
    background: linear-gradient(135deg, #3a9be0 0%, #00d4e0 100%);
    color: white;
}

.btn:active {
    transform: translateY(0);
}

/* Row and Column Spacing */
.row {
    margin-left: -10px;
    margin-right: -10px;
}

.row > [class*="col-"] {
    padding-left: 10px;
    padding-right: 10px;
}

/* Input Placeholder Styling */
::placeholder {
    color: #adb5bd;
    opacity: 0.7;
    font-size: 13px;
}

/* Animation Effects */
@keyframes slideInFromTop {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: slideInFromTop 0.5s ease-out;
}

.form-group {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }

/* Responsive Design */
@media (max-width: 768px) {
    .card-body {
        padding: 20px;
    }
    
    .card-footer {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn {
        width: 100%;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
}

/* Loading State for Button */
.btn-primary:disabled {
    opacity: 0.6;
    transform: none;
    cursor: not-allowed;
}

/* Success/Error States */
.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px;
}

.form-control.is-invalid {
    border-color: #dc3545;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px;
}

/* Custom Focus Ring */
.form-control:focus,
.form-select:focus {
    outline: none;
}

/* Smooth Transitions */
.form-control,
.form-select,
.btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Background for Section */
section.content {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 30px 0;
    min-height: 100vh;
}

/* Container Styling */
.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
}

/* Icon Styling (if you add icons) */
.form-group i {
    position: absolute;
    right: 15px;
    top: 38px;
    color: #adb5bd;
}

/* Responsive Font Sizes */
@media (max-width: 576px) {
    .form-group label {
        font-size: 13px;
    }
    
    .form-control,
    .form-select {
        font-size: 13px;
        padding: 8px 12px;
    }
    
    .btn {
        font-size: 13px;
        padding: 8px 16px;
    }
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
              <h3 class="card-title">Add Data of Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">
                  <label for="name">Name of Role</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name of Role">
                </div>
                <div class="form-group col-md-6">
                    <label for="guard_name"> Guard Name</label>
                    <select class="form-select form-select-sm" name="guard_name" style="width: 100%;"
                          id="guard_name" aria-label=".form-select-sm example">
                         <option value="admin">Admin </option>
                         <option value="student">student </option>
                         <option value="instructor">instructor </option>
                         
                         {{-- <option value="web">User </option> --}}

                      </select>
                 </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick=" performStore() " class="btn btn-primary">Store</button>

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
     function performStore(){
        let formData = new FormData();

        formData.append('name',document.getElementById('name').value);
        formData.append('guard_name',document.getElementById('guard_name').value);

        store('/cms/admin/roles' , formData);
    }
</script>

@endsection
