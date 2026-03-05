
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

// // تهيئة مخطط الإيرادات
// const revenueCtx = document.getElementById('revenueChart').getContext('2d');
// const revenueChart = new Chart(revenueCtx, {
//     type: 'line',
//     data: {
//         labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو'],
//         datasets: [{
//             label: 'الإيرادات ($)',
//             data: [8500, 9200, 10200, 12500, 11800, 13200, 14500],
//             borderColor: '#4361ee',
//             backgroundColor: 'rgba(67, 97, 238, 0.1)',
//             borderWidth: 3,
//             fill: true,
//             tension: 0.4
//         }]
//     },
//     options: {
//         responsive: true,
//         maintainAspectRatio: false,
//         plugins: {
//             legend: {
//                 display: true,
//                 position: 'top',
//                 labels: {
//                     font: {
//                         family: 'Segoe UI'
//                     }
//                 }
//             }
//         },
//         scales: {
//             y: {
//                 beginAtZero: true,
//                 ticks: {
//                     callback: function (value) {
//                         return '$' + value;
//                     }
//                 }
//             }
//         }
//     }
// });

// // تهيئة مخطط التسجيلات
// const registrationsCtx = document.getElementById('registrationsChart').getContext('2d');
// const registrationsChart = new Chart(registrationsCtx, {
//     type: 'bar',
//     data: {
//         labels: ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
//         datasets: [{
//             label: 'تسجيلات جديدة',
//             data: [42, 58, 65, 71, 84, 92, 105],
//             backgroundColor: [
//                 'rgba(67, 97, 238, 0.7)',
//                 'rgba(67, 97, 238, 0.7)',
//                 'rgba(67, 97, 238, 0.7)',
//                 'rgba(67, 97, 238, 0.7)',
//                 'rgba(67, 97, 238, 0.7)',
//                 'rgba(67, 97, 238, 0.7)',
//                 'rgba(28, 200, 138, 0.7)'
//             ],
//             borderColor: [
//                 '#4361ee',
//                 '#4361ee',
//                 '#4361ee',
//                 '#4361ee',
//                 '#4361ee',
//                 '#4361ee',
//                 '#28a745'
//             ],
//             borderWidth: 2
//         }]
//     },
//     options: {
//         responsive: true,
//         maintainAspectRatio: false,
//         plugins: {
//             legend: {
//                 display: true,
//                 position: 'top'
//             }
//         },
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

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

// // البحث في الجداول
// document.querySelector('.search-input').addEventListener('input', function (e) {
//     const searchTerm = e.target.value.toLowerCase();

//     document.querySelectorAll('.admin-table tbody tr').forEach(row => {
//         const text = row.textContent.toLowerCase();
//         row.style.display = text.includes(searchTerm) ? '' : 'none';
//     });
// });

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
