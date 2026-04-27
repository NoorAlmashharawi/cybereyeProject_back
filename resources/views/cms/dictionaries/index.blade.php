@extends('cms.parent')

@section('title', 'إدارة القاموس')
@section('main-title', 'القاموس الذكي')
@section('sub-title', 'إدارة مصطلحات القاموس')

@section('styles')
<style>
    /* تنسيق شبكة الكاردات */
    .terms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        padding: 20px 0;
    }

    /* الكارد */
    .term-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .term-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1a237e, #4caf50, #1a237e);
        background-size: 200% 100%;
        animation: gradientMove 3s ease infinite;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

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

    /* تأخير ظهور الكاردات يدوياً */
    .term-card:nth-child(1) { animation-delay: 0.05s; }
    .term-card:nth-child(2) { animation-delay: 0.1s; }
    .term-card:nth-child(3) { animation-delay: 0.15s; }
    .term-card:nth-child(4) { animation-delay: 0.2s; }
    .term-card:nth-child(5) { animation-delay: 0.25s; }
    .term-card:nth-child(6) { animation-delay: 0.3s; }
    .term-card:nth-child(7) { animation-delay: 0.35s; }
    .term-card:nth-child(8) { animation-delay: 0.4s; }
    .term-card:nth-child(9) { animation-delay: 0.45s; }
    .term-card:nth-child(10) { animation-delay: 0.5s; }
    .term-card:nth-child(11) { animation-delay: 0.55s; }
    .term-card:nth-child(12) { animation-delay: 0.6s; }
    .term-card:nth-child(13) { animation-delay: 0.65s; }
    .term-card:nth-child(14) { animation-delay: 0.7s; }
    .term-card:nth-child(15) { animation-delay: 0.75s; }
    .term-card:nth-child(16) { animation-delay: 0.8s; }
    .term-card:nth-child(17) { animation-delay: 0.85s; }
    .term-card:nth-child(18) { animation-delay: 0.9s; }
    .term-card:nth-child(19) { animation-delay: 0.95s; }
    .term-card:nth-child(20) { animation-delay: 1s; }

    .term-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(26, 35, 126, 0.15);
        border-color: rgba(26, 35, 126, 0.1);
    }

    /* رأس الكارد */
    .card-header-custom {
        background: linear-gradient(135deg, #1a237e, #283593);
        padding: 20px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .card-header-custom::after {
        content: '🔒';
        position: absolute;
        bottom: -10px;
        right: -10px;
        font-size: 80px;
        opacity: 0.1;
        transform: rotate(-15deg);
    }

    .term-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .term-title i {
        font-size: 1.3rem;
        opacity: 0.9;
    }

    .term-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        margin-top: 8px;
    }

    /* جسم الكارد */
    .card-body-custom {
        padding: 20px;
    }

    .term-definition {
        color: #374151;
        line-height: 1.7;
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    .term-category {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #e8eaf6;
        color: #1a237e;
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .term-example {
        background: #fff8e1;
        padding: 12px 15px;
        border-radius: 12px;
        margin-top: 15px;
        color: #e65100;
        font-size: 0.85rem;
        border-right: 3px solid #ff9800;
    }

    .term-example i {
        margin-left: 8px;
        color: #ff9800;
    }

    /* أزرار الإجراءات */
    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-edit, .btn-delete {
        flex: 1;
        padding: 8px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: linear-gradient(135deg, #4caf50, #45a049);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #f44336, #d32f2f);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
    }

    /* كارد خالي */
    .empty-card {
        text-align: center;
        padding: 60px 20px;
        background: linear-gradient(135deg, #f8f9fc, #ffffff);
        border-radius: 20px;
    }

    .empty-card i {
        font-size: 4rem;
        color: #1a237e;
        opacity: 0.5;
        margin-bottom: 20px;
    }

    /* رأس الصفحة */
    .page-header-custom {
        background: linear-gradient(135deg, #1a237e, #0d1b5e);
        border-radius: 20px;
        padding: 25px 30px;
        margin-bottom: 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .page-header-custom::before {
        content: '🔐';
        position: absolute;
        top: -20px;
        right: -20px;
        font-size: 120px;
        opacity: 0.05;
    }

    .page-header-custom h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .page-header-custom p {
        margin: 10px 0 0;
        opacity: 0.8;
    }

    .btn-add {
        background: white;
        color: #1a237e;
        border: none;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
       left: 20px;
       top: 20px;
       position: absolute
       
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
        color: #1a237e;
    }

    /* تحسينات للشاشات الصغيرة */
    @media (max-width: 768px) {
        .terms-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .term-title {
            font-size: 1.2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
     
        <div class="page-header-custom d-flex justify-content-between align-items-center flex-wrap" style="gap: 15px;">
            <div>
                <h3><i class="fas fa-book-open"></i> القاموس الذكي</h3>
                <p>استعرض جميع المصطلحات الأمنية والتقنية في مكان واحد</p>
            </div>
            <div>
                <a href="{{ route('dictionary.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> إضافة مصطلح جديد
                </a>
            </div>
        </div>

        <!-- شبكة الكاردات -->
        @if($terms->count() > 0)
        <div class="terms-grid">
            @foreach($terms as $term)
            <div class="term-card">
                <div class="card-header-custom">
                    <div class="term-title">
                        <i class="fas fa-shield-alt"></i>
                        {{ $term->term }}
                    </div>
                    @if($term->category)
                        <div class="term-badge">
                            <i class="fas fa-tag"></i> {{ $term->category }}
                        </div>
                    @endif
                </div>
                <div class="card-body-custom">
                    <div class="term-definition">
                        {{ $term->definition }}
                    </div>
                    @if($term->example)
                        <div class="term-example">
                            <i class="fas fa-lightbulb"></i> مثال: {{ $term->example }}
                        </div>
                    @endif
                    <div class="action-buttons">
                        <a href="{{ route('dictionary.edit', $term->id) }}" class="btn-edit">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <button onclick="deleteTerm({{ $term->id }})" class="btn-delete">
                            <i class="fas fa-trash-alt"></i> حذف
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- الترقيم -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $terms->links() }}
        </div>
        @else
        <div class="empty-card">
            <i class="fas fa-book"></i>
            <h4>لا توجد مصطلحات في القاموس</h4>
            <p>أضف أول مصطلح الآن!</p>
            <a href="{{ route('dictionary.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus"></i> إضافة مصطلح جديد
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteTerm(id) {
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "لن تتمكن من استعادة هذا المصطلح!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم، احذف',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/cms/home/dictionary/${id}`, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'تم الحذف',
                    text: response.data.title,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            })
            .catch(function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: error.response?.data?.title || 'حدث خطأ'
                });
            });
        }
    });
}
</script>
@endsection