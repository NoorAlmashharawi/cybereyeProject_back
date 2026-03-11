       // تأثير الخلفية التعليمية
        function createStudentAnimation() {
            const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            const fontSize = 20;
            const columns = Math.floor(window.innerWidth / fontSize);
            const studentAnimation = document.getElementById('studentAnimation');
            
            for (let i = 0; i < columns; i++) {
                const code = document.createElement('div');
                code.className = 'student-code';
                code.style.left = `${i * fontSize}px`;
                code.style.animationDuration = `${Math.random() * 10 + 10}s`;
                code.style.animationDelay = `${Math.random() * 5}s`;
                studentAnimation.appendChild(code);
                
                // تحديث النص بشكل دوري
                setInterval(() => {
                    let text = '';
                    for (let j = 0; j < 20; j++) {
                        text += chars[Math.floor(Math.random() * chars.length)] + '<br>';
                    }
                    code.innerHTML = text;
                }, 100);
            }
        }

        // تحديث عرض المعدل التراكمي
        function updateGPADisplay() {
            const gpaInput = document.getElementById('gpa');
            const gpaDisplay = document.getElementById('gpaDisplay');
            const gpaValue = gpaInput.value || 0;
            
            gpaDisplay.textContent = `المعدل: ${gpaValue} من 5.0`;
            
            // تغيير اللون بناءً على المعدل
            if (gpaValue >= 4.5) {
                gpaDisplay.style.color = '#065f46';
                gpaDisplay.style.backgroundColor = '#d1fae5';
            } else if (gpaValue >= 3.5) {
                gpaDisplay.style.color = '#1e40af';
                gpaDisplay.style.backgroundColor = '#dbeafe';
            } else if (gpaValue >= 2.5) {
                gpaDisplay.style.color = '#92400e';
                gpaDisplay.style.backgroundColor = '#fef3c7';
            } else {
                gpaDisplay.style.color = '#dc2626';
                gpaDisplay.style.backgroundColor = '#fee2e2';
            }
        }



        // التحقق من صحة النموذج
        function validateForm() {
            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const studentId = document.getElementById('studentId').value.trim();
            const major = document.getElementById('major').value;
            const academicLevel = document.querySelector('input[name="academicLevel"]:checked');
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const status = document.getElementById('status').value;
            const birthDate = document.getElementById('birthDate').value;
            const nationalId = document.getElementById('nationalId').value.trim();
            
            // التحقق من الحقول المطلوبة
            if (!fullName || !email || !studentId || !major || !academicLevel || !username || !password || !confirmPassword || !status || !birthDate || !nationalId) {
                showError('يرجى ملء جميع الحقول المطلوبة');
                return false;
            }
            
            // التحقق من صحة البريد الإلكتروني
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('البريد الإلكتروني غير صحيح');
                return false;
            }
            
      
            // التحقق من رقم الهوية
            const nationalIdRegex = /^\d{10}$|^\d{14}$/;
            if (!nationalIdRegex.test(nationalId)) {
                showError('رقم الهوية / الإقامة يجب أن يكون 10 أو 14 رقم');
                return false;
            }
            
            // التحقق من تاريخ الميلاد
            const birth = new Date(birthDate);
            const today = new Date();
            const age = today.getFullYear() - birth.getFullYear();
            
            if (age < 16) {
                showError('يجب أن يكون عمر الطالب 16 سنة على الأقل');
                return false;
            }
            
            // التحقق من تطابق كلمات المرور
            if (password !== confirmPassword) {
                showError('كلمتا المرور غير متطابقتين');
                return false;
            }
            
            // التحقق من قوة كلمة المرور
            if (password.length < 8) {
                showError('كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل');
                return false;
            }
            
       
            return true;
        }

        // إظهار رسالة الخطأ
        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');
            
            errorMessage.textContent = message;
            errorAlert.style.display = 'flex';
            
            // إخفاء الرسالة بعد 5 ثواني
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 5000);
            
            // تمرير الصفحة للأعلى لرؤية الرسالة
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // إظهار رسالة النجاح
        function showSuccess() {
            const successAlert = document.getElementById('successAlert');
            
            successAlert.style.display = 'flex';
            
            // إخفاء الرسالة بعد 5 ثواني
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000);
            
            // تمرير الصفحة للأعلى لرؤية الرسالة
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // إرسال النموذج
        function submitForm(event) {
            event.preventDefault();
            
            // التحقق من صحة النموذج
            if (!validateForm()) {
                return;
            }
            
            // محاكاة إرسال البيانات إلى الخادم
            const formData = new FormData(document.getElementById('addStudentForm'));
            const data = {};
            
            formData.forEach((value, key) => {
                if (key === 'hobbies') {
                    if (!data[key]) data[key] = [];
                    data[key].push(value);
                } else {
                    data[key] = value;
                }
            });
            
            // عرض البيانات المرسلة في الكونسول (للأغراض التعليمية)
            console.log('بيانات الطالب المرسلة:', data);
            
            // إظهار رسالة النجاح
            showSuccess();
            
            // إعادة تعيين النموذج بعد تأخير
            setTimeout(() => {
                document.getElementById('addStudentForm').reset();
                updatePreview();
                updateGPADisplay();
                
                // إظهار رسالة إضافية
                alert('تم إضافة الطالب الجديد بنجاح!\n\nسيتم توجيهك إلى صفحة عرض الطلاب.');
                
                // في التطبيق الحقيقي، يمكن توجيه المستخدم إلى صفحة أخرى
                // window.location.href = 'display.html';
            }, 1000);
        }

        // تهيئة الصفحة عند التحميل
        document.addEventListener('DOMContentLoaded', function() {
            createStudentAnimation();
            
            // تعيين تاريخ اليوم كتاريخ افتراضي للتسجيل
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('enrollmentDate').value = today;
            
            // تعيين تاريخ ميلاد افتراضي (18 سنة من اليوم)
            const birthDate = new Date();
            birthDate.setFullYear(birthDate.getFullYear() - 18);
            document.getElementById('birthDate').value = birthDate.toISOString().split('T')[0];
            
     

            // زر العودة
            document.querySelector('.back-btn').addEventListener('click', function(e) {
                e.preventDefault();
                alert('سيتم توجيهك إلى صفحة العرض الرئيسية');
                // في التطبيق الحقيقي: window.location.href = 'index.html';
            });


        });