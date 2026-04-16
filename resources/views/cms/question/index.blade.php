@extends('cms.parent')

@section('title', 'قائمة الأسئلة')

@section('styles')
      <link rel="stylesheet" href="{{ asset('cms/css/quesstion.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="app-layout">
    <div class="main-content">
        <div class="header-bar">
    <h2>📋 بنك الأسئلة</h2>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('questions_trashed') }}" class="btn-primary" style="background: #374151;">
            <i class="fas fa-archive"></i> الأرشيف
        </a>
        <a href="{{ route('questions.create') }}" class="btn-primary">+ إضافة سؤال جديد</a>
    </div>
</div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="cards-grid">
            @forelse($questions as $question)
                <div class="question-card" id="card-{{ $question->id }}">
                    <div class="card-header">
                        <span class="question-type">📌 اختيار من متعدد</span>
                        <div class="points-dropdown">
                            <span class="question-points" onclick="toggleDropdown({{ $question->id }})">⚡ {{ $question->points }} نقطة</span>
                            <div id="dropdown-{{ $question->id }}" class="dropdown-menu">
                                <button onclick="deleteQuestion({{ $question->id }})">🗑️ حذف السؤال بالكامل مع خياراته</button>
                                <a href="{{ route('questions.edit', $question->id) }}">✏️ تعديل السؤال</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="question-text">{{ $question->title }}</div>
                        <div class="quiz-name">📚 الكويز: {{ $question->quizz->title ?? 'غير مرتبط' }}</div>
                        <div class="options-list">
                            @php
                                $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                            @endphp
                            @if(is_array($options))
                                @foreach($options as $idx => $opt)
                                    <div class="option-item">
                                        <span class="option-letter">{{ chr(65+$idx) }}</span>
                                        <span class="option-text">{{ $opt }}</span>
                                        @if($opt === $question->correct_answer)
                                            <span style="color:#4ade80;"> ✓ صحيحة</span>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!--<div class="correct-badge">✅ الإجابة الصحيحة: {{ $question->correct_answer }}</div>-->
                    </div>
                    <div class="card-actions">


                       <a href="{{ route('questions.edit', $question->id)  }}"
                           class="btn-action btn-edit-custom">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" onclick="confirmArchive({{ $question->id }})" class="btn-action btn-delete-custom" title="نقل إلى الأرشيف">
                         <i class="fas fa-trash-alt"></i>
                        </button>

                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 48px; color:#9ca3af;">🚀 لا توجد أسئلة حالياً. <a href="{{ route('questions.create') }}" style="color:#60a5fa;">أضف أول سؤال</a></div>
            @endforelse
        </div>
        <div class="pagination">{{ $questions->links() }}</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleDropdown(id) {
        const menu = document.getElementById(`dropdown-${id}`);
        const allMenus = document.querySelectorAll('.dropdown-menu');
        allMenus.forEach(m => { if (m.id !== `dropdown-${id}`) m.style.display = 'none'; });
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
    window.onclick = function(e) {
        if (!e.target.classList.contains('question-points')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
        }
    }

  function confirmArchive(id) {
        Swal.fire({
            title: 'نقل إلى الأرشيف؟',
            text: "سيختفي هذا السؤال من القائمة، ويمكنك استعادته من الأرشيف.",
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
            if (result.isConfirmed) {
                performArchive(id);
            }
        });
    }

    function performArchive(id) {
        axios.delete(`/cms/question/questions/${id}`)
            .then(function (response) {
                const card = document.querySelector(`#card-${id}`);
                if (card) {
                    card.style.transition = "all 0.5s ease";
                    card.style.transform = "scale(0.8)";
                    card.style.opacity = "0";
                    setTimeout(() => card.remove(), 500);
                }
                Swal.fire('تم الأرشفة', response.data.message || 'تم نقل السؤال إلى الأرشيف', 'success');
            })
            .catch(error => {
                Swal.fire('خطأ', 'حدث خطأ أثناء الأرشفة', 'error');
            });
    }
</script>


</script>
@endsection





