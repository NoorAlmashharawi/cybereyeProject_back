
        // بيانات المدرسين المعدلة مع أسماء المواد الصحيحة
        const teachers = [
            {
                id: 1,
                name: "أحمد محمد",
                subject: "ethical-hacking",
                subjectName: "الاختراق الأخلاقي",
                experience: 8,
                education: "ماجستير في أمن الشبكات",
                email: "ahmed.security@cybereye.com",
                phone: "+966500123456",
                rating: 4.9,
                available: true,
                bio: "متخصص في الأمن السيبراني مع خبرة 8 سنوات في مجال الاختراق الأخلاقي وحماية الأنظمة"
            },
            {
                id: 2,
                name: "فاطمة علي",
                subject: "programming",
                subjectName: "البرمجة والأمن",
                experience: 5,
                education: "دكتوراه في هندسة الحاسوب",
                email: "fatima.programming@cybereye.com",
                phone: "+966500234567",
                rating: 4.7,
                available: true,
                bio: "خبيرة في تطوير التطبيقات الآمنة ولغات البرمجة مثل Python وJava"
            },
            {
                id: 3,
                name: "خالد حسن",
                subject: "os-security",
                subjectName: "أمن أنظمة التشغيل",
                experience: 12,
                education: "دكتوراه في أمن أنظمة التشغيل",
                email: "khaled.os@cybereye.com",
                phone: "+966500345678",
                rating: 4.8,
                available: true,
                bio: "خبير في تأمين أنظمة Linux وWindows مع خبرة تزيد عن 12 عامًا"
            },
            {
                id: 4,
                name: "سارة عبدالله",
                subject: "forensics",
                subjectName: "الطب الشرعي الرقمي",
                experience: 6,
                education: "بكالوريوس الطب الشرعي والتحقيق الرقمي",
                email: "sara.forensics@cybereye.com",
                phone: "+966500456789",
                rating: 4.6,
                available: true,
                bio: "متخصصة في التحقيقات الرقمية وجمع الأدلة الإلكترونية"
            },
            {
                id: 5,
                name: "محمد إبراهيم",
                subject: "web-security",
                subjectName: "أمن تطبيقات الويب",
                experience: 10,
                education: "بكالوريوس أمن المعلومات",
                email: "mohammed.web@cybereye.com",
                phone: "+966500567890",
                rating: 4.5,
                available: false,
                bio: "خبير في اكتشاف ثغرات تطبيقات الويب وتأمينها"
            },
            {
                id: 6,
                name: "نورة سعيد",
                subject: "programming",
                subjectName: "تطوير البرمجيات الآمنة",
                experience: 4,
                education: "ماجستير في علوم الحاسب",
                email: "noura.development@cybereye.com",
                phone: "+966500678901",
                rating: 4.4,
                available: true,
                bio: "متخصصة في تطوير برمجيات آمنة باستخدام منهجيات التطوير الآمن"
            },
            {
                id: 7,
                name: "ياسين عمر",
                subject: "database-security",
                subjectName: "أمن قواعد البيانات",
                experience: 3,
                education: "هندسة أمن المعلومات",
                email: "yassin.database@cybereye.com",
                phone: "+966500789012",
                rating: 4.2,
                available: true,
                bio: "متخصص في تأمين قواعد البيانات SQL وNoSQL"
            },
            {
                id: 8,
                name: "لينا عبدالرحمن",
                subject: "cybersecurity",
                subjectName: "التدقيق الأمني",
                experience: 7,
                education: "ماجستير في التدقيق الأمني",
                email: "lina.audit@cybereye.com",
                phone: "+966500890123",
                rating: 4.8,
                available: true,
                bio: "خبيرة في تدقيق الأنظمة وتقييم المخاطر الأمنية"
            },
            {
                id: 9,
                name: "عمر كمال",
                subject: "ethical-hacking",
                subjectName: "أدوات الاختراق الأخلاقي",
                experience: 9,
                education: "دكتوراه في الأمن السيبراني",
                email: "omar.tools@cybereye.com",
                phone: "+966500901234",
                rating: 4.9,
                available: false,
                bio: "متخصص في أدوات الاختراق الأخلاقي وتقنيات الاختبار"
            },
            {
                id: 10,
                name: "ريم خالد",
                subject: "os-security",
                subjectName: "أمن خوادم لينكس",
                experience: 6,
                education: "ماجستير في أمن الحواسيب",
                email: "reem.linux@cybereye.com",
                phone: "+966501012345",
                rating: 4.7,
                available: true,
                bio: "متخصصة في تأمين خوادم Linux وأنظمة السحابة"
            },
            {
                id: 11,
                name: "طارق ناصر",
                subject: "programming",
                subjectName: "برمجة الأنظمة الآمنة",
                experience: 2,
                education: "بكالوريوس في هندسة البرمجيات",
                email: "tariq.systems@cybereye.com",
                phone: "+966501123456",
                rating: 4.1,
                available: true,
                bio: "متخصص في برمجة الأنظمة ذات الأمان العالي"
            },
            {
                id: 12,
                name: "هديل وليد",
                subject: "network-security",
                subjectName: "أمن الشبكات المتقدم",
                experience: 5,
                education: "ماجستير في هندسة الحاسوب",
                email: "hadeel.network@cybereye.com",
                phone: "+966501234567",
                rating: 4.6,
                available: true,
                bio: "خبيرة في أمن الشبكات والاتصالات"
            }
        ];

        // عناصر DOM
        const teachersContainer = document.getElementById('teachersContainer');
        const searchInput = document.getElementById('searchInput');
        const subjectFilter = document.getElementById('subjectFilter');
        const experienceFilter = document.getElementById('experienceFilter');
        const totalTeachersElement = document.getElementById('totalTeachers');
        const availableTeachersElement = document.getElementById('availableTeachers');
        const avgRatingElement = document.getElementById('avgRating');

        // عرض جميع المدرسين عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function () {
            displayTeachers(teachers);
            updateStats(teachers);

            // إضافة مستمعي الأحداث
            searchInput.addEventListener('input', filterTeachers);
            subjectFilter.addEventListener('change', filterTeachers);
            experienceFilter.addEventListener('change', filterTeachers);
        });

        // دالة لعرض المدرسين
        function displayTeachers(teachersArray) {
            teachersContainer.innerHTML = '';

            if (teachersArray.length === 0) {
                teachersContainer.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>لا توجد نتائج</h3>
                        <p>لم يتم العثور على مدرسين ينطبقون على معايير البحث الخاصة بك. حاول استخدام مصطلحات بحث مختلفة.</p>
                    </div>
                `;
                return;
            }

            teachersArray.forEach(teacher => {
                const teacherCard = document.createElement('div');
                teacherCard.className = 'teacher-card';

                // إنشاء النجوم بناءً على التقييم
                const stars = getStars(teacher.rating);

                // تحديد نص الخبرة
                let experienceText = '';
                if (teacher.experience >= 5) {
                    experienceText = 'خبرة عالية';
                } else if (teacher.experience >= 2) {
                    experienceText = 'متوسط الخبرة';
                } else {
                    experienceText = 'مبتدئ';
                }

                // لون الخبرة
                let experienceColor = '';
                if (teacher.experience >= 5) {
                    experienceColor = '#4caf50';
                } else if (teacher.experience >= 2) {
                    experienceColor = '#ff9800';
                } else {
                    experienceColor = '#f44336';
                }

                teacherCard.innerHTML = `
                    <div class="teacher-img">
                        <i class="fas fa-user-tie"></i>
                        <span class="availability-badge ${teacher.available ? 'available' : 'unavailable'}">
                            ${teacher.available ? 'متاح' : 'غير متاح'}
                        </span>
                        <span class="experience-badge" style="border: 2px solid ${experienceColor};">
                            ${teacher.experience} سنوات خبرة
                        </span>
                    </div>
                    <div class="teacher-info">
                        <h3 class="teacher-name">${teacher.name}</h3>
                        <span class="teacher-subject">${teacher.subjectName}</span>
                        
                        <div class="teacher-details">
                            <p><i class="fas fa-graduation-cap"></i> ${teacher.education}</p>
                            <p><i class="fas fa-briefcase"></i> ${teacher.experience} سنوات خبرة (${experienceText})</p>
                            <p><i class="fas fa-envelope"></i> ${teacher.email}</p>
                            <p><i class="fas fa-phone"></i> ${teacher.phone}</p>
                            <p><i class="fas fa-info-circle"></i> ${teacher.bio}</p>
                        </div>
                        
                        <div class="teacher-rating">
                            <span class="rating-value">${teacher.rating}</span>
                            <div class="stars">${stars}</div>
                        </div>
                        
                        <div class="teacher-contact">
                            <button class="contact-btn" onclick="contactTeacher(${teacher.id})">
                                <i class="fas fa-phone-alt"></i> اتصل
                            </button>
                            <button class="contact-btn profile" onclick="viewProfile(${teacher.id})">
                                <i class="fas fa-user-circle"></i> الملف الشخصي
                            </button>
                        </div>
                    </div>
                `;

                teachersContainer.appendChild(teacherCard);
            });
        }

        // دالة للحصول على النجوم بناءً على التقييم
        function getStars(rating) {
            let stars = '';
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;

            for (let i = 0; i < fullStars; i++) {
                stars += '<i class="fas fa-star"></i>';
            }

            if (hasHalfStar) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            }

            const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
            for (let i = 0; i < emptyStars; i++) {
                stars += '<i class="far fa-star"></i>';
            }

            return stars;
        }

        // دالة لتصفية المدرسين
        function filterTeachers() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedSubject = subjectFilter.value;
            const selectedExperience = experienceFilter.value;

            const filteredTeachers = teachers.filter(teacher => {
                // البحث بالاسم أو المادة أو السيرة الذاتية
                const matchesSearch = teacher.name.toLowerCase().includes(searchTerm) ||
                    teacher.subjectName.toLowerCase().includes(searchTerm) ||
                    teacher.bio.toLowerCase().includes(searchTerm) ||
                    teacher.education.toLowerCase().includes(searchTerm);

                // التصفية حسب المادة
                const matchesSubject = selectedSubject === 'all' || teacher.subject === selectedSubject;

                // التصفية حسب الخبرة
                let matchesExperience = true;
                if (selectedExperience !== 'all') {
                    if (selectedExperience === 'senior') {
                        matchesExperience = teacher.experience >= 5;
                    } else if (selectedExperience === 'mid') {
                        matchesExperience = teacher.experience >= 2 && teacher.experience < 5;
                    } else if (selectedExperience === 'junior') {
                        matchesExperience = teacher.experience < 2;
                    }
                }

                return matchesSearch && matchesSubject && matchesExperience;
            });

            displayTeachers(filteredTeachers);
            updateStats(filteredTeachers);
        }

        // دالة لتحديث الإحصائيات
        function updateStats(teachersArray) {
            const totalTeachers = teachersArray.length;
            const availableTeachers = teachersArray.filter(teacher => teacher.available).length;

            let totalRating = 0;
            teachersArray.forEach(teacher => {
                totalRating += teacher.rating;
            });
            const avgRating = teachersArray.length > 0 ? (totalRating / teachersArray.length).toFixed(1) : 0;

            totalTeachersElement.textContent = totalTeachers;
            availableTeachersElement.textContent = availableTeachers;
            avgRatingElement.textContent = avgRating;
        }

        // دالة للاتصال بالمدرس
        function contactTeacher(teacherId) {
            const teacher = teachers.find(t => t.id === teacherId);
            if (teacher) {
                if (teacher.available) {
                    if (confirm(`هل تريد الاتصال بالمدرس ${teacher.name} على الرقم ${teacher.phone}؟`)) {
                        window.location.href = `tel:${teacher.phone}`;
                    }
                } else {
                    alert(`المدرس ${teacher.name} غير متاح حاليًا للاتصال. يمكنك إرسال بريد إلكتروني إلى ${teacher.email}`);
                }
            }
        }

        // دالة لعرض الملف الشخصي للمدرس
        function viewProfile(teacherId) {
            const teacher = teachers.find(t => t.id === teacherId);
            if (teacher) {
                const modalHtml = `
                    <div style="
                        position: fixed;
                        top: 0;
                        right: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.8);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        z-index: 1000;
                    " onclick="closeModal()">
                        <div style="
                            background: white;
                            padding: 40px;
                            border-radius: 20px;
                            max-width: 600px;
                            width: 90%;
                            max-height: 90vh;
                            overflow-y: auto;
                            position: relative;
                        " onclick="event.stopPropagation()">
                            <button onclick="closeModal()" style="
                                position: absolute;
                                top: 15px;
                                left: 15px;
                                background: #f44336;
                                color: white;
                                border: none;
                                width: 40px;
                                height: 40px;
                                border-radius: 50%;
                                font-size: 1.5rem;
                                cursor: pointer;
                            ">×</button>
                            
                            <div style="text-align: center; margin-bottom: 30px;">
                                <div style="
                                    width: 120px;
                                    height: 120px;
                                    background: linear-gradient(135deg, #1a237e, #3949ab);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    font-size: 3rem;
                                    margin: 0 auto 20px;
                                ">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <h2 style="color: #1a237e; margin-bottom: 10px;">${teacher.name}</h2>
                                <div style="
                                    display: inline-block;
                                    background: #e8eaf6;
                                    color: #1a237e;
                                    padding: 8px 20px;
                                    border-radius: 20px;
                                    font-weight: bold;
                                    margin-bottom: 20px;
                                ">${teacher.subjectName}</div>
                            </div>
                            
                            <div style="margin-bottom: 25px;">
                                <h3 style="color: #1a237e; margin-bottom: 15px; border-bottom: 2px solid #e8eaf6; padding-bottom: 10px;">
                                    <i class="fas fa-info-circle"></i> المعلومات الشخصية
                                </h3>
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                                    <div>
                                        <strong><i class="fas fa-graduation-cap"></i> المؤهل العلمي:</strong>
                                        <p>${teacher.education}</p>
                                    </div>
                                    <div>
                                        <strong><i class="fas fa-briefcase"></i> سنوات الخبرة:</strong>
                                        <p>${teacher.experience} سنوات</p>
                                    </div>
                                    <div>
                                        <strong><i class="fas fa-star"></i> التقييم:</strong>
                                        <p>${teacher.rating} / 5.0</p>
                                    </div>
                                    <div>
                                        <strong><i class="fas fa-user-check"></i> الحالة:</strong>
                                        <p>${teacher.available ? 'متاح' : 'غير متاح'}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 25px;">
                                <h3 style="color: #1a237e; margin-bottom: 15px; border-bottom: 2px solid #e8eaf6; padding-bottom: 10px;">
                                    <i class="fas fa-user-graduate"></i> نبذة عن المدرس
                                </h3>
                                <p style="line-height: 1.8; color: #555;">${teacher.bio}</p>
                            </div>
                            
                            <div style="margin-bottom: 25px;">
                                <h3 style="color: #1a237e; margin-bottom: 15px; border-bottom: 2px solid #e8eaf6; padding-bottom: 10px;">
                                    <i class="fas fa-address-card"></i> معلومات الاتصال
                                </h3>
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                                    <div>
                                        <strong><i class="fas fa-envelope"></i> البريد الإلكتروني:</strong>
                                        <p>${teacher.email}</p>
                                    </div>
                                    <div>
                                        <strong><i class="fas fa-phone"></i> رقم الهاتف:</strong>
                                        <p>${teacher.phone}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 15px; justify-content: center;">
                                <button onclick="contactTeacher(${teacher.id}); closeModal()" style="
                                    background: linear-gradient(135deg, #1a237e, #3949ab);
                                    color: white;
                                    border: none;
                                    padding: 12px 30px;
                                    border-radius: 10px;
                                    cursor: pointer;
                                    font-weight: bold;
                                    display: flex;
                                    align-items: center;
                                    gap: 10px;
                                ">
                                    <i class="fas fa-phone-alt"></i> الاتصال
                                </button>
                                <button onclick="sendEmail('${teacher.email}')" style="
                                    background: linear-gradient(135deg, #4caf50, #45a049);
                                    color: white;
                                    border: none;
                                    padding: 12px 30px;
                                    border-radius: 10px;
                                    cursor: pointer;
                                    font-weight: bold;
                                    display: flex;
                                    align-items: center;
                                    gap: 10px;
                                ">
                                    <i class="fas fa-envelope"></i> إرسال بريد
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                const modal = document.createElement('div');
                modal.innerHTML = modalHtml;
                document.body.appendChild(modal);
                document.body.style.overflow = 'hidden';
            }
        }

        // دالة لإغلاق النافذة المنبثقة
        function closeModal() {
            const modal = document.querySelector('div[style*="position: fixed; top: 0; right: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8);"]');
            if (modal) {
                modal.remove();
                document.body.style.overflow = 'auto';
            }
        }

        // دالة لإرسال بريد إلكتروني
        function sendEmail(email) {
            window.location.href = `mailto:${email}?subject=استفسار عن دورات CyberEye&body=أهلاً وسهلاً، أود الاستفسار عن الدورات التي تقدمونها...`;
        }
