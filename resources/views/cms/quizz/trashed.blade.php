@extends('cms.parent')

@section('title', 'سلة محذوفات الكويزات')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    *{background: rgb(5, 10, 16)}
    /* نفس التنسيقات التي استخدمتها في التصنيفات مع تعديل الكروت */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }
    .quiz-card {
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
    }
    .quiz-title { color: white; font-weight: bold; }
    .deleted-date { color: #9ca3af; font-size: 0.7rem; }
    .card-body { padding: 20px; color: #cbd5e1; }
    .card-actions {
        padding: 15px 20px;
        border-top: 1px solid #1f2937;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }
    .btn-restore { background: #10b981; color: white; padding: 8px 16px; border-radius: 8px; cursor: pointer; border: none; }
    .btn-force { background: #ef4444; color: white; padding: 8px 16px; border-radius: 8px; cursor: pointer; border: none; }
    .btn-restore:hover { background: #059669; }
    .btn-force:hover { background: #dc2626; }


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
<div style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
        <h1 style="color: white;">🗑️ سلة محذوفات الكويزات</h1>
        <a href="{{ route('quizzs.index') }}" class="btn-back" style="background: #374151; color: white; padding: 8px 20px; border-radius: 8px; text-decoration: none;">← العودة</a>
    </div>

    @if($quizzs->count())
        <div class="cards-grid">
            @foreach($quizzs as $quiz)
            <div class="quiz-card" id="trash-card-{{ $quiz->id }}">
                <div class="card-header">
                    <span class="quiz-title">{{ $quiz->title }}</span>
                    <span class="deleted-date">{{ $quiz->deleted_at->format('Y-m-d') }}</span>
                </div>
                <div class="card-body">
                    {{ $quiz->description ?? 'لا يوجد وصف' }}
                </div>
                  <div class="card-actions">
                    <button onclick="restoreQuizz({{ $quiz->id }})" class="btn-restore">
                        <i class="fas fa-undo-alt"></i> استعادة
                    </button>
                    <button onclick="forceDeleteQuizz({{ $quiz->id }})" class="btn-force">
                        <i class="fas fa-trash-alt"></i> حذف نهائي
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center; padding:100px; color:#9ca3af;">لا توجد كويزات محذوفة</div>
    @endif
</div>
@endsection

@section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
function restoreQuizz(id) {

    Swal.fire({
        title: 'استعادة الكويز؟',
        text: 'سيتم إعادة السؤال إلى بنك الكويزات.',
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

            axios.post(`/cms/quizz/quizzs_restore/${id}`)
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
                    text: 'تم استعادة الكويز بنجاح',
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



function forceDeleteQuizz(id) {

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

            axios.delete(`/cms/quizz/quizzs_force/${id}`)
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
