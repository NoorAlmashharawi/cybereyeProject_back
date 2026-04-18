@extends('cms.parent')

@section('title', 'قائمة الكويزات')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('cms/css/quiz.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="app-layout">
    <div class="main-content">
       <div class="header-bar">
    <h2>📋 قائمة الكويزات</h2>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('quizzs.trashed') }}" class="btn-primary" style="background: #374151;">
            <i class="fas fa-archive"></i> الأرشيف
        </a>
        <a href="{{ route('quizzs.create') }}" class="btn-primary">+ كويز جديد</a>
    </div>
</div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="cards-grid">
            @forelse($quizzs as $quizz)
                <div class="quiz-card"  id="card-{{ $quizz->id }}">
                    <div class="card-header">
                        <span class="quiz-title">{{ $quizz->title }}</span>
                         <span class="quiz-marks">⭐ {{ $quizz->total_marks ?? '0' }}</span>
                    </div>
                    <div class="card-body">
                        <div class="quiz-description">
                            {{ $quizz->description ?? 'لا يوجد وصف لهذا الكويز.' }}
                        </div>
                        <div class="quiz-meta">
                            <span><i class="fas fa-clock"></i> {{ $quizz->duration_minutes ? $quizz->duration_minutes . ' دقيقة' : 'غير محدد' }}</span>
                            <span><i class="fas fa-book"></i> {{ $quizz->course->name ?? $quizz->course->name  }}</span>
                        </div>
                    </div>
                    <div class="card-actions">

                            <a href="{{ route('quizzs.show',$quizz->id) }}"
                           class="btn-action btn-info">
                            <i class="fas fa-eye"></i>
                        </a>

                          <a href="{{ route('quizzs.edit', $quizz->id)  }}"
                           class="btn-action btn-edit-custom">
                            <i class="fas fa-edit"></i>
                        </a>

                      <button type="button"
                    onclick="confirmArchive({{ $quizz->id }})"
                    class="btn-action btn-delete-custom">
                   <i class="fas fa-trash-alt"></i>
                   </button>


                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 48px; color:#9ca3af;"> لا توجد كويزات حالياً. <a href="{{ route('quizzs.create') }}" style="color:#60a5fa;">أضف أول كويز</a></div>
            @endforelse
        </div>
        <div class="pagination">{{ $quizzs->links() }}</div>
    </div>
</div>
@endsection

@section('scripts')

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
function confirmArchive(id) {

    Swal.fire({
        title: 'نقل إلى الأرشيف؟',
        text: 'سيتم نقل الكويز وجميع أسئلته إلى الأرشيف.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم، أرشفة',
        cancelButtonText: 'إلغاء',
        customClass: {
            popup: 'dark-swal',
            confirmButton: 'swal2-confirm-custom',
            cancelButton: 'swal2-cancel-custom'
        },
        buttonsStyling: false
    }).then((result) => {

        if(result.isConfirmed){
            archiveQuiz(id);
        }

    });
}



function archiveQuiz(id){

    axios.delete(`/cms/quizz/quizzs/${id}`)
    .then(function(response){

        const card = document.querySelector(`#card-${id}`);

        if(card){
            card.style.transition = "0.5s";
            card.style.opacity = "0";
            card.style.transform = "scale(0.8)";

            setTimeout(() => {
                card.remove();
            }, 500);
        }

        Swal.fire({
            title: 'تمت الأرشفة',
            text: 'تم نقل الكويز إلى الأرشيف',
            icon: 'success',
            timer: 1400,
            showConfirmButton: false,
            customClass: {
                popup: 'dark-swal'
            }
        });

    })
    .catch(function(){

        Swal.fire({
            title: 'خطأ',
            text: 'تعذر تنفيذ العملية',
            icon: 'error',
            timer: 1400,
            showConfirmButton: false,
            customClass: {
                popup: 'dark-swal'
            }
        });

    });

}
</script>


@endsection
