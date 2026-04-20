
// تبديل القائمة الجانبية للجوال
function toggleSidebar() {
    document.querySelector('.admin-sidebar').classList.toggle('active');
}

// إغلاق القائمة عند النقر خارجها (للجوال)
document.addEventListener('click', function (event) {
    const sidebar = document.querySelector('.admin-sidebar');
    const toggleBtn = document.querySelector('.sidebar-toggle');

    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});
// تبديل فترات المخططات
document.querySelectorAll('.period-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});




// تحديث الإحصائيات تلقائياً
function updateStats() {
    // محاكاة تحديث الإحصائيات
    document.querySelectorAll('.stat-info h3').forEach(stat => {
        const current = parseInt(stat.textContent.replace(/,/g, ''));
        const randomChange = Math.floor(Math.random() * 10) - 2; // تغيير عشوائي بين -2 و +7
        const newValue = current + randomChange;
        stat.textContent = newValue.toLocaleString();
    });
}

// تحديث الإحصائيات كل 30 ثانية
setInterval(updateStats, 30000);


// تنشيط عناصر القائمة
document.querySelectorAll('.admin-menu-item').forEach(item => {
    item.addEventListener('click', function () {
        document.querySelectorAll('.admin-menu-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
    });
});





function goToNotificatios() {
    window.location.href = "./notifications.html";
}
