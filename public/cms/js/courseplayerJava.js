
// بيانات الدروس
const lessons = {
    1: {
        title: "مقدمة في لغة جافا",
        description: "في هذا الدرس سنتعرف على أساسيات لغة جافا، تاريخها، واستخداماتها في مجال الأمن السيبراني. سنناقش أهمية جافا في تطوير التطبيقات الآمنة وكيفية استخدامها لبناء أنظمة قوية.",
        duration: "15:30",
        videoUrl: "https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4"
    },
    2: {
        title: "تثبيت JDK وبيئة التطوير",
        description: "تعلم كيفية تثبيت JDK وإعداد بيئة التطوير Eclipse أو IntelliJ IDEA للبدء في برمجة جافا.",
        duration: "20:15",
        videoUrl: "https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4"
    },
    3: {
        title: "كتابة أول برنامج في جافا",
        description: "سنقوم بكتابة أول برنامج 'Hello World' في جافا وفهم بنية البرنامج الأساسية.",
        duration: "18:45",
        videoUrl: "https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4"
    }
};

let currentLesson = 1;
let completedLessons = JSON.parse(localStorage.getItem('completedLessons') || '[]');

// تحميل الدرس
function loadLesson(lessonId) {
    currentLesson = lessonId;
    const lesson = lessons[lessonId];

    // تحديث العنوان والوصف
    document.getElementById('currentLessonTitle').textContent = lesson.title;
    document.getElementById('lessonDescription').textContent = lesson.description;

    // تحديث الفيديو
    const video = document.getElementById('lessonVideo');
    const placeholder = document.getElementById('videoPlaceholder');

    video.style.display = 'none';
    placeholder.style.display = 'flex';

    // تحديث حالة الدروس
    updateLessonStatus();

    // حفظ آخر درس تم الوصول إليه
    localStorage.setItem('lastAccessedLesson', lessonId);

    // تحديث التقدم
    updateProgress();
}

// تشغيل الفيديو
function playVideo() {
    const video = document.getElementById('lessonVideo');
    const placeholder = document.getElementById('videoPlaceholder');

    video.style.display = 'block';
    placeholder.style.display = 'none';
    video.play();
}

// تبديل الوحدة
function toggleModule(moduleId) {
    const lessonsList = document.getElementById('moduleLessons' + moduleId);
    const icon = document.getElementById('moduleIcon' + moduleId);

    lessonsList.classList.toggle('show');
    icon.classList.toggle('fa-chevron-down');
    icon.classList.toggle('fa-chevron-up');
}

// تحديث حالة الدروس
function updateLessonStatus() {
    document.querySelectorAll('.lesson-item').forEach(item => {
        item.classList.remove('active');
        item.classList.remove('completed');
    });

    // وضع علامة على الدرس النشط
    const activeLesson = document.querySelector(`.lesson-item:nth-child(${currentLesson})`);
    if (activeLesson) {
        activeLesson.classList.add('active');
    }

    // وضع علامة على الدروس المكتملة
    completedLessons.forEach(lessonId => {
        const completedLesson = document.querySelector(`.lesson-item:nth-child(${lessonId})`);
        if (completedLesson) {
            completedLesson.classList.add('completed');
        }
    });
}

// الدرس التالي
function nextLesson() {
    if (currentLesson < Object.keys(lessons).length) {
        loadLesson(currentLesson + 1);
    } else {
        alert('هذا هو آخر درس في الوحدة');
    }
}

// الدرس السابق
function previousLesson() {
    if (currentLesson > 1) {
        loadLesson(currentLesson - 1);
    } else {
        alert('هذا هو أول درس');
    }
}

// تحديد كـ مكتمل
function markAsCompleted() {
    if (!completedLessons.includes(currentLesson)) {
        completedLessons.push(currentLesson);
        localStorage.setItem('completedLessons', JSON.stringify(completedLessons));
        updateLessonStatus();
        updateProgress();
        alert('تم تحديد الدرس كمكتمل ✓');
    } else {
        alert('الدرس مكتمل بالفعل');
    }
}

// تحديث شريط التقدم
function updateProgress() {
    const totalLessons = Object.keys(lessons).length;
    const completedCount = completedLessons.length;
    const percentage = Math.round((completedCount / totalLessons) * 100);

    document.getElementById('progressFill').style.width = percentage + '%';
    document.getElementById('progressPercentage').textContent = percentage + '%';
}

// تحميل المواد
function downloadMaterials() {
    alert('جاري تحميل المواد التعليمية...');
    // هنا يمكن إضافة كود التحميل الفعلي
}

// فتح المواد
function openMaterial(type) {
    const materials = {
        pdf: 'ملخص الدرس الأول.pdf',
        code: 'أمثلة الشيفرة.zip',
        quiz: 'اختبار الدرس.html'
    };

    alert('جاري فتح: ' + materials[type]);
    // هنا يمكن إضافة كود فتح الملف
}

// مشاركة الكورس
function shareCourse(platform) {
    const url = window.location.href;
    const text = 'أنا أتعلم دورة جافا للأمن السيبراني على CYBEReye!';

    const shareUrls = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
        twitter: `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`,
        whatsapp: `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`
    };

    window.open(shareUrls[platform], '_blank');
}

// الملاحظات
function takeNotes() {
    const notes = localStorage.getItem('lessonNotes_' + currentLesson) || '';
    document.getElementById('notesText').value = notes;
    document.getElementById('notesModal').style.display = 'flex';
}

function closeNotesModal() {
    document.getElementById('notesModal').style.display = 'none';
}

function saveNotes() {
    const notes = document.getElementById('notesText').value;
    localStorage.setItem('lessonNotes_' + currentLesson, notes);
    closeNotesModal();
    alert('تم حفظ الملاحظات بنجاح');
}

// عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function () {
    // فتح الوحدة الأولى تلقائياً
    toggleModule(1);

    // تحميل آخر درس تم الوصول إليه
    const lastLesson = localStorage.getItem('lastAccessedLesson') || 1;
    loadLesson(parseInt(lastLesson));

    // تحديث التقدم
    updateProgress();

    // تحميل الدرس الأول تلقائياً
    loadLesson(currentLesson);
});

// إغلاق المودال بالنقر خارج المحتوى
window.addEventListener('click', function (e) {
    const modal = document.getElementById('notesModal');
    if (e.target === modal) {
        closeNotesModal();
    }
});
