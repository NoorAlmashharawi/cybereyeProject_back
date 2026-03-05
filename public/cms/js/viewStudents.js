
// عناصر DOM
const studentsTableBody = document.getElementById('studentsTableBody');
const searchInput = document.getElementById('searchInput');
const skillFilter = document.getElementById('skillFilter');
const specializationFilter = document.getElementById('specializationFilter');
const scanBtn = document.getElementById('scanBtn');
const addStudentBtn = document.getElementById('addStudentBtn');
const totalStudentsElement = document.getElementById('totalStudents');
const certCountElement = document.getElementById('certCount');
const avgSkillElement = document.getElementById('avgSkill');
const threatsNeutralizedElement = document.getElementById('threatsNeutralized');
const noResultsMessage = document.getElementById('noResultsMessage');

const matrixAnimation = document.getElementById('matrixAnimation');

// إعدادات الترقيم
let currentPage = 1;
const rowsPerPage = 10;
let currentSortColumn = null;
let sortDirection = 'asc';

// عرض جميع الطلاب عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    createMatrixAnimation();
    displayStudentsTable(cyberStudents);
    updateStats(cyberStudents);
    
    
    // إضافة مستمعي الأحداث
    searchInput.addEventListener('input', filterStudents);
    skillFilter.addEventListener('change', filterStudents);
    specializationFilter.addEventListener('change', filterStudents);
    scanBtn.addEventListener('click', runSecurityScan);
    addStudentBtn.addEventListener('click', addCyberSpecialist);
});

// دالة لإنشاء تأثير المصفوفة
function createMatrixAnimation() {
    const chars = "01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン";
    const fontSize = 20;
    const columns = Math.floor(window.innerWidth / fontSize);
    
    for (let i = 0; i < columns; i++) {
        const code = document.createElement('div');
        code.className = 'matrix-code';
        code.style.left = `${i * fontSize}px`;
        code.style.animationDuration = `${Math.random() * 10 + 10}s`;
        code.style.animationDelay = `${Math.random() * 5}s`;
        matrixAnimation.appendChild(code);
        
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

// دالة لعرض جدول الطالب
function displayStudentsTable(studentsArray) {
    studentsTableBody.innerHTML = '';
    
    if (studentsArray.length === 0) {
        noResultsMessage.style.display = 'block';
        return;
    } else {
        noResultsMessage.style.display = 'none';
    }
    
    // حساب نطاق الصفوف للصفحة الحالية
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const pageStudents = studentsArray.slice(startIndex, endIndex);
    
    pageStudents.forEach((student, index) => {
        const row = document.createElement('tr');
        
        // تحديد فئة مستوى المهارة
        let skillClass = '';
        switch(student.skill) {
            case 'beginner': skillClass = 'skill-beginner'; break;
            case 'intermediate': skillClass = 'skill-intermediate'; break;
            case 'advanced': skillClass = 'skill-advanced'; break;
            case 'expert': skillClass = 'skill-expert'; break;
        }
        
        // تحديد حالة الطالب
        const statusClass = student.status === 'active' ? 'status-active' : 'status-inactive';
        const statusText = student.status === 'active' ? 'نشط' : 'غير نشط';
        
        // إنشاء شارات الشهادات
        let certsHTML = '';
        if (student.certs.length > 0) {
            student.certs.forEach(cert => {
                certsHTML += `<span class="cert-badge">${cert}</span> `;
            });
        } else {
            certsHTML = '<span style="color: #8b949e; font-size: 0.9rem;">لا توجد شهادات</span>';
        }
        
        row.innerHTML = `
            <td><span class="cyber-badge">${student.id}</span></td>
            <td>
                <div class="student-name">${student.username}</div>
                
            </td>
            <td>
                <div class="student-id">${student.email}</div>
            </td>
            <td>
                <span class="skill-level ${skillClass}">${student.level}</span>
            </td>
            <td>
                <span class="specialization">${student.specializationText}</span>
            </td>
            <td>
                ${certsHTML}
            </td>
            <td>
                <span class="status ${statusClass}">${statusText}</span>
            </td>
            <td>
                <div class="actions">
                    <button class="action-btn view" onclick="viewStudent(${student.id})" title="عرض التفاصيل">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn edit" onclick="editStudent(${student.id})" title="تعديل الملف">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-btn delete" onclick="deleteStudent(${student.id})" title="إزالة الطالب">
                        <i class="fas fa-user-slash"></i>
                    </button>
                </div>
            </td>
        `;
        
        studentsTableBody.appendChild(row);
    });
    

}



// دالة لتصفية الطلاب
function filterStudents() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedSkill = skillFilter.value;
    const selectedSpecialization = specializationFilter.value;
    
    const filteredStudents = cyberStudents.filter(student => {
        // البحث بالاسم أو المعرف الأمني
        const matchesSearch = student.name.toLowerCase().includes(searchTerm) || 
                             student.studentId.toLowerCase().includes(searchTerm);
        
        // التصفية حسب مستوى المهارة
        const matchesSkill = selectedSkill === 'all' || student.skill === selectedSkill;
        
        // التصفية حسب التخصص الدقيق
        const matchesSpecialization = selectedSpecialization === 'all' || student.specialization === selectedSpecialization;
        
        return matchesSearch && matchesSkill && matchesSpecialization;
    });
    
    currentPage = 1;
    displayStudentsTable(filteredStudents);
    updateStats(filteredStudents);
}

// دالة لترتيب الجدول
function sortTable(columnIndex) {
    // إذا كان نفس العمود، قم بعكس الاتجاه
    if (currentSortColumn === columnIndex) {
        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        // إذا كان عمود جديد، اجعل الاتجاه تصاعديًا
        currentSortColumn = columnIndex;
        sortDirection = 'asc';
    }
    
    // تحديث الأيقونات في رؤوس الأعمدة
    const headers = document.querySelectorAll('th');
    headers.forEach((header, index) => {
        const icon = header.querySelector('i');
        if (index === columnIndex) {
            icon.className = sortDirection === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';
        } else {
            icon.className = 'fas fa-sort';
        }
    });
    
    // ترتيب الطلاب بناءً على العمود المحدد
    const sortedStudents = [...cyberStudents].sort((a, b) => {
        let valueA, valueB;
        
        switch(columnIndex) {
            case 0: // المعرف
                valueA = a.id;
                valueB = b.id;
                break;
            case 1: // اسم الطالب
                valueA = a.name;
                valueB = b.name;
                break;
            case 2: //  الايميل
                valueA = a.studentId;
                valueB = b.studentId;
                break;
            case 3: // مستوى المهارة
                // تحويل المستوى إلى رقم للمقارنة
                const skillOrder = {beginner: 1, intermediate: 2, advanced: 3, expert: 4};
                valueA = skillOrder[a.skill];
                valueB = skillOrder[b.skill];
                break;
            case 4: //  الشهادات
                valueA = a.specialization;
                valueB = b.specialization;
                break;
            case 5: // الحالة
                valueA = a.certs.length;
                valueB = b.certs.length;
                break;

            default:
                return 0;
        }
        
        if (valueA < valueB) {
            return sortDirection === 'asc' ? -1 : 1;
        }
        if (valueA > valueB) {
            return sortDirection === 'asc' ? 1 : -1;
        }
        return 0;
    });
    
    // إعادة تعيين التصفية الحالية
    filterStudents();
}

// دالة لتحديث الإحصائيات
function updateStats(studentsArray) {
    const totalStudents = studentsArray.length;
    
    // حساب عدد الشهادات
    let totalCerts = 0;
    studentsArray.forEach(student => {
        totalCerts += student.certs.length;
    });
    
    // حساب متوسط مستوى المهارة
    const skillOrder = {beginner: 1, intermediate: 2, advanced: 3, expert: 4};
    let totalSkill = 0;
    studentsArray.forEach(student => {
        totalSkill += skillOrder[student.skill];
    });
    const avgSkillNum = studentsArray.length > 0 ? totalSkill / studentsArray.length : 0;
    
    let avgSkillText = "";
    if (avgSkillNum >= 3.5) avgSkillText = "خبير";
    else if (avgSkillNum >= 2.5) avgSkillText = "متقدم";
    else if (avgSkillNum >= 1.5) avgSkillText = "متوسط";
    else avgSkillText = "مبتدئ";
    
    // حساب التهديدات المحايدة
    let totalThreats = 0;
    studentsArray.forEach(student => {
        totalThreats += student.threats;
    });
    
    totalStudentsElement.textContent = totalStudents;
    certCountElement.textContent = totalCerts;
    avgSkillElement.textContent = avgSkillText;
    threatsNeutralizedElement.textContent = totalThreats;
}

// دالة لعرض تفاصيل الطالب
function viewStudent(studentId) {
    const student = cyberStudents.find(s => s.id === studentId);
    if (student) {
        const certsText = student.certs.length > 0 ? student.certs.join(', ') : 'لا توجد شهادات';
    
        
        alert(`🛡️ تفاصيل طالب الأمن السيبراني:\n\n` +
              `الاسم: ${student.name}\n` +
              `المعرف الأمني: ${student.studentId}\n` +
              `مستوى المهارة: ${student.level} - ${skillDesc}\n` +
              `التخصص الدقيق: ${student.specializationText}\n` +
              `الشهادات: ${certsText}\n` +
              `التهديدات المحايدة: ${student.threats}\n` +
              `الحالة: ${student.status === 'active' ? 'نشط' : 'غير نشط'}`);
    }
}



// دالة لتعديل بيانات الطالب

function editStudent() {
    window.location.href = "editStudent.html";
}


// دالة لحذف الطالب
function deleteStudent(studentId) {
    const student = cyberStudents.find(s => s.id === studentId);
    if (student) {
        if (confirm(`⚠️ هل أنت متأكد من إزالة الطالب ${student.name} من النظام؟\n\n` +
                   `هذا الإجراء سيزيل جميع بيانات الطالب ولا يمكن التراجع عنه.`)) {
            alert(`✅ تم إزالة الطالب ${student.name} بنجاح`);
            // في التطبيق الحقيقي، سيتم إرسال طلب حذف إلى الخادم
        }
    }
}

// دالة لمسح الأمن
function runSecurityScan() {
    alert("🛡️ بدأ مسح الأمن الشامل...\n\n" +
          "جاري فحص:\n" +
          "✓ نقاط الضعف في النظام\n" +
          "✓ التهديدات الأمنية المحتملة\n" +
          "✓ تحديثات الأمان المطلوبة\n" +
          "✓ طلاب الأمن النشطين\n\n" +
          "سيتم إرسال التقرير إلى المسؤولين.");
    
    // محاكاة المسح مع تأثيرات بصرية
    const scanBtn = document.getElementById('scanBtn');
    const originalText = scanBtn.innerHTML;
    scanBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري المسح...';
    scanBtn.disabled = true;
    
    setTimeout(() => {
        scanBtn.innerHTML = originalText;
        scanBtn.disabled = false;
        alert("✅ اكتمل مسح الأمن!\n\n" +
              "النتائج:\n" +
              "- النظام آمن بنسبة 94%\n" +
              "- تم اكتشاف 3 تهديدات منخفضة الخطورة\n" +
              "- جميع الطلاب نشطين\n" +
              "- تم تحديث جميع أنظمة الحماية");
    }, 2000);
}

// دالة لإضافة طالب جديد
    
function addCyberSpecialist() {
    window.location.href = "addstudent.html";
}



   
