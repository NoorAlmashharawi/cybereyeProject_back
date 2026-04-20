@extends('cms.parent')

@section('title' , 'Edit Permission')

@section('main_title' , 'Edit Permission')

@section('sub_title' , 'Edit Permission')


@section('styles')
<style>

    .card {
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .card-primary .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px;
    }
    
    .card-primary .card-header h3 {
        color: white;
        margin: 0;
    }
    
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    }
    
    .btn-info {
        background: #17a2b8;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
    }
    
    .btn-info:hover {
        background: #138496;
        transform: translateY(-2px);
    }
    
    .card-footer {
        display: flex;
        gap: 10px;
        background: #f8f9fa;
    }
    
    @media (max-width: 768px) {
        .card-footer {
            flex-direction: column;
        }
        .btn {
            width: 100%;
        }
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
    }
    
    .card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
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
              <h3 class="card-title">Edit Data of Permission</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name of Permission</label>
                  <input type="text" class="form-control" name="name" id="name"
                  value="{{ $permissions->name }}" placeholder="Enter Name of Permission">
                </div>
                <div class="form-group col-md-6">
                    <label for="guard_name"> Guard Name</label>
                    <select class="form-select form-select-sm" name="guard_name" style="width: 100%;"
                          id="guard_name" aria-label=".form-select-sm example">

                          <option value="admin" @if($permissions->guard_name == 'admin') selected @endif>Admin</option>
                          <option value="student" @if($permissions->guard_name == 'student') selected @endif>student</option>
                          <option value="instructor" @if($permissions->guard_name == 'instructor') selected @endif>instructor</option>
                          {{-- <option value="web" @if($Permissions->guard_name == 'web') selected @endif>User</option> --}}

                      </select>
                 </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick=" performUpdate({{ $permissions->id }}) " class="btn btn-primary">Store</button>

                <a href="{{route('permissions.index')}}" type="submit" class="btn btn-info">Cancel</a>

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

        storeRoute('/cms/admin/permissions-update/' +id , formData);
    }
</script>

@endsection
