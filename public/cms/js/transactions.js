
// بيانات المعاملات الأمنية
const securityTransactions = [
    {id: 1, type: "certification", typeText: "طلب شهادة أمنية", details: "طلب شهادة CEH - Certified Ethical Hacker", user: "أحمد القرني", status: "approved", severity: "high", date: "2023-10-15", description: "طلب للحصول على شهادة الهاكر الأخلاقي المعتمد (CEH) بعد إكمال متطلبات الدورة بنجاح", userId: "SEC-2023001", role: "متخصص أمني", securityLevel: "Level 3"},
    {id: 2, type: "lab", typeText: "طلب مختبر افتراضي", details: "طلب مختبر اختبار الاختراق", user: "سارة الحربي", status: "pending", severity: "critical", date: "2023-10-16", description: "طلب إنشاء مختبر افتراضي متقدم لاختبار الاختراق يتضمن Kali Linux و Metasploit و Nmap", userId: "SEC-2023002", role: "باحثة أمن", securityLevel: "Level 4"},
    {id: 3, type: "exam", typeText: "طلب اختبار أمني", details: "اختبار أمن التطبيقات", user: "خالد الشمري", status: "approved", severity: "medium", date: "2023-10-14", description: "طلب إجراء اختبار أمني لتطبيق ويب جديد قبل نشره في بيئة الإنتاج", userId: "SEC-2023003", role: "مطور أمن", securityLevel: "Level 3"},
    {id: 4, type: "access", typeText: "طلب صلاحيات وصول", details: "طلب وصول إلى قاعدة البيانات الأمنية", user: "نورة العتيبي", status: "rejected", severity: "critical", date: "2023-10-13", description: "طلب صلاحيات وصول كاملة إلى قاعدة البيانات الحساسة للمؤسسة دون تبرير كافٍ", userId: "SEC-2023004", role: "محللة أمن", securityLevel: "Level 2"},
    {id: 5, type: "resource", typeText: "طلب موارد أمنية", details: "طلب كتب ومراجع أمنية", user: "محمد الغامدي", status: "pending", severity: "low", date: "2023-10-17", description: "طلب توفير كتب ومراجع متخصصة في مجال التحقيق الجنائي الرقمي", userId: "SEC-2023005", role: "محقق رقمي", securityLevel: "Level 3"},
    {id: 6, type: "certification", typeText: "طلب شهادة أمنية", details: "طلب شهادة CISSP", user: "لينا الفهد", status: "approved", severity: "high", date: "2023-10-12", description: "طلب للحصول على شهادة أخصائي أمن نظم المعلومات المعتمد (CISSP) بعد 5 سنوات خبرة", userId: "SEC-2023006", role: "مديرة أمن", securityLevel: "Level 5"},
    {id: 7, type: "lab", typeText: "طلب مختبر افتراضي", details: "طلب مختبر التحقيق الجنائي", user: "فيصل القحطاني", status: "pending", severity: "high", date: "2023-10-16", description: "طلب إنشاء مختبر تحقيق جنائي رقمي يتضمن أدوات FTK و EnCase و Autopsy", userId: "SEC-2023007", role: "محقق جنائي", securityLevel: "Level 4"},
    {id: 8, type: "exam", typeText: "طلب اختبار أمني", details: "اختبار اختراق الشبكات", user: "ريم الزهراني", status: "approved", severity: "medium", date: "2023-10-15", description: "طلب إجراء اختبار اختراق شامل لشبكة المؤسسة الداخلية", userId: "SEC-2023008", role: "اختبار اختراق", securityLevel: "Level 3"},
    {id: 9, type: "access", typeText: "طلب صلاحيات وصول", details: "طلب وصول إلى نظام SIEM", user: "ياسر الحارثي", status: "pending", severity: "critical", date: "2023-10-18", description: "طلب صلاحيات وصول إلى نظام إدارة المعلومات والأحداث الأمنية (SIEM) للمراقبة", userId: "SEC-2023009", role: "مراقب أمن", securityLevel: "Level 3"},
    {id: 10, type: "resource", typeText: "طلب موارد أمنية", details: "طلب أدوات تحليل البرمجيات الضارة", user: "أمل المطيري", status: "approved", severity: "medium", date: "2023-10-10", description: "طلب توفير أدوات متقدمة لتحليل البرمجيات الضارة والبايلودات", userId: "SEC-2023010", role: "محللة برمجيات ضارة", securityLevel: "Level 4"},
    {id: 11, type: "certification", typeText: "طلب شهادة أمنية", details: "طلب شهادة OSCP", user: "طارق الهذلي", status: "pending", severity: "critical", date: "2023-10-11", description: "طلب للحصول على شهادة محترف الأمن الهجومي المعتمد (OSCP) بعد التدريب المكثف", userId: "SEC-2023011", role: "هاكر أخلاقي", securityLevel: "Level 4"},
    {id: 12, type: "lab", typeText: "طلب مختبر افتراضي", details: "طلب مختبر أمن سحابي", user: "هديل السبيعي", status: "approved", severity: "high", date: "2023-10-09", description: "طلب إنشاء مختبر أمن سحابي يتضمن AWS Security و Azure Security Center", userId: "SEC-2023012", role: "أخصائية أمن سحابي", securityLevel: "Level 3"},
    {id: 13, type: "exam", typeText: "طلب اختبار أمني", details: "اختبار الوعي الأمني", user: "بدر العوفي", status: "rejected", severity: "low", date: "2023-10-08", description: "طلب إجراء اختبار وعي أمني للموظفين - غير مكتمل المتطلبات", userId: "SEC-2023013", role: "مدرب أمن", securityLevel: "Level 2"},
    {id: 14, type: "access", typeText: "طلب صلاحيات وصول", details: "طلب وصول إلى أنظمة التحكم الصناعي", user: "شهد الغامدي", status: "pending", severity: "critical", date: "2023-10-19", description: "طلب صلاحيات وصول لأنظمة التحكم الصناعي (ICS/SCADA) للفحص الأمني", userId: "SEC-2023014", role: "أخصائية أمن صناعي", securityLevel: "Level 5"},
    {id: 15, type: "resource", typeText: "طلب موارد أمنية", details: "طلب أجهزة تشفير متقدمة", user: "سعود المري", status: "approved", severity: "high", date: "2023-10-07", description: "طلب توفير أجهزة تشفير متقدمة لتأمين الاتصالات الداخلية", userId: "SEC-2023015", role: "أخصائي تشفير", securityLevel: "Level 4"}
];

// سجل التدقيق
const auditLogs = {
    1: [
        {action: "إنشاء الطلب", user: "أحمد القرني", time: "2023-10-15 10:30"},
        {action: "المراجعة الأمنية", user: "مدير النظام", time: "2023-10-15 14:15"},
        {action: "الموافقة النهائية", user: "الادمن  ", time: "2023-10-15 16:45"}
    ],
    2: [
        {action: "إنشاء الطلب", user: "سارة الحربي", time: "2023-10-16 09:20"},
        {action: "الفحص الأولي", user: "مدير النظام", time: "2023-10-16 11:30"}
    ],
    4: [
        {action: "إنشاء الطلب", user: "نورة العتيبي", time: "2023-10-13 13:45"},
        {action: "المراجعة الأمنية", user: "مدير النظام", time: "2023-10-13 15:20"},
        {action: "الرفض - مخالفة السياسات", user: "ادمن  ", time: "2023-10-13 17:10"}
    ]
};

// عناصر DOM
const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menuToggle');
const cyberBackground = document.getElementById('cyberBackground');
const transactionsTableBody = document.getElementById('transactionsTableBody');
const typeFilter = document.getElementById('typeFilter');
const statusFilter = document.getElementById('statusFilter');
const severityFilter = document.getElementById('severityFilter');
const searchInput = document.getElementById('searchInput');
const applyFilters = document.getElementById('applyFilters');
const resetFilters = document.getElementById('resetFilters');
const refreshBtn = document.getElementById('refreshBtn');
const newTransactionBtn = document.getElementById('newTransactionBtn');
const exportBtn = document.getElementById('exportBtn');
const scanBtn = document.getElementById('scanBtn');
const auditBtn = document.getElementById('auditBtn');
const noResultsMessage = document.getElementById('noResultsMessage');
const paginationElement = document.getElementById('pagination');
const transactionModal = document.getElementById('transactionModal');
const closeModal = document.getElementById('closeModal');
const modalTitle = document.getElementById('modalTitle');
const transactionDetailsGrid = document.getElementById('transactionDetailsGrid');
const transactionDescription = document.getElementById('transactionDescription');
const auditLogContent = document.getElementById('auditLogContent');
const modalFooter = document.getElementById('modalFooter');

// عناصر الإحصائيات
const totalTransactionsElement = document.getElementById('totalTransactions');
const pendingTransactionsElement = document.getElementById('pendingTransactions');
const approvedTransactionsElement = document.getElementById('approvedTransactions');
const rejectedTransactionsElement = document.getElementById('rejectedTransactions');

// إعدادات الترقيم
let currentPage = 1;
const rowsPerPage = 8;
let currentTransactionId = null;

// إنشاء خلفية الأمن السيبراني
function createCyberBackground() {
    const chars = "01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲンABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const fontSize = 18;
    const columns = Math.floor(window.innerWidth / fontSize);
    
    for (let i = 0; i < columns; i++) {
        const code = document.createElement('div');
        code.className = 'hacker-text';
        code.style.left = `${i * fontSize}px`;
        code.style.animationDuration = `${Math.random() * 10 + 15}s`;
        code.style.animationDelay = `${Math.random() * 5}s`;
        code.style.opacity = `${Math.random() * 0.5 + 0.2}`;
        cyberBackground.appendChild(code);
        
        // تحديث النص بشكل دوري
        setInterval(() => {
            let text = '';
            for (let j = 0; j < 25; j++) {
                text += chars[Math.floor(Math.random() * chars.length)] + '<br>';
            }
            code.innerHTML = text;
        }, 100);
    }
}

// عرض جميع المعاملات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    createCyberBackground();
    displayTransactionsTable(securityTransactions);
    updateStats(securityTransactions);
    setupPagination(securityTransactions);
    
    // إضافة مستمعي الأحداث
    menuToggle.addEventListener('click', toggleSidebar);
    applyFilters.addEventListener('click', filterTransactions);
    resetFilters.addEventListener('click', resetFiltersHandler);
    refreshBtn.addEventListener('click', refreshData);
    newTransactionBtn.addEventListener('click', newSecurityTransaction);
    exportBtn.addEventListener('click', exportData);
    scanBtn.addEventListener('click', runSecurityScan);
    auditBtn.addEventListener('click', runSecurityAudit);
    closeModal.addEventListener('click', closeTransactionModal);
    
    // إغلاق النافذة عند النقر خارجها
    window.addEventListener('click', function(event) {
        if (event.target === transactionModal) {
            closeTransactionModal();
        }
    });
    
    // إضافة مستمعي الأحداث للروابط الجانبية
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // إزالة النشاط من جميع الروابط
            document.querySelectorAll('.nav-link').forEach(l => {
                l.classList.remove('active');
            });
            
            // إضافة النشاط للرابط المحدد
            this.classList.add('active');
            
            // إظهار رسالة (في التطبيق الحقيقي، سيتم توجيه المستخدم إلى الصفحة)
            const linkText = this.querySelector('span').textContent;
            showAlert(`جاري التوجيه إلى: ${linkText}`, 'info');
        });
    });
    
    // زر تسجيل الخروج
    document.querySelector('.logout-btn .nav-link').addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('🔒 تسجيل الخروج الآمن\n\nسيتم إنهاء الجلسة الحالية وتنظيف كافة البيانات المؤقتة.\nهل أنت متأكد؟')) {
            showAlert('تم تسجيل الخروج الآمن بنجاح', 'success');
            // في التطبيق الحقيقي: window.location.href = 'login.html';
        }
    });
});

// تبديل القائمة الجانبية
function toggleSidebar() {
    sidebar.classList.toggle('active');
}

// دالة لعرض جدول المعاملات
function displayTransactionsTable(transactionsArray) {
    transactionsTableBody.innerHTML = '';
    
    if (transactionsArray.length === 0) {
        noResultsMessage.style.display = 'block';
        return;
    } else {
        noResultsMessage.style.display = 'none';
    }
    
    // حساب نطاق الصفوف للصفحة الحالية
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const pageTransactions = transactionsArray.slice(startIndex, endIndex);
    
    pageTransactions.forEach(transaction => {
        const row = document.createElement('tr');
        
        // تحديد فئة نوع المعاملة
        const typeClass = `type-${transaction.type}`;
        
        // تحديد فئة الحالة
        let statusClass = '';
        let statusText = '';
        switch(transaction.status) {
            case 'pending':
                statusClass = 'status-pending';
                statusText = 'قيد المراجعة';
                break;
            case 'approved':
                statusClass = 'status-approved';
                statusText = 'معتمدة';
                break;
            case 'rejected':
                statusClass = 'status-rejected';
                statusText = 'مرفوضة';
                break;
        }
        
        // تحديد مستوى الخطورة
        let severityClass = '';
        let severityText = '';
        switch(transaction.severity) {
            case 'low':
                severityClass = 'severity-low';
                severityText = 'منخفض';
                break;
            case 'medium':
                severityClass = 'severity-medium';
                severityText = 'متوسط';
                break;
            case 'high':
                severityClass = 'severity-high';
                severityText = 'مرتفع';
                break;
            case 'critical':
                severityClass = 'severity-critical';
                severityText = 'حرج';
                break;
        }
        
        // تنسيق التاريخ
        const dateObj = new Date(transaction.date);
        const formattedDate = dateObj.toLocaleDateString('ar-SA');
        
        // أيقونة النوع
        const typeIcon = getTypeIcon(transaction.type);
        
        row.innerHTML = `
            <td><span class="cyber-badge">${transaction.id}</span></td>
            <td>
                <div class="transaction-type ${typeClass}">
                    <div class="type-icon">
                        ${typeIcon}
                    </div>
                    <div>
                        <div>${transaction.typeText}</div>
                        <div class="security-level">مستوى أمني: ${transaction.securityLevel}</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="transaction-details">${transaction.details}</div>
                <div class="transaction-user">
                    <span class="cyber-badge">${transaction.userId}</span>
                    ${transaction.role}
                </div>
            </td>
            <td>${transaction.user}</td>
            <td>
                <span class="status-badge ${statusClass}">${statusText}</span>
            </td>
            <td>
                <span class="severity-badge ${severityClass}">${severityText}</span>
            </td>
            <td>${formattedDate}</td>
            <td>
                <div class="action-buttons">
                    <button class="action-btn view" onclick="viewTransaction(${transaction.id})" title="عرض التفاصيل">
                        <i class="fas fa-eye"></i>
                    </button>
                    ${transaction.status === 'pending' ? `
                        <button class="action-btn approve" onclick="approveTransaction(${transaction.id})" title="اعتماد أمني">
                            <i class="fas fa-check-shield"></i>
                        </button>
                        <button class="action-btn reject" onclick="rejectTransaction(${transaction.id})" title="رفض أمني">
                            <i class="fas fa-ban"></i>
                        </button>
                    ` : ''}
                    <button class="action-btn audit" onclick="viewAuditLog(${transaction.id})" title="سجل التدقيق">
                        <i class="fas fa-history"></i>
                    </button>
                </div>
            </td>
        `;
        
        transactionsTableBody.appendChild(row);
    });
    
    // تحديث أزرار الترقيم
    setupPagination(transactionsArray);
}

// دالة للحصول على أيقونة النوع
function getTypeIcon(type) {
    const icons = {
        'certification': '<i class="fas fa-certificate"></i>',
        'lab': '<i class="fas fa-flask"></i>',
        'exam': '<i class="fas fa-file-alt"></i>',
        'access': '<i class="fas fa-key"></i>',
        'resource': '<i class="fas fa-toolbox"></i>'
    };
    return icons[type] || '<i class="fas fa-shield-alt"></i>';
}

// دالة لإعداد الترقيم
function setupPagination(transactionsArray) {
    paginationElement.innerHTML = '';
    
    const totalPages = Math.ceil(transactionsArray.length / rowsPerPage);
    
    // زر الصفحة السابقة
    const prevButton = document.createElement('button');
    prevButton.className = `pagination-btn ${currentPage === 1 ? 'disabled' : ''}`;
    prevButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayTransactionsTable(transactionsArray);
        }
    });
    paginationElement.appendChild(prevButton);
    
    // أزرار الصفحات
    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.className = `pagination-btn ${currentPage === i ? 'active' : ''}`;
        pageButton.textContent = i;
        pageButton.addEventListener('click', () => {
            currentPage = i;
            displayTransactionsTable(transactionsArray);
        });
        paginationElement.appendChild(pageButton);
    }
    
    // زر الصفحة التالية
    const nextButton = document.createElement('button');
    nextButton.className = `pagination-btn ${currentPage === totalPages ? 'disabled' : ''}`;
    nextButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayTransactionsTable(transactionsArray);
        }
    });
    paginationElement.appendChild(nextButton);
}

// دالة لتصفية المعاملات
function filterTransactions() {
    const selectedType = typeFilter.value;
    const selectedStatus = statusFilter.value;
    const selectedSeverity = severityFilter.value;
    const searchTerm = searchInput.value.toLowerCase();
    
    const filteredTransactions = securityTransactions.filter(transaction => {
        // التصفية حسب النوع
        const matchesType = selectedType === 'all' || transaction.type === selectedType;
        
        // التصفية حسب الحالة
        const matchesStatus = selectedStatus === 'all' || transaction.status === selectedStatus;
        
        // التصفية حسب مستوى الخطورة
        const matchesSeverity = selectedSeverity === 'all' || transaction.severity === selectedSeverity;
        
        // البحث بالتفاصيل أو المستخدم أو المعرف
        const matchesSearch = searchTerm === '' || 
            transaction.details.toLowerCase().includes(searchTerm) ||
            transaction.user.toLowerCase().includes(searchTerm) ||
            transaction.userId.toLowerCase().includes(searchTerm) ||
            transaction.role.toLowerCase().includes(searchTerm);
        
        return matchesType && matchesStatus && matchesSeverity && matchesSearch;
    });
    
    currentPage = 1;
    displayTransactionsTable(filteredTransactions);
    updateStats(filteredTransactions);
}

// دالة إعادة تعيين الفلاتر
function resetFiltersHandler() {
    typeFilter.value = 'all';
    statusFilter.value = 'all';
    severityFilter.value = 'all';
    searchInput.value = '';
    
    currentPage = 1;
    displayTransactionsTable(securityTransactions);
    updateStats(securityTransactions);
}

// دالة تحديث البيانات
function refreshData() {
    showAlert('🔄 جاري تحديث البيانات الأمنية...', 'info');
    
    // محاكاة تحديث البيانات
    setTimeout(() => {
        showAlert('✅ تم تحديث البيانات الأمنية بنجاح', 'success');
        filterTransactions();
    }, 1500);
}

// دالة إنشاء معاملة جديدة
function newSecurityTransaction() {
    showAlert('🔧 جاري فتح نموذج إنشاء معاملة أمنية جديدة...', 'info');
    // في التطبيق الحقيقي: فتح نموذج إنشاء معاملة
}

// دالة تصدير البيانات
function exportData() {
    showAlert('📥 جاري تصدير البيانات بصيغة XML مشفرة...', 'info');
    // في التطبيق الحقيقي: تصدير البيانات
}

// دالة المسح الأمني
function runSecurityScan() {
    showAlert('🛡️ بدأ المسح الأمني الشامل للنظام...', 'info');
    
    // محاكاة المسح الأمني
    setTimeout(() => {
        showAlert('✅ اكتمل المسح الأمني: النظام آمن بنسبة 98%', 'success');
    }, 3000);
}

// دالة التدقيق الأمني
function runSecurityAudit() {
    showAlert('📋 بدأ التدقيق الأمني لجميع المعاملات...', 'info');
    
    // محاكاة التدقيق الأمني
    setTimeout(() => {
        const pendingCount = securityTransactions.filter(t => t.status === 'pending').length;
        showAlert(`📊 نتائج التدقيق: ${pendingCount} معاملة تحتاج مراجعة`, 'warning');
    }, 2000);
}

// دالة لإظهار التنبيهات
function showAlert(message, type) {
    // إنشاء عنصر التنبيه
    const alertDiv = document.createElement('div');
    alertDiv.style.cssText = `
        position: fixed;
        top: 20px;
        left: 20px;
        right: 20px;
        max-width: 400px;
        margin: 0 auto;
        padding: 15px 20px;
        border-radius: 8px;
        background-color: ${type === 'success' ? 'rgba(16, 185, 129, 0.9)' : type === 'warning' ? 'rgba(245, 158, 11, 0.9)' : type === 'danger' ? 'rgba(239, 68, 68, 0.9)' : 'rgba(14, 165, 233, 0.9)'};
        color: white;
        font-weight: 500;
        z-index: 10000;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        animation: slideIn 0.3s ease-out;
    `;
    
    alertDiv.innerHTML = `
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    // إزالة التنبيه بعد 3 ثواني
    setTimeout(() => {
        alertDiv.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => {
            document.body.removeChild(alertDiv);
        }, 300);
    }, 3000);
    
    // إضافة أنيميشن للتنبيهات
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateY(-100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(-100px); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}

// دالة لتحديث الإحصائيات
function updateStats(transactionsArray) {
    const totalTransactions = transactionsArray.length;
    const pendingTransactions = transactionsArray.filter(t => t.status === 'pending').length;
    const approvedTransactions = transactionsArray.filter(t => t.status === 'approved').length;
    const rejectedTransactions = transactionsArray.filter(t => t.status === 'rejected').length;
    
    totalTransactionsElement.textContent = totalTransactions;
    pendingTransactionsElement.textContent = pendingTransactions;
    approvedTransactionsElement.textContent = approvedTransactions;
    rejectedTransactionsElement.textContent = rejectedTransactions;
}

// دالة لعرض تفاصيل المعاملة
function viewTransaction(transactionId) {
    const transaction = securityTransactions.find(t => t.id === transactionId);
    if (!transaction) return;
    
    currentTransactionId = transactionId;
    
    // تحديث عنوان النافذة
    modalTitle.innerHTML = `<i class="fas fa-shield-alt"></i> تفاصيل المعاملة الأمنية #${transaction.id}`;
    
    // تحديث تفاصيل المعاملة
    const dateObj = new Date(transaction.date);
    const formattedDate = dateObj.toLocaleDateString('ar-SA');
    const formattedTime = dateObj.toLocaleTimeString('ar-SA');
    
    // تحديد حالة المعاملة بالعربية
    let statusText = '';
    let statusColor = '';
    switch(transaction.status) {
        case 'pending':
            statusText = 'قيد المراجعة الأمنية';
            statusColor = '#f59e0b';
            break;
        case 'approved':
            statusText = 'معتمدة أمنياً';
            statusColor = '#10b981';
            break;
        case 'rejected':
            statusText = 'مرفوضة أمنياً';
            statusColor = '#ef4444';
            break;
    }
    
    // تحديد مستوى الخطورة
    let severityText = '';
    let severityColor = '';
    switch(transaction.severity) {
        case 'low':
            severityText = 'منخفض';
            severityColor = '#10b981';
            break;
        case 'medium':
            severityText = 'متوسط';
            severityColor = '#f59e0b';
            break;
        case 'high':
            severityText = 'مرتفع';
            severityColor = '#ef4444';
            break;
        case 'critical':
            severityText = 'حرج';
            severityColor = '#dc2626';
            break;
    }
    
    transactionDetailsGrid.innerHTML = `
        <div class="detail-item">
            <div class="detail-label">رقم المعاملة</div>
            <div class="detail-value"><span class="cyber-badge">#${transaction.id}</span></div>
        </div>
        <div class="detail-item">
            <div class="detail-label">نوع المعاملة</div>
            <div class="detail-value">${transaction.typeText}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">التفاصيل</div>
            <div class="detail-value">${transaction.details}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">المستخدم</div>
            <div class="detail-value">${transaction.user}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">الوظيفة / الدور</div>
            <div class="detail-value">${transaction.role} <span class="cyber-badge">${transaction.userId}</span></div>
        </div>
        <div class="detail-item">
            <div class="detail-label">مستوى الأمان</div>
            <div class="detail-value">${transaction.securityLevel}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">الحالة</div>
            <div class="detail-value" style="color: ${statusColor}; font-weight: bold;">${statusText}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">مستوى الخطورة</div>
            <div class="detail-value" style="color: ${severityColor}; font-weight: bold;">${severityText}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">تاريخ الإنشاء</div>
            <div class="detail-value">${formattedDate}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">وقت الإنشاء</div>
            <div class="detail-value">${formattedTime}</div>
        </div>
    `;
    
    // تحديث وصف المعاملة
    transactionDescription.textContent = transaction.description;
    
    // تحديث سجل التدقيق
    updateAuditLog(transactionId);
    
    // تحديث أزرار النافذة
    modalFooter.innerHTML = '';
    
    if (transaction.status === 'pending') {
        modalFooter.innerHTML = `
            <button class="btn btn-success" onclick="approveTransaction(${transaction.id}, true)">
                <i class="fas fa-check-shield"></i> اعتماد أمني
            </button>
            <button class="btn btn-danger" onclick="rejectTransaction(${transaction.id}, true)">
                <i class="fas fa-ban"></i> رفض أمني
            </button>
            <button class="btn btn-secondary" onclick="closeTransactionModal()">
                <i class="fas fa-times"></i> إغلاق
            </button>
        `;
    } else {
        modalFooter.innerHTML = `
            <button class="btn btn-secondary" onclick="closeTransactionModal()">
                <i class="fas fa-times"></i> إغلاق
            </button>
        `;
    }
    
    // إظهار النافذة
    transactionModal.style.display = 'flex';
}

// دالة تحديث سجل التدقيق
function updateAuditLog(transactionId) {
    const logs = auditLogs[transactionId] || [];
    
    if (logs.length > 0) {
        let logsHTML = '';
        logs.forEach(log => {
            logsHTML += `
                <div class="audit-log-item">
                    <div>
                        <div class="audit-log-action">${log.action}</div>
                        <div class="audit-log-user">بواسطة: ${log.user}</div>
                    </div>
                    <div class="audit-log-time">${log.time}</div>
                </div>
            `;
        });
        auditLogContent.innerHTML = logsHTML;
    } else {
        auditLogContent.innerHTML = '<div style="color: #94a3b8; text-align: center;">لا يوجد سجل تدقيق لهذه المعاملة</div>';
    }
}

// دالة عرض سجل التدقيق
function viewAuditLog(transactionId) {
    viewTransaction(transactionId);
}

// دالة إغلاق نافذة المعاملة
function closeTransactionModal() {
    transactionModal.style.display = 'none';
    currentTransactionId = null;
}

// دالة اعتماد المعاملة
function approveTransaction(transactionId, fromModal = false) {
    if (confirm('🔐 اعتماد أمني\n\nهل أنت متأكد من اعتماد هذه المعاملة أمنياً؟\nسيتم منح الصلاحيات والموارد المطلوبة.')) {
        // في التطبيق الحقيقي، سيتم إرسال طلب إلى الخادم
        showAlert('✅ تم اعتماد المعاملة أمنياً بنجاح', 'success');
        
        // تحديث حالة المعاملة في البيانات المحلية
        const transactionIndex = securityTransactions.findIndex(t => t.id === transactionId);
        if (transactionIndex !== -1) {
            securityTransactions[transactionIndex].status = 'approved';
            
            // تحديث العرض
            filterTransactions();
            updateStats(securityTransactions);
            
            // إغلاق النافذة إذا كانت مفتوحة
            if (fromModal) {
                closeTransactionModal();
            }
        }
    }
}

// دالة رفض المعاملة
function rejectTransaction(transactionId, fromModal = false) {
    const reason = prompt('🚫 رفض أمني\n\nيرجى إدخال سبب الرفض الأمني:');
    if (reason) {
        // في التطبيق الحقيقي، سيتم إرسال طلب إلى الخادم
        showAlert('✅ تم رفض المعاملة أمنياً', 'success');
        
        // تحديث حالة المعاملة في البيانات المحلية
        const transactionIndex = securityTransactions.findIndex(t => t.id === transactionId);
        if (transactionIndex !== -1) {
            securityTransactions[transactionIndex].status = 'rejected';
            
            // تحديث العرض
            filterTransactions();
            updateStats(securityTransactions);
            
            // إغلاق النافذة إذا كانت مفتوحة
            if (fromModal) {
                closeTransactionModal();
            }
        }
    }
}
