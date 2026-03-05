@extends('cms.parent')



@section('title', 'show student')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/addStudent.css') }}" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection

@section('content')

    <div class="form-container">
        <h2 class="form-title">
            <i class="fas fa-lock"></i> معلومات النظام
        </h2>


        <div class="form-row">
            <div class="form-group">
                <label for="username"> المعرف *</label>
                <input type="text" id="username" name="username" disabled   value="{{ $students->id }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> الرقم الخاص بالمستخدم
                </div>
            </div>

        <div class="form-row">
            <div class="form-group">
                <label for="username">اسم المستخدم *</label>
                <input type="text" id="username" name="username" disabled  placeholder="أدخل اسم المستخدم للنظام" value="{{ $students->username }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> اسم المستخدم الذي سيستخدمه للدخول إلى النظام
                </div>
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور *</label>
                <input type="password" id="password" name="password" disabled required placeholder="كلمة مرور قوية" value="{{ $students->password }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> يجب أن تحتوي على 8 أحرف على الأقل
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="confirmPassword">تأكيد كلمة المرور *</label>
            <input type="password" id="confirmPassword" name="confirmPassword" disabled required placeholder="أعد إدخال كلمة المرور" value="{{ $students->password }}">
            <div class="form-help">
                <i class="fas fa-info-circle"></i> تأكد من تطابق كلمة المرور مع الحقل السابق
            </div>
        </div>


        <div class="form-row">
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" id="email" name="email" disabled required placeholder=" email"  value="{{ $students->email }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> الايميل المستخدم لتسجيل الدخول
                </div>
            </div>

            <div class="form-group">
                <label for="level">المستوى</label>
                <select id="level" name="level" required disabled value="{{ $students->level }}">
                    <option value="">اختر المستوى</option>
                    <option value="advanced">متقدم</option>
                    <option value="beginner">مبتدئ </option>
                    <option value="midium">متوسط </option>
                    <option value="expert">خبير</option>
                </select>
                <div class="form-help">
                    <i class="fas fa-info-circle"></i>   مستوى الطالب
                      
                    لنظام
                </div>
            </div>



        <div class="form-group">
            <label for="status">حالة الطالب *</label>
            <select id="status" name="status" disabled required value="{{ $students->status }}">
                <option value="">اختر الحالة</option>
                <option value="active">نشط</option>
                <option value="inactive">غير نشط</option>
                <option value="suspended">موقوف مؤقتاً</option>
                <option value="graduated">متخرج</option>
                <option value="transferred">منقول</option>
            </select>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> الحالة الحالية للطالب في النظام
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('students.index') }}" type="reset" class="btn btn-secondary">
           رجوع 
        </a>


    </div>
    </form>


    </div>
@endsection

@section('scripts')
<script src="{{ asset('cms/js/addStudent.js') }}">
@endsection
