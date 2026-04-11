@extends('cms.parent')

@section('title', 'المدرسين المحذوفين')
@section('main-title', 'سلة المحذوفات - المدرسين')
@section('sub-title', 'المدرسين الذين تم حذفهم مؤقتاً')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('cms/css/viewStudents.css') }}">
<style>
    .controls{
        direction: ltr
        
    }
    .table-container{
        margin-right: 20%;
    }

        .btn-action {

        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        color: white;
        text-decoration: none;
        margin: 0 2px;
        
    }
    .btn-info { background: linear-gradient(135deg, #17a2b8, #138496); }
    .btn-primary { background: linear-gradient(135deg, #007bff, #0069d9); }
    .btn-danger { background: linear-gradient(135deg, #dc3545, #c82333); }
    .btn-action:hover { transform: translateY(-2px); opacity: 0.9; }
    .stars {
        color: #ffc107;
        font-size: 14px;
    }
</style>
@endsection

@section('content')


<div class="container" >
    <div class="controls">

        

        <div class="action-buttons">
            <a href="{{ route('instructors_forceAll') }}" style="color:rgb(250, 13, 13); text-decoration:none; ">
                <i class="fas fa-user-secret"></i> حذف الجميع
            </a>
         
            <button class="btn btn-secondary">
                <a href="{{ route('instructors.index') }}" style="color:white; text-decoration:none;">
                    <i class="fas fa-arrow-left"></i> العودة للمدربين
                </a>
            </button>
        </div>
    </div>

    <div class="table-container">
        <table id="instructorsTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID</th>
                    <th onclick="sortTable(1)">اسم المدرب</th>
                    <th onclick="sortTable(2)">البريد الإلكتروني</th>
                    <th onclick="sortTable(3)">التخصص</th>
                    <th onclick="sortTable(4)">سنوات الخبرة</th>
                    <th onclick="sortTable(5)">التقييم</th>
                    <th>تاريخ الحذف</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->id }}</td>
                    <td>{{ $instructor->user1->username ?? 'غير محدد' }}</td>
                    <td>{{ $instructor->user1->email ?? 'غير محدد' }}</td>
                    <td>{{ $instructor->specialization ?? 'غير محدد' }}</td>
                    <td>{{ $instructor->experience_years ?? 0 }} سنة</td>
                    <td>
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($instructor->rating ?? 0))
                                <i class="fas fa-star" style="color: #ffc107;"></i>
                            @else
                                <i class="far fa-star" style="color: #ffc107;"></i>
                            @endif
                        @endfor
                        ({{ $instructor->rating ?? 0 }})
                    </td>
                    <td>{{ $instructor->deleted_at ? $instructor->deleted_at->format('Y-m-d H:i') : '-' }}</td>
                    <td>
                        <div style="display:flex; gap:5px; justify-content:center;">
                        
                            <a href="{{ route('instructors_restore', $instructor->id) }}" class="btn-action btn-primary" title="استعادة">
                                <i class="fas fa-trash-restore"></i>
                            </a>
                            <a href="{{ route('instructors_force', $instructor->id) }}" class="btn-action btn-danger" title="حذف">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                    
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="margin-right: 50%;  width: 100%;">
                        <div style="padding: 50px;">
                            <i class="fas fa-trash-alt" style="font-size: 50px; color: #ccc; margin-bottom: 20px;"></i>
                            <h3>لا يوجد مدربين محذوفين</h3>
                            <p>سلة المحذوفات فارغة</p>
                            <a href="{{ route('instructors.index') }}" class="btn btn-primary">العودة لقائمة المدرسين</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@endsection