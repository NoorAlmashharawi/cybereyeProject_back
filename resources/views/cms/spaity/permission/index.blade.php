@extends('cms.parent')

@section('title', 'Index Permission')
@section('main_title', 'Index Permission')
@section('sub_title', 'index of permission')

@section('styles')
<style>
    /* ========== تنسيق محسّن لصفحة الصلاحيات ========== */
    
    .card {
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        overflow: hidden;
        background: #ffffff;
        border: none;
    }
    
    .card:hover {
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        padding: 25px 30px;
        position: relative;
    }
    
    .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #00b4d8, #0077b6, #00b4d8);
    }
    
    form .row {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 15px;
    }
    
    .input-icon {
        position: relative;
        flex: 1;
        min-width: 180px;
    }
    
    .input-icon input {
        padding: 12px 45px 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        transition: all 0.3s ease;
        font-size: 14px;
        width: 100%;
    }
    
    .input-icon input:focus {
        border-color: #0077b6;
        box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1);
        outline: none;
    }
    
    .input-icon span {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }
    
    .input-icon i {
        font-size: 18px;
        color: #94a3b8;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(46, 204, 113, 0.35);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(231, 76, 60, 0.35);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0077b6, #023e8a);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 119, 182, 0.35);
    }
    
    .btn-info {
        background: linear-gradient(135deg, #00b4d8, #0077b6);
        color: white;
    }
    
    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 180, 216, 0.35);
    }
    
    .card-body {
        padding: 0;
        overflow-x: auto;
    }
    
    .table {
        margin-bottom: 0;
        width: 100%;
        min-width: 550px;
    }
    
    .table-bordered {
        border: 1px solid #e2e8f0;
    }
    
    .table thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 2px solid #e2e8f0;
        color: #1e293b;
        font-weight: 700;
        padding: 16px 14px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
    }
    
    .table tbody tr:hover {
        background: linear-gradient(90deg, #f8fafc 0%, #ffffff 100%);
    }
    
    .table thead th:first-child,
    .table tbody td:first-child {
        font-weight: 700;
        color: #0077b6;
        width: 70px;
        text-align: center;
    }
    
    .guard-badge {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .guard-badge.admin {
        background: #667eea20;
        color: #667eea;
        border: 1px solid #667eea30;
    }
    
    .guard-badge.student {
        background: #2ecc7120;
        color: #27ae60;
        border: 1px solid #2ecc7130;
    }
    
    .guard-badge.instructor {
        background: #f39c1220;
        color: #e67e22;
        border: 1px solid #f39c1230;
    }
    
    .guard-badge.author {
        background: #9b59b620;
        color: #8e44ad;
        border: 1px solid #9b59b630;
    }
    
    .guard-badge.secondary {
        background: #94a3b820;
        color: #64748b;
        border: 1px solid #94a3b830;
    }
    
    .btn-group {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    
    .btn-group .btn {
        margin: 0;
        padding: 6px 14px;
        font-size: 12px;
        border-radius: 8px;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-2px);
    }
    
    .card-footer {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        padding: 20px 25px;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
    }
    
    .page-item {
        list-style: none;
    }
    
    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 12px;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #0077b6;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .page-link:hover {
        background: #0077b6;
        color: white;
        border-color: #0077b6;
    }
    
    .page-item.active .page-link {
        background: linear-gradient(135deg, #0077b6, #023e8a);
        color: white;
        border-color: #0077b6;
    }
    
    .page-item.disabled .page-link {
        color: #94a3b8;
        cursor: not-allowed;
    }
    
    @media (max-width: 768px) {
        .card-header {
            padding: 20px;
        }
        
        form .row {
            flex-direction: column;
            align-items: stretch;
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
            justify-content: center;
        }
        
        .btn-group {
            flex-direction: column;
            gap: 6px;
        }
        
        .btn-group .btn {
            width: 100%;
        }
        
        .table thead th,
        .table tbody td {
            padding: 10px 8px;
            font-size: 12px;
        }
    }
    
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #94a3b8;
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #cbd5e1;
    }
    
    .empty-state h5 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #64748b;
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
        animation: fadeInUp 0.4s ease-out;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form action="" method="get">
                    <div class="row">
                        <div class="input-icon col-md-3">
                            <input type="text" class="form-control" placeholder="بحث باسم الصلاحية"
                                   name="name" @if(request()->name) value="{{ request()->name }}" @endif/>
                            <span><i class="fas fa-search"></i></span>
                        </div>
                        <div class="input-icon col-md-3">
                            <input type="text" class="form-control" placeholder="بحث بنوع الحارس"
                                   name="guard_name" @if(request()->guard_name) value="{{ request()->guard_name }}" @endif/>
                            <span><i class="fas fa-shield-alt"></i></span>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-filter"></i> فلترة
                            </button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-danger">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> إضافة صلاحية
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 60px">#</th>
                            <th>اسم الصلاحية</th>
                            <th style="width: 150px">نوع الحارس</th>
                            <th style="width: 160px">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>
                                <span class="permission-name">{{ $permission->name }}</span>
                            </td>
                            <td>
                                @php
                                    $guardClass = 'secondary';
                                    if($permission->guard_name == 'admin') $guardClass = 'admin';
                                    elseif($permission->guard_name == 'student') $guardClass = 'student';
                                    elseif($permission->guard_name == 'instructor') $guardClass = 'instructor';
                                    elseif($permission->guard_name == 'author') $guardClass = 'author';
                                @endphp
                                <span class="guard-badge {{ $guardClass }}">{{ $permission->guard_name }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info" title="تعديل">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>
                                    <button type="button" onclick="performDestroy({{ $permission->id }}, this)" class="btn btn-danger" title="حذف">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="empty-state">
                                    <i class="fas fa-key"></i>
                                    <h5>لا توجد صلاحيات</h5>
                                    <p>لم يتم العثور على أي صلاحيات متاحة</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($permissions->hasPages())
            <div class="card-footer">
                {{ $permissions->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function performDestroy(id, reference) {
        confirmDestroy('/cms/admin/permissions/' + id, reference);
    }
</script>
@endsection