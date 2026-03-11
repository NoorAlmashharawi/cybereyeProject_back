
// بيانات الإشعارات
let notifications = JSON.parse(localStorage.getItem('userNotifications')) || [];
let filteredNotifications = [];

// أنواع الإشعارات
const notificationTypes = {
    system: { icon: 'fas fa-cog', class: 'info' },
    user: { icon: 'fas fa-user', class: 'success' },
    order: { icon: 'fas fa-shopping-cart', class: 'warning' },
    alert: { icon: 'fas fa-exclamation-triangle', class: 'danger' },
    message: { icon: 'fas fa-envelope', class: 'info' },
    security: { icon: 'fas fa-shield-alt', class: 'danger' }
};

// تهيئة الصفحة
document.addEventListener('DOMContentLoaded', function() {
    if (notifications.length === 0) {
        loadDemoNotifications();
    }
    renderNotifications();
    updateStats();
});

// تحميل بيانات تجريبية
function loadDemoNotifications() {
    const demoNotifications = [
        {
            id: 1,
            type: 'user',
            title: 'مستخدم جديد مسجل',
            message: 'تم تسجيل مستخدم جديد: أحمد محمد. تحقق من ملفه الشخصي.',
            time: '2024-01-15T10:30:00',
            read: false,
            link: '/users/123'
        },
        {
            id: 2,
            type: 'order',
            title: 'طلب جديد #45678',
            message: 'تم استلام طلب جديد من علياء حسن. المبلغ الإجمالي: 250 ر.س',
            time: '2024-01-15T09:15:00',
            read: false,
            link: '/orders/45678'
        },
        {
            id: 3,
            type: 'system',
            title: 'تحديث النظام',
            message: 'تم تحديث النظام إلى الإصدار 2.5.0. شاهد التغييرات الجديدة.',
            time: '2024-01-14T14:20:00',
            read: true,
            link: '/updates'
        },
        {
            id: 4,
            type: 'alert',
            title: 'تحذير الأمان',
            message: 'تم اكتشاف محاولة تسجيل دخول غير معتادة. تحقق من سجل الأمان.',
            time: '2024-01-14T08:45:00',
            read: true,
            link: '/security'
        },
        {
            id: 5,
            type: 'message',
            title: 'رسالة جديدة',
            message: 'لديك رسالة من فريق الدعم الفني بخصوص طلبك الأخير.',
            time: '2024-01-13T16:10:00',
            read: true,
            link: '/messages'
        },
        {
            id: 6,
            type: 'order',
            title: 'طلب تسجيا دخول',
            message: 'مستخدم جديد',
            time: '2024-01-13T11:30:00',
            read: false,
            link: '/orders/45679'
        },
        {
            id: 7,
            type: 'system',
            title: 'نسخ احتياطي ناجح',
            message: 'تم إنشاء نسخة احتياطية للنظام بنجاح في الساعة 02:00 صباحاً.',
            time: '2024-01-12T02:00:00',
            read: true,
            link: '/backups'
        },
        {
            id: 8,
            type: 'user',
            title: 'مراجعة حساب',
            message: 'حساب المستخدم سارة عبدالله يحتاج للمراجعة والتوثيق.',
            time: '2024-01-11T15:45:00',
            read: false,
            link: '/users/456'
        }
    ];

    notifications = demoNotifications;
    saveNotifications();
}

// حفظ الإشعارات
function saveNotifications() {
    localStorage.setItem('userNotifications', JSON.stringify(notifications));
}

// عرض الإشعارات
function renderNotifications(filter = 'all', type = 'all', dateFrom = null, dateTo = null) {
    const list = document.getElementById('notificationsList');
    
    // تطبيق الفلتر
    filteredNotifications = notifications.filter(notification => {
        // فلتر النوع
        if (filter === 'unread' && notification.read) return false;
        if (filter === 'read' && !notification.read) return false;
        
        // فلتر نوع الإشعار
        if (type !== 'all' && notification.type !== type) return false;
        
        // فلتر التاريخ
        const notificationDate = new Date(notification.time);
        if (dateFrom && notificationDate < new Date(dateFrom)) return false;
        if (dateTo && notificationDate > new Date(dateTo + 'T23:59:59')) return false;
        
        // فلتر اليوم
        if (filter === 'today') {
            const today = new Date();
            return notificationDate.toDateString() === today.toDateString();
        }
        
        // فلتر الأسبوع
        if (filter === 'week') {
            const weekAgo = new Date();
            weekAgo.setDate(weekAgo.getDate() - 7);
            return notificationDate >= weekAgo;
        }
        
        return true;
    });

    // إذا لم توجد إشعارات
    if (filteredNotifications.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-bell-slash"></i>
                <h3>لا توجد إشعارات</h3>
                <p>لا توجد إشعارات تطابق معايير البحث</p>
                <button class="btn btn-outline" id="clearFiltersBtn">
                    <i class="fas fa-times"></i> مسح الفلاتر
                </button>
            </div>
        `;
        document.getElementById('clearFiltersBtn')?.addEventListener('click', resetFilters);
        return;
    }

    // عرض الإشعارات
    list.innerHTML = filteredNotifications.map(notification => {
        const typeInfo = notificationTypes[notification.type] || notificationTypes.system;
        const timeAgo = getTimeAgo(notification.time);
        const dateFormatted = new Date(notification.time).toLocaleDateString('ar-SA', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        return `
            <div class="notification-item ${notification.read ? '' : 'unread'}" data-id="${notification.id}">
                ${!notification.read ? '<div class="notification-badge"></div>' : ''}
                <div class="notification-icon ${typeInfo.class}">
                    <i class="${typeInfo.icon}"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-header">
                        <div class="notification-title">${notification.title}</div>
                        <div class="notification-time" title="${dateFormatted}">${timeAgo}</div>
                    </div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-actions">
                        <button class="action-btn mark-read" onclick="markAsRead(${notification.id})">
                            <i class="fas fa-envelope-open"></i>
                            ${notification.read ? 'تم القراءة' : 'تحديد كمقروء'}
                        </button>
                        <button class="action-btn delete" onclick="deleteNotification(${notification.id})">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    
                    </div>
                </div>
            </div>
        `;
    }).join('');

    updateShowingCount();
}

// تحديث الإحصائيات
function updateStats() {
    const total = notifications.length;
    const unread = notifications.filter(n => !n.read).length;
    const read = total - unread;

    document.getElementById('totalCount').textContent = total;
    document.getElementById('unreadCount').textContent = unread;
    document.getElementById('readCount').textContent = read;
}

// تحديث العداد
function updateShowingCount() {
    document.getElementById('showingCount').textContent = filteredNotifications.length;
    document.getElementById('totalShowing').textContent = notifications.length;
}

// تحديد كمقروء
function markAsRead(id) {
    const notification = notifications.find(n => n.id === id);
    if (notification) {
        notification.read = true;
        saveNotifications();
        renderNotifications();
        updateStats();
        
        // تحديث العداد في الهيدر الرئيسي (لو كان هناك)
        if (window.opener) {
            window.opener.updateNotificationBadge();
        }
    }
}

// تحديد الكل كمقروء
function markAllAsRead() {
    notifications.forEach(n => n.read = true);
    saveNotifications();
    renderNotifications();
    updateStats();
}

// حذف إشعار
function deleteNotification(id) {
    if (confirm('هل أنت متأكد من حذف هذا الإشعار؟')) {
        notifications = notifications.filter(n => n.id !== id);
        saveNotifications();
        renderNotifications();
        updateStats();
    }
}

// حذف الكل
document.getElementById('deleteAllBtn')?.addEventListener('click', function() {
    if (confirm('هل أنت متأكد من حذف كل الإشعارات؟ لا يمكن التراجع عن هذا الإجراء.')) {
        notifications = [];
        saveNotifications();
        renderNotifications();
        updateStats();
    }
});



// فلتر التبويبات
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        const type = document.getElementById('typeFilter').value;
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;
        
        renderNotifications(filter, type, dateFrom, dateTo);
    });
});

// تطبيق الفلاتر
document.getElementById('applyFilters')?.addEventListener('click', function() {
    const activeTab = document.querySelector('.filter-tab.active');
    const filter = activeTab ? activeTab.dataset.filter : 'all';
    const type = document.getElementById('typeFilter').value;
    const dateFrom = document.getElementById('dateFrom').value;
    const dateTo = document.getElementById('dateTo').value;
    
    renderNotifications(filter, type, dateFrom, dateTo);
});

// إعادة تعيين الفلاتر
function resetFilters() {
    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    document.querySelector('[data-filter="all"]').classList.add('active');
    document.getElementById('typeFilter').value = 'all';
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
    renderNotifications();
}

document.getElementById('resetFilters')?.addEventListener('click', resetFilters);

// تحميل بيانات تجريبية
document.getElementById('loadDemo')?.addEventListener('click', function() {
    loadDemoNotifications();
    renderNotifications();
    updateStats();
    this.innerHTML = '<i class="fas fa-check"></i> تم التحميل';
    setTimeout(() => {
        this.style.display = 'none';
    }, 2000);
});

// دالة لتحويل الوقت
function getTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return 'الآن';
    if (diffMins < 60) return `منذ ${diffMins} دقيقة`;
    if (diffHours < 24) return `منذ ${diffHours} ساعة`;
    if (diffDays === 1) return 'أمس';
    if (diffDays < 7) return `منذ ${diffDays} يوم`;
    if (diffDays < 30) return `منذ ${Math.floor(diffDays / 7)} أسبوع`;
    if (diffDays < 365) return `منذ ${Math.floor(diffDays / 30)} شهر`;
    return `منذ ${Math.floor(diffDays / 365)} سنة`;
}

// ترتيب الإشعارات من الأحدث للأقدم
function sortNotifications() {
    notifications.sort((a, b) => new Date(b.time) - new Date(a.time));
}

// تحديث العداد في الصفحات الأخرى
window.updateNotificationBadge = function() {
    const unreadCount = notifications.filter(n => !n.read).length;
    // يمكنك إرسال هذا للصفحة الرئيسية
    return unreadCount;
};
