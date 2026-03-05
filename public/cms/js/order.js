
// بيانات الطلبات
const allOrders = [
    {id: 1, orderId: "SEC-ORD-2023-001", userId: "ahmed", userName: "أحمد القرني", userLevel: "Level 3", title: "طلب شهادة CEH - Certified Ethical Hacker", type: "certification", description: "أرغب في الحصول على شهادة الهاكر الأخلاقي المعتمد بعد إكمال دورة الأمن السيبراني المتقدمة.", status: "pending", priority: "high", date: "2023-10-15", attachments: 2, adminNotes: ""},
    {id: 2, orderId: "SEC-ORD-2023-002", userId: "sara", userName: "سارة الحربي", userLevel: "Level 4", title: "طلب إنشاء مختبر اختبار الاختراق", type: "lab", description: "أحتاج إلى مختبر افتراضي متكامل لاختبار الاختراق يتضمن Kali Linux, Metasploit, Nmap, Wireshark.", status: "pending", priority: "urgent", date: "2023-10-14", attachments: 1, adminNotes: ""},
    {id: 3, orderId: "SEC-ORD-2023-003", userId: "khaled", userName: "خالد الشمري", userLevel: "Level 3", title: "طلب مصادر تعلم التحقيق الجنائي الرقمي", type: "resource", description: "أبحث عن كتب ومراجع ودورات متخصصة في مجال التحقيق الجنائي الرقمي والاستجابة للحوادث الأمنية.", status: "processing", priority: "normal", date: "2023-10-13", attachments: 0, adminNotes: "جارٍ جمع المصادر المطلوبة"},
    {id: 4, orderId: "SEC-ORD-2023-004", userId: "noura", userName: "نورة العتيبي", userLevel: "Level 2", title: "طلب اختبار تقييم مهارات أمن التطبيقات", type: "exam", description: "أرغب في إجراء اختبار تقييم مهاراتي في مجال أمن تطبيقات الويب، بما في ذلك اكتشاف الثغرات وحمايتها.", status: "approved", priority: "normal", date: "2023-10-12", attachments: 3, adminNotes: "تمت الموافقة، سيتم التواصل لتحديد موعد الاختبار"},
    {id: 5, orderId: "SEC-ORD-2023-005", userId: "ahmed", userName: "أحمد القرني", userLevel: "Level 3", title: "طلب شهادة CISSP", type: "certification", description: "أريد التقدم لامتحان شهادة CISSP بعد اكتساب الخبرة العملية المطلوبة في مجال أمن المعلومات.", status: "rejected", priority: "high", date: "2023-10-11", attachments: 5, adminNotes: "مرفوض - يحتاج إلى خبرة إضافية قبل التقديم"},
    {id: 6, orderId: "SEC-ORD-2023-006", userId: "sara", userName: "سارة الحربي", userLevel: "Level 4", title: "طلب أدوات تحليل البرمجيات الضارة", type: "resource", description: "أحتاج إلى مجموعة من أدوات تحليل البرمجيات الضارة المتقدمة للبحث الأكاديمي في مجال الأمن السيبراني.", status: "pending", priority: "normal", date: "2023-10-10", attachments: 2, adminNotes: ""},
    {id: 7, orderId: "SEC-ORD-2023-007", userId: "khaled", userName: "خالد الشمري", userLevel: "Level 3", title: "طلب مختبر أمن الشبكات", type: "lab", description: "طلب إنشاء مختبر افتراضي لممارسة مهارات أمن الشبكات والدفاع عن الهجمات الإلكترونية.", status: "processing", priority: "high", date: "2023-10-09", attachments: 1, adminNotes: "جارٍ تثبيت البرمجيات المطلوبة"},
    {id: 8, orderId: "SEC-ORD-2023-008", userId: "noura", userName: "نورة العتيبي", userLevel: "Level 2", title: "طلب اختبار اختراق أخلاقي", type: "exam", description: "أرغب في إجراء اختبار اختراق أخلاقي لتقييم مهاراتي في مجال الاختراق والدفاع.", status: "approved", priority: "normal", date: "2023-10-08", attachments: 0, adminNotes: "تمت الموافقة، سيتم تحديد البيئة المستهدفة"},
    {id: 9, orderId: "SEC-ORD-2023-009", userId: "ahmed", userName: "أحمد القرني", userLevel: "Level 3", title: "طلب مصادر أمن سحابي", type: "resource", description: "أبحث عن دورات ومواد تعليمية حول أمن الحوسبة السحابية والبيئات السحابية الآمنة.", status: "pending", priority: "normal", date: "2023-10-07", attachments: 0, adminNotes: ""},
    {id: 10, orderId: "SEC-ORD-2023-010", userId: "sara", userName: "سارة الحربي", userLevel: "Level 4", title: "طلب شهادة OSCP", type: "certification", description: "أريد التقديم للحصول على شهادة محترف الأمن الهجومي المعتمد (OSCP) بعد التدريب المكثف.", status: "processing", priority: "urgent", date: "2023-10-06", attachments: 4, adminNotes: "قيد التحقق من المتطلبات الأساسية"}
];

// عناصر DOM
const adminSidebar = document.getElementById('adminSidebar');
const menuToggle = document.getElementById('menuToggle');
const ordersTableBody = document.getElementById('ordersTableBody');
const filterStatus = document.getElementById('filterStatus');
const filterType = document.getElementById('filterType');
const filterUser = document.getElementById('filterUser');
const searchInput = document.getElementById('searchInput');
const selectAll = document.getElementById('selectAll');
const pendingCount = document.getElementById('pendingCount');
const processingCount = document.getElementById('processingCount');
const approvedCount = document.getElementById('approvedCount');
const rejectedCount = document.getElementById('rejectedCount');
const newOrderBtn = document.getElementById('newOrderBtn');
const exportBtn = document.getElementById('exportBtn');
const refreshBtn = document.getElementById('refreshBtn');
const bulkApproveBtn = document.getElementById('bulkApproveBtn');
const bulkRejectBtn = document.getElementById('bulkRejectBtn');
const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
const noDataMessage = document.getElementById('noDataMessage');
const paginationElement = document.getElementById('pagination');
const orderModal = document.getElementById('orderModal');
const closeModal = document.getElementById('closeModal');
const modalBody = document.getElementById('modalBody');
const modalFooter = document.getElementById('modalFooter');
const adminAlert = document.getElementById('adminAlert');
const alertMessage = document.getElementById('alertMessage');

// إعدادات الترقيم
let currentPage = 1;
const rowsPerPage = 8;
let currentOrderId = null;
let selectedOrders = new Set();

// عرض جميع الطلبات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    displayOrders(allOrders);
    updateStats(allOrders);
    setupPagination(allOrders);
    
    // إضافة مستمعي الأحداث
    menuToggle.addEventListener('click', toggleSidebar);
    filterStatus.addEventListener('change', filterOrders);
    filterType.addEventListener('change', filterOrders);
    filterUser.addEventListener('change', filterOrders);
    searchInput.addEventListener('input', filterOrders);
    selectAll.addEventListener('change', toggleSelectAll);
    newOrderBtn.addEventListener('click', createNewOrder);
    exportBtn.addEventListener('click', exportOrders);
    refreshBtn.addEventListener('click', refreshOrders);
    bulkApproveBtn.addEventListener('click', bulkApproveOrders);
    bulkRejectBtn.addEventListener('click', bulkRejectOrders);
    bulkDeleteBtn.addEventListener('click', bulkDeleteOrders);
    closeModal.addEventListener('click', closeOrderModal);
    
    // إغلاق النافذة عند النقر خارجها
    window.addEventListener('click', function(event) {
        if (event.target === orderModal) {
            closeOrderModal();
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
            
            const linkText = this.querySelector('span').textContent;
            if (linkText !== 'لوحة التحكم') {
                showAlert(`تم التوجيه إلى قسم ${linkText}`, 'info');
            }
        });
    });
    
    // زر تسجيل الخروج
    document.querySelector('.logout-section .nav-link').addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('🔒 تسجيل الخروج الآمن\n\nسيتم إنهاء جلسة المدير الحالية.\nهل أنت متأكد؟')) {
            showAlert('تم تسجيل الخروج بنجاح', 'success');
        }
    });
});

// تبديل القائمة الجانبية
function toggleSidebar() {
    adminSidebar.classList.toggle('active');
}

// دالة لعرض الطلبات
function displayOrders(ordersArray) {
    ordersTableBody.innerHTML = '';
    selectedOrders.clear();
    selectAll.checked = false;
    
    if (ordersArray.length === 0) {
        noDataMessage.style.display = 'block';
        return;
    } else {
        noDataMessage.style.display = 'none';
    }
    
    // حساب نطاق الصفوف للصفحة الحالية
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const pageOrders = ordersArray.slice(startIndex, endIndex);
    
    pageOrders.forEach(order => {
        const row = document.createElement('tr');
        
        // تنسيق التاريخ
        const dateObj = new Date(order.date);
        const formattedDate = dateObj.toLocaleDateString('ar-SA');
        
        // تحديد نوع الطلب
        let typeClass = '';
        let typeText = '';
        switch(order.type) {
            case 'certification':
                typeClass = 'type-certification';
                typeText = 'شهادة أمنية';
                break;
            case 'lab':
                typeClass = 'type-lab';
                typeText = 'مختبر افتراضي';
                break;
            case 'resource':
                typeClass = 'type-resource';
                typeText = 'موارد أمنية';
                break;
            case 'exam':
                typeClass = 'type-exam';
                typeText = 'اختبار أمني';
                break;
        }
        
        // تحديد حالة الطلب
        let statusClass = '';
        let statusText = '';
        switch(order.status) {
            case 'pending':
                statusClass = 'status-pending';
                statusText = 'قيد المراجعة';
                break;
            case 'processing':
                statusClass = 'status-processing';
                statusText = 'قيد المعالجة';
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
        
        // تحديد الأولوية
        let priorityClass = '';
        let priorityText = '';
        switch(order.priority) {
            case 'normal':
                priorityClass = 'priority-normal';
                priorityText = 'عادي';
                break;
            case 'high':
                priorityClass = 'priority-high';
                priorityText = 'مرتفع';
                break;
            case 'urgent':
                priorityClass = 'priority-urgent';
                priorityText = 'عاجل';
                break;
        }
        
        row.innerHTML = `
            <td>
                <input type="checkbox" class="order-checkbox" data-id="${order.id}">
            </td>
            <td class="order-id">${order.orderId}</td>
            <td>
                <div class="user-info">
                    <div class="user-avatar-small">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <div class="user-details-small">
                        <h4>${order.userName}</h4>
                        <p>${order.userLevel}</p>
                    </div>
                </div>
            </td>
            <td>
                <span class="order-type-badge ${typeClass}">${typeText}</span>
            </td>
            <td>
                <div style="font-weight: 500; color: white;">${order.title}</div>
                <div style="font-size: 0.85rem; color: var(--admin-text-light); margin-top: 5px;">
                    ${order.attachments} مرفق
                </div>
            </td>
            <td>
                <span class="status-badge ${statusClass}">${statusText}</span>
            </td>
            <td>
                <span class="priority-badge ${priorityClass}">${priorityText}</span>
            </td>
            <td>${formattedDate}</td>
            <td>
                <div class="order-actions">
                    <button class="action-btn view" onclick="viewOrder(${order.id})" title="عرض التفاصيل">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn edit" onclick="editOrder(${order.id})" title="تعديل الطلب">
                        <i class="fas fa-edit"></i>
                    </button>
                    ${order.status === 'pending' ? `
                        <button class="action-btn approve" onclick="approveOrder(${order.id})" title="اعتماد الطلب">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="action-btn reject" onclick="rejectOrder(${order.id})" title="رفض الطلب">
                            <i class="fas fa-times"></i>
                        </button>
                    ` : ''}
                    <button class="action-btn delete" onclick="deleteOrder(${order.id})" title="حذف الطلب">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        
        ordersTableBody.appendChild(row);
    });
    
    // إضافة مستمعي الأحداث لمربعات الاختيار
    document.querySelectorAll('.order-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const orderId = parseInt(this.getAttribute('data-id'));
            if (this.checked) {
                selectedOrders.add(orderId);
            } else {
                selectedOrders.delete(orderId);
                selectAll.checked = false;
            }
        });
    });
    
    // تحديث أزرار الترقيم
    setupPagination(ordersArray);
}

// دالة لإعداد الترقيم
function setupPagination(ordersArray) {
    paginationElement.innerHTML = '';
    
    const totalPages = Math.ceil(ordersArray.length / rowsPerPage);
    
    // زر الصفحة السابقة
    const prevButton = document.createElement('button');
    prevButton.className = `pagination-btn ${currentPage === 1 ? 'disabled' : ''}`;
    prevButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayOrders(ordersArray);
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
            displayOrders(ordersArray);
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
            displayOrders(ordersArray);
        }
    });
    paginationElement.appendChild(nextButton);
}

// دالة لتصفية الطلبات
function filterOrders() {
    const selectedStatus = filterStatus.value;
    const selectedType = filterType.value;
    const selectedUser = filterUser.value;
    const searchTerm = searchInput.value.toLowerCase();
    
    const filteredOrders = allOrders.filter(order => {
        // التصفية حسب الحالة
        const matchesStatus = selectedStatus === 'all' || order.status === selectedStatus;
        
        // التصفية حسب النوع
        const matchesType = selectedType === 'all' || order.type === selectedType;
        
        // التصفية حسب المستخدم
        const matchesUser = selectedUser === 'all' || order.userId === selectedUser;
        
        // البحث بالرقم أو العنوان
        const matchesSearch = searchTerm === '' || 
            order.orderId.toLowerCase().includes(searchTerm) ||
            order.title.toLowerCase().includes(searchTerm) ||
            order.userName.toLowerCase().includes(searchTerm);
        
        return matchesStatus && matchesType && matchesUser && matchesSearch;
    });
    
    currentPage = 1;
    displayOrders(filteredOrders);
    updateStats(filteredOrders);
}

// دالة تحديد/إلغاء تحديد الكل
function toggleSelectAll() {
    const checkboxes = document.querySelectorAll('.order-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
        const orderId = parseInt(checkbox.getAttribute('data-id'));
        if (selectAll.checked) {
            selectedOrders.add(orderId);
        } else {
            selectedOrders.delete(orderId);
        }
    });
}

// دالة تحديث الإحصائيات
function updateStats(ordersArray) {
    const pendingOrders = ordersArray.filter(o => o.status === 'pending').length;
    const processingOrders = ordersArray.filter(o => o.status === 'processing').length;
    const approvedOrders = ordersArray.filter(o => o.status === 'approved').length;
    const rejectedOrders = ordersArray.filter(o => o.status === 'rejected').length;
    
    pendingCount.textContent = pendingOrders;
    processingCount.textContent = processingOrders;
    approvedCount.textContent = approvedOrders;
    rejectedCount.textContent = rejectedOrders;
}

// دالة إنشاء طلب جديد
function createNewOrder() {
    showAlert('جارٍ فتح نموذج إنشاء طلب جديد...', 'info');
}

// دالة تصدير الطلبات
function exportOrders() {
    showAlert('جارٍ تصدير بيانات الطلبات...', 'info');
}

// دالة تحديث الطلبات
function refreshOrders() {
    showAlert('جارٍ تحديث بيانات الطلبات...', 'info');
    filterOrders();
}

// دالة اعتماد الطلبات المحددة
function bulkApproveOrders() {
    if (selectedOrders.size === 0) {
        showAlert('يرجى تحديد طلب واحد على الأقل', 'warning');
        return;
    }
    
    if (confirm(`هل أنت متأكد من اعتماد ${selectedOrders.size} طلب؟`)) {
        selectedOrders.forEach(orderId => {
            const orderIndex = allOrders.findIndex(o => o.id === orderId);
            if (orderIndex !== -1) {
                allOrders[orderIndex].status = 'approved';
                allOrders[orderIndex].adminNotes = 'تم الاعتماد من قبل المدير';
            }
        });
        
        showAlert(`تم اعتماد ${selectedOrders.size} طلب بنجاح`, 'success');
        filterOrders();
        selectedOrders.clear();
        selectAll.checked = false;
    }
}

// دالة رفض الطلبات المحددة
function bulkRejectOrders() {
    if (selectedOrders.size === 0) {
        showAlert('يرجى تحديد طلب واحد على الأقل', 'warning');
        return;
    }
    
    const reason = prompt('يرجى إدخال سبب الرفض:');
    if (reason) {
        selectedOrders.forEach(orderId => {
            const orderIndex = allOrders.findIndex(o => o.id === orderId);
            if (orderIndex !== -1) {
                allOrders[orderIndex].status = 'rejected';
                allOrders[orderIndex].adminNotes = `مرفوض - ${reason}`;
            }
        });
        
        showAlert(`تم رفض ${selectedOrders.size} طلب بنجاح`, 'success');
        filterOrders();
        selectedOrders.clear();
        selectAll.checked = false;
    }
}

// دالة حذف الطلبات المحددة
function bulkDeleteOrders() {
    if (selectedOrders.size === 0) {
        showAlert('يرجى تحديد طلب واحد على الأقل', 'warning');
        return;
    }
    
    if (confirm(`⚠️ حذف نهائي\n\nهل أنت متأكد من حذف ${selectedOrders.size} طلب نهائياً؟ لا يمكن التراجع عن هذا الإجراء.`)) {
        selectedOrders.forEach(orderId => {
            const orderIndex = allOrders.findIndex(o => o.id === orderId);
            if (orderIndex !== -1) {
                allOrders.splice(orderIndex, 1);
            }
        });
        
        showAlert(`تم حذف ${selectedOrders.size} طلب بنجاح`, 'success');
        filterOrders();
        selectedOrders.clear();
        selectAll.checked = false;
    }
}

// دالة عرض تفاصيل الطلب
function viewOrder(orderId) {
    const order = allOrders.find(o => o.id === orderId);
    if (!order) return;
    
    currentOrderId = orderId;
    
    // تنسيق التاريخ
    const dateObj = new Date(order.date);
    const formattedDate = dateObj.toLocaleDateString('ar-SA');
    
    // تحديد نوع الطلب
    let typeText = '';
    switch(order.type) {
        case 'certification': typeText = 'شهادة أمنية'; break;
        case 'lab': typeText = 'مختبر افتراضي'; break;
        case 'resource': typeText = 'موارد أمنية'; break;
        case 'exam': typeText = 'اختبار أمني'; break;
    }
    
    // تحديد حالة الطلب
    let statusText = '';
    switch(order.status) {
        case 'pending': statusText = 'قيد المراجعة'; break;
        case 'processing': statusText = 'قيد المعالجة'; break;
        case 'approved': statusText = 'معتمدة'; break;
        case 'rejected': statusText = 'مرفوضة'; break;
    }
    
    // تحديد الأولوية
    let priorityText = '';
    switch(order.priority) {
        case 'normal': priorityText = 'عادي'; break;
        case 'high': priorityText = 'مرتفع'; break;
        case 'urgent': priorityText = 'عاجل'; break;
    }
    
    modalBody.innerHTML = `
        <div class="order-details-grid">
            <div class="detail-item">
                <div class="detail-label">رقم الطلب</div>
                <div class="detail-value">${order.orderId}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">المستخدم</div>
                <div class="detail-value">${order.userName} (${order.userLevel})</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">نوع الطلب</div>
                <div class="detail-value">${typeText}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">الحالة الحالية</div>
                <div class="detail-value">${statusText}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">الأولوية</div>
                <div class="detail-value">${priorityText}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">تاريخ الإنشاء</div>
                <div class="detail-value">${formattedDate}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">المرفقات</div>
                <div class="detail-value">${order.attachments} ملف</div>
            </div>
        </div>
        
        <div class="order-description">
            <h4><i class="fas fa-file-alt"></i> وصف الطلب</h4>
            <p>${order.description}</p>
        </div>
        
        <div class="admin-controls">
            <h4><i class="fas fa-cog"></i> أدوات التحكم</h4>
            
            <div class="control-group">
                <label>تغيير حالة الطلب</label>
                <select id="orderStatus">
                    <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>قيد المراجعة</option>
                    <option value="processing" ${order.status === 'processing' ? 'selected' : ''}>قيد المعالجة</option>
                    <option value="approved" ${order.status === 'approved' ? 'selected' : ''}>معتمدة</option>
                    <option value="rejected" ${order.status === 'rejected' ? 'selected' : ''}>مرفوضة</option>
                </select>
            </div>
            
            <div class="control-group">
                <label>ملاحظات المدير</label>
                <textarea id="adminNotes" placeholder="أدخل ملاحظات أو تعليمات للمستخدم...">${order.adminNotes || ''}</textarea>
            </div>
        </div>
    `;
    
    // تحديث أزرار النافذة
    modalFooter.innerHTML = `
        <button class="btn btn-success" onclick="updateOrder(${order.id})">
            <i class="fas fa-save"></i> حفظ التغييرات
        </button>
        <button class="btn btn-danger" onclick="deleteOrder(${order.id})">
            <i class="fas fa-trash"></i> حذف الطلب
        </button>

    `;
    
    // إظهار النافذة
    orderModal.style.display = 'flex';
}

// دالة تعديل الطلب
function editOrder(orderId) {
    viewOrder(orderId);
}

// دالة اعتماد طلب فردي
function approveOrder(orderId) {
    const orderIndex = allOrders.findIndex(o => o.id === orderId);
    if (orderIndex !== -1) {
        allOrders[orderIndex].status = 'approved';
        allOrders[orderIndex].adminNotes = 'تم الاعتماد من قبل المدير';
        
        showAlert('تم اعتماد الطلب بنجاح', 'success');
        filterOrders();
    }
}

// دالة رفض طلب فردي
function rejectOrder(orderId) {
    const reason = prompt('يرجى إدخال سبب الرفض:');
    if (reason) {
        const orderIndex = allOrders.findIndex(o => o.id === orderId);
        if (orderIndex !== -1) {
            allOrders[orderIndex].status = 'rejected';
            allOrders[orderIndex].adminNotes = `مرفوض - ${reason}`;
            
            showAlert('تم رفض الطلب بنجاح', 'success');
            filterOrders();
        }
    }
}

// دالة حذف طلب فردي
function deleteOrder(orderId) {
    if (confirm('⚠️ حذف نهائي\n\nهل أنت متأكد من حذف هذا الطلب نهائياً؟ لا يمكن التراجع عن هذا الإجراء.')) {
        const orderIndex = allOrders.findIndex(o => o.id === orderId);
        if (orderIndex !== -1) {
            allOrders.splice(orderIndex, 1);
            
            showAlert('تم حذف الطلب بنجاح', 'success');
            closeOrderModal();
            filterOrders();
        }
    }
}

// دالة تحديث الطلب
function updateOrder(orderId) {
    const orderIndex = allOrders.findIndex(o => o.id === orderId);
    if (orderIndex !== -1) {
        const newStatus = document.getElementById('orderStatus').value;
        const newNotes = document.getElementById('adminNotes').value;
        
        allOrders[orderIndex].status = newStatus;
        allOrders[orderIndex].adminNotes = newNotes;
        
        showAlert('تم تحديث الطلب بنجاح', 'success');
        closeOrderModal();
        filterOrders();
    }
}

// دالة إغلاق نافذة الطلب
function closeOrderModal() {
    orderModal.style.display = 'none';
    currentOrderId = null;
}

// دالة لعرض التنبيهات
function showAlert(message, type) {
    // تحديث لون التنبيه حسب النوع
    let backgroundColor = '';
    let icon = '';
    
    switch(type) {
        case 'success':
            backgroundColor = 'rgba(16, 185, 129, 0.9)';
            icon = 'fas fa-check-circle';
            break;
        case 'error':
            backgroundColor = 'rgba(239, 68, 68, 0.9)';
            icon = 'fas fa-exclamation-circle';
            break;
        case 'info':
            backgroundColor = 'rgba(59, 130, 246, 0.9)';
            icon = 'fas fa-info-circle';
            break;
        case 'warning':
            backgroundColor = 'rgba(245, 158, 11, 0.9)';
            icon = 'fas fa-exclamation-triangle';
            break;
    }
    
    adminAlert.style.backgroundColor = backgroundColor;
    alertMessage.textContent = message;
    adminAlert.querySelector('i').className = icon;
    adminAlert.style.display = 'block';
    
    // إخفاء التنبيه بعد 3 ثواني
    setTimeout(() => {
        adminAlert.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => {
            adminAlert.style.display = 'none';
            adminAlert.style.animation = '';
        }, 300);
    }, 3000);
}
