
// عند تحميل الصفحة


/*     document.addEventListener('DOMContentLoaded', function() {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    
    if (!currentUser || currentUser.role !== 'instructor') {
        window.location.href = 'login.html';
        return;
    }
    
    // عرض بيانات المدرب
    document.getElementById('instructorName').textContent = currentUser.firstName;
    document.getElementById('instructorEmail').textContent = currentUser.email;
    document.getElementById('instructorAvatar').textContent = currentUser.firstName.charAt(0);
    
    // تحميل البيانات
    loadInstructorData();
});*/

// تحميل بيانات المدرب
function loadInstructorData() {
    // تحميل الكورسات
    const courses = [
        {
            id: 1,
            title: 'أساسيات الأمن السيبراني',
            students: 120,
            rating: 4.9,
            revenue: 8500
        },
        {
            id: 2,
            title: 'برمجة جافا للأمن',
            students: 85,
            rating: 4.7,
            revenue: 6200
        },
        {
            id: 3,
            title: 'أمن تطبيقات الويب',
            students: 45,
            rating: 4.8,
            revenue: 4500
        }
    ];
    
    const coursesTable = document.getElementById('coursesTable');
    coursesTable.innerHTML = '';
    
    courses.forEach(course => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><strong>${course.title}</strong></td>
            <td><span class="stats-circle high-stats">${course.students}</span></td>
            <td>${'★'.repeat(Math.floor(course.rating))} (${course.rating})</td>
            <td>$${course.revenue}</td>
            <td>
                <button class="action-btn edit-btn" onclick="editCourse(${course.id})">
                    <i class="fas fa-edit"></i>
                    تعديل
                </button>
                <button class="action-btn view-btn" onclick="viewCourse(${course.id})">
                    <i class="fas fa-eye"></i>
                    عرض
                </button>
            </td>
        `;
        coursesTable.appendChild(row);
    });
    
    // تحميل الطلاب
    const students = [
        { name: 'محمد أحمد', course: 'الأساسيات', progress: 85 },
        { name: 'سارة محمد', course: 'جافا', progress: 60 },
        { name: 'أحمد خالد', course: 'تطبيقات ويب', progress: 95 },
        { name: 'فاطمة علي', course: 'الأساسيات', progress: 30 },
        { name: 'خالد سعيد', course: 'جافا', progress: 75 }
    ];
    
    const studentsList = document.getElementById('studentsList');
    studentsList.innerHTML = '';
    
    students.forEach(student => {
        const studentItem = document.createElement('div');
        studentItem.className = 'student-item';
        studentItem.innerHTML = `
            <div class="student-avatar">${student.name.charAt(0)}</div>
            <div class="student-info">
                <div class="student-name">${student.name}</div>
                <div class="student-course">${student.course} - ${student.progress}%</div>
            </div>
            <div class="stats-circle ${getProgressClass(student.progress)}">
                ${student.progress}%
            </div>
        `;
        studentsList.appendChild(studentItem);
    });
}

// الحصول على فئة التقدم
function getProgressClass(progress) {
    if (progress >= 70) return 'high-stats';
    if (progress >= 40) return 'medium-stats';
    return 'low-stats';
}

// إضافة كورس جديد
function addNewCourse() {
    alert('فتح نموذج إضافة كورس جديد');
    // هنا يتم فتح نموذج إضافة كورس
}

// تعديل كورس
function editCourse(courseId) {
    alert(`تعديل الكورس ${courseId}`);
}

// عرض كورس
function viewCourse(courseId) {
    alert(`عرض الكورس ${courseId}`);
}

// تسجيل الخروج
function logout() {
    localStorage.removeItem('currentUser');
    window.location.href = 'login.html';
}