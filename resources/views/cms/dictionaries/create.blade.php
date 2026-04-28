@extends('cms.parent')

@section('title', 'إضافة مصطلح')
@section('main-title', 'إضافة مصطلح جديد')
@section('sub-title', 'أضف مصطلحاً إلى القاموس الذكي')

@section('styles')
<style>
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 80vh;
        padding: 30px;
        border-radius: 20px;
    }
    
    .custom-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
    }
    
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.2);
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #1a237e, #283593);
        padding: 20px 25px;
        border-bottom: none;
    }
    
    .card-header-custom h3 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .card-header-custom h3 i {
        font-size: 1.5rem;
    }
    
    .card-body-custom {
        padding: 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }
    
    .form-group label i {
        margin-left: 8px;
        color: #667eea;
    }
    
    .form-control {
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .card-footer-custom {
        background: #f8f9fc;
        border-top: 1px solid #e9ecef;
        padding: 20px 30px;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 10px 28px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-secondary {
        background: #95a5a6;
        border: none;
        padding: 10px 28px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #7f8c8d;
        transform: translateY(-2px);
    }
    
    .required-star {
        color: #e74c3c;
        margin-right: 4px;
    }
    
    @media (max-width: 768px) {
        .card-body-custom {
            padding: 20px;
        }
        .card-footer-custom {
            flex-direction: column;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h3>
                        <i class="fas fa-plus-circle"></i>
                        إضافة مصطلح جديد
                    </h3>
                </div>
                <form id="createForm">
                    @csrf
                    <div class="card-body-custom">
                        <div class="form-group">
                            <label>
                                <i class="fas fa-terminal"></i>
                                <span class="required-star">*</span> المصطلح
                            </label>
                            <input type="text" class="form-control" id="term" name="term" 
                                   placeholder="مثال: Phishing, Malware, Firewall" required>
                            <small class="text-muted">أدخل المصطلح باللغة الإنجليزية أو العربية</small>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <i class="fas fa-align-left"></i>
                                <span class="required-star">*</span> التعريف
                            </label>
                            <textarea class="form-control" id="definition" name="definition" 
                                      rows="4" placeholder="شرح تفصيلي للمصطلح..." required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <i class="fas fa-tag"></i>
                                التصنيف
                            </label>
                            <input type="text" class="form-control" id="category" name="category" 
                                   placeholder="مثال: أمن سيبراني, برمجيات, Laravel, شبكات">
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <i class="fas fa-lightbulb"></i>
                                مثال تطبيقي
                            </label>
                            <textarea class="form-control" id="example" name="example" 
                                      rows="3" placeholder="مثال توضيحي للمصطلح..."></textarea>
                            <small class="text-muted">مثال: "تلقى البريد الإلكتروني الاحتيالي واستطاع اكتشافه بسهولة"</small>
                        </div>
                    </div>
                    <div class="card-footer-custom">
                        <a href="{{ route('dictionary.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> إلغاء
                        </a>
                        <button type="button" onclick="storeTerm()" class="btn btn-primary">
                            <i class="fas fa-save"></i> حفظ المصطلح
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function storeTerm() {
        // التحقق من الحقول المطلوبة
        let term = document.getElementById('term').value.trim();
        let definition = document.getElementById('definition').value.trim();
        
        if (!term) {
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'الرجاء إدخال المصطلح'
            });
            return;
        }
        
        if (!definition) {
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'الرجاء إدخال التعريف'
            });
            return;
        }
        
        let formData = new FormData();
        formData.append('term', term);
        formData.append('definition', definition);
        formData.append('category', document.getElementById('category').value.trim());
        formData.append('example', document.getElementById('example').value.trim());

        axios.post('{{ route("dictionary.store") }}', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(function(response) {
            if (response.data.icon === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'تم الحفظ!',
                    text: response.data.title,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'حسناً'
                }).then(() => {
                    window.location.href = response.data.redirect;
                });
            }
        })
        .catch(function(error) {
            let errorMsg = 'حدث خطأ أثناء حفظ المصطلح';
            if (error.response?.data?.title) {
                errorMsg = error.response.data.title;
            }
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: errorMsg,
                confirmButtonColor: '#d33'
            });
        });
    }
</script>
@endsection