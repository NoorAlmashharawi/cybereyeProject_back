@extends('cms.parent')

@section('title', 'سلة محذوفات الأسئلة')

@section('styles')
<style>
     *{background: rgb(5, 10, 16)}
    /* تنسيق الكروت */
    .main-wrapper {
        padding: 40px;
        background-color: #0b0f19;
        min-height: 100vh;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }
    .page-header h1 {
        color: white;
        font-size: 28px;
        margin: 0;
    }
    .btn-back {
        background: #374151;
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
    }
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
    }
    .question-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 20px;
        overflow: hidden;
        transition: 0.3s;
    }
    .card-header {
        padding: 15px 20px;
        background: #0f172a;
        border-bottom: 1px solid #1f2937;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .question-title {
        color: white;
        font-weight: bold;
        font-size: 1rem;
    }
    .deleted-date {
        color: #9ca3af;
        font-size: 0.7rem;
    }
    .card-body {
        padding: 20px;
    }
    .question-text {
        color: #cbd5e1;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }
    .quiz-name {
        color: #60a5fa;
        font-size: 0.8rem;
    }
    .card-actions {
        padding: 15px 20px;
        border-top: 1px solid #1f2937;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }
    .btn-restore {
        background: #10b981;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-force {
        background: #ef4444;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-restore:hover { background: #059669; }
    .btn-force:hover { background: #dc2626; }
    .empty-state {
        text-align: center;
        padding: 100px;
        color: #9ca3af;
    }



.dark-swal{
    background:#111827 !important;
    color:white !important;
    border:1px solid #1f2937 !important;
}

.swal2-confirm-custom{
    background:#10b981 !important;
    color:white !important;
    padding:10px 20px;
    border-radius:8px;
}

.swal2-danger-custom{
    background:#ef4444 !important;
    color:white !important;
    padding:10px 20px;
    border-radius:8px;
}

.swal2-cancel-custom{
    background:#374151 !important;
    color:white !important;
    padding:10px 20px;
    border-radius:8px;
}


</style>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="page-header">
        <h1>🗑️ سلة محذوفات الأسئلة</h1>
        <a href="{{ route('questions.index') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> العودة للأسئلة
        </a>
    </div>

    @if($questions->count() > 0)
        <div class="cards-grid">
            @foreach($questions as $question)
            <div class="question-card" id="trash-card-{{ $question->id }}">
                <div class="card-header">
                    <span class="question-title">{{ Str::limit($question->title, 50) }}</span>
                    <span class="deleted-date">حذف: {{ $question->deleted_at->format('Y-m-d') }}</span>
                </div>
                <div class="card-body">
                    <div class="question-text">{{ Str::limit($question->title, 100) }}</div>
                    <div class="quiz-name">📚 الكويز: {{ $question->quizz->title ?? 'غير مرتبط' }}</div>
                </div>
                <div class="card-actions">
                    <button onclick="restoreQuestion({{ $question->id }})" class="btn-restore">
                        <i class="fas fa-undo-alt"></i> استعادة
                    </button>
                    <button onclick="forceDeleteQuestion({{ $question->id }})" class="btn-force">
                        <i class="fas fa-trash-alt"></i> حذف نهائي
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-trash-alt fa-4x" style="margin-bottom: 20px; color: #1f2937;"></i>
            <h3>لا توجد أسئلة محذوفة</h3>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
function restoreQuestion(id) {

    Swal.fire({
        title: 'استعادة السؤال؟',
        text: 'سيتم إعادة السؤال إلى بنك الأسئلة.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'نعم، استعادة',
        cancelButtonText: 'إلغاء',
        customClass: {
            popup: 'dark-swal',
            confirmButton: 'swal2-confirm-custom',
            cancelButton: 'swal2-cancel-custom'
        },
        buttonsStyling: false
    }).then((result) => {

        if (result.isConfirmed) {

            axios.post(`/cms/question/questions_restore/${id}`)
            .then(function (response) {

                const card = document.querySelector(`#trash-card-${id}`);

                if (card) {
                    card.style.transition = "0.5s";
                    card.style.opacity = "0";
                    card.style.transform = "scale(0.8)";

                    setTimeout(() => card.remove(), 500);
                }

                Swal.fire({
                    title: 'تمت الاستعادة',
                    text: 'تم استعادة السؤال بنجاح',
                    icon: 'success',
                    customClass: {
                        popup: 'dark-swal',
                        confirmButton: 'swal2-confirm-custom'
                    },
                    buttonsStyling: false
                });

            })
            .catch(function () {
                Swal.fire({
                    title: 'خطأ',
                    text: 'حدث خطأ أثناء الاستعادة',
                    icon: 'error',
                    customClass: {
                        popup: 'dark-swal',
                        confirmButton: 'swal2-danger-custom'
                    },
                    buttonsStyling: false
                });
            });

        }

    });
}



function forceDeleteQuestion(id) {

    Swal.fire({
        title: 'حذف نهائي؟',
        text: 'لن تتمكن من استعادة هذا السؤال بعد الحذف!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم، احذف',
        cancelButtonText: 'إلغاء',
        customClass: {
            popup: 'dark-swal',
            confirmButton: 'swal2-danger-custom',
            cancelButton: 'swal2-cancel-custom'
        },
        buttonsStyling: false
    }).then((result) => {

        if (result.isConfirmed) {

            axios.delete(`/cms/question/questions_force/${id}`)
            .then(function (response) {

                const card = document.querySelector(`#trash-card-${id}`);

                if (card) {
                    card.style.transition = "0.5s";
                    card.style.opacity = "0";
                    card.style.transform = "scale(0.8)";

                    setTimeout(() => card.remove(), 500);
                }

                Swal.fire({
                    title: 'تم الحذف',
                    text: 'تم حذف السؤال نهائياً',
                    icon: 'success',
                    customClass: {
                        popup: 'dark-swal',
                        confirmButton: 'swal2-danger-custom'
                    },
                    buttonsStyling: false
                });

            })
            .catch(function () {
                Swal.fire({
                    title: 'خطأ',
                    text: 'حدث خطأ أثناء الحذف',
                    icon: 'error',
                    customClass: {
                        popup: 'dark-swal',
                        confirmButton: 'swal2-danger-custom'
                    },
                    buttonsStyling: false
                });
            });

        }

    });
}
</script>
@endsection
