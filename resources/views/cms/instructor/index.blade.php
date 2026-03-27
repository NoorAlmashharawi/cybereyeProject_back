  @extends('cms.parent')

@section('title', 'Admin')
@section('main-title', 'لوحة تحكم المشرف')
@section('sub-title', 'إدارة المدرسين')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('cms/css/viewStudents.css') }}">

@endsection

@section('content')

<div class="hacker-animation" id="matrixAnimation"></div>

<header>
    <div class="container">
        <h1><i class="fas fa-chalkboard-teacher"></i> All Instructors</h1>
    </div>
</header>

<div class="container">

    <div class="controls">


               <div class="search-box">
            <input type="text" id="searchInput" placeholder="ابحث عن  مدرس بالاسم أو المعرف الأمني...">
            <i class="fas fa-search"></i>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary">
                <a href="{{ route('instructors.create') }}" style="color:white;">
                    <i class="fas fa-user-plus"></i> إضافة مدرس
                </a>
            </button>
        </div>

    </div>


    {{-- الإحصائيات --}}
    <div class="stats">

        <div class="stat-card">
            <div class="stat-icon hacker-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $totalInstructors }}</h3>
                <p>مدرس</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon skill-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                {{-- <h3>{{ $avgRating }}</h3> --}}
                <p>متوسط التقييم</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon cert-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $avgExperience }}</h3>
                <p>متوسط الخبرة</p>
            </div>
        </div>

    </div>


    {{-- جدول المدرسين --}}
    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>اسم المدرس</th>
                    <th>البريد الإلكتروني</th>
                    <th>التخصص</th>
                    <th>سنوات الخبرة</th>
                    <th>التقييم</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>

            @foreach ($instructors as $instructor)

                <tr>

                    <td>{{ $instructor->id }}</td>

                    <td class="student-name">
                        {{ $instructor->user1->username ?? 'غير محدد' }}
                    </td>

                    <td>
                        {{ $instructor->user1->email ?? 'غير محدد' }}
                    </td>

                    <td>
                        <span class="specialization">
                            {{ $instructor->specialization }}
                        </span>
                    </td>

                    <td>
                        {{ $instructor->experience_years }} سنة
                    </td>
                        <td>
                            <span class="stars" data-rating="{{ $instructor->rating }}"></span>
                        </td>

                    <td>

                        <a href="{{ route('instructors.show',$instructor->id) }}"
                           class="btn-action btn-info">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('instructors.edit',$instructor->id) }}"
                           class="btn-action btn-edit-custom">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('instructors.destroy',$instructor->id) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                onclick="performDestroy({{ $instructor->id }}, this)"
                                class="btn-action btn-delete-custom">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>


        {{ $instructors->links() }}

    </div>

</div>

@endsection


@section('scripts')

<script src="{{ asset('cms/js/rating.js') }}">

 




</script>

@endsection
