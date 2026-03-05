
// تبديل المفضلة
document.querySelectorAll('.favorite').forEach(btn => {
    btn.addEventListener('click', function () {
        this.classList.toggle('active');
        const icon = this.querySelector('i');
        if (this.classList.contains('active')) {
            icon.classList.remove('far', 'fa-heart');
            icon.classList.add('fas', 'fa-heart');
            showNotification('تمت الإضافة إلى المفضلة');
        } else {
            icon.classList.remove('fas', 'fa-heart');
            icon.classList.add('far', 'fa-heart');
            showNotification('تمت الإزالة من المفضلة');
        }
    });
});

// تحميل المادة
document.querySelectorAll('.download-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const materialCard = this.closest('.material-card');
        const title = materialCard.querySelector('h3').textContent;
        showNotification(`جاري تحميل: ${title}`);

        // محاكاة التحميل
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحميل...';
        this.disabled = true;

        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-download"></i> تم التحميل';
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-download"></i> تحميل';
                this.disabled = false;
            }, 2000);
        }, 1500);
    });
});



// البحث


// البحث الفعلي في المواد (مشابه لصفحة التصنيفات)
document.querySelector('.search-box input').addEventListener('input', function (e) {
    const searchTerm = e.target.value.toLowerCase().trim();
    const materialCards = document.querySelectorAll('.material-card');

    // إذا كان البحث فارغاً، اعرض كل المواد
    if (searchTerm === '') {
        materialCards.forEach(card => {
            card.style.display = 'flex';
            card.classList.remove('highlight');
        });
        return;
    }

    // البحث في المواد
    materialCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('.material-body p').textContent.toLowerCase();
        const tags = Array.from(card.querySelectorAll('.tag'))
            .map(tag => tag.textContent.toLowerCase())
            .join(' ');

        // البحث في العنوان والوصف والتاغات
        if (title.includes(searchTerm) ||
            description.includes(searchTerm) ||
            tags.includes(searchTerm)) {

            card.style.display = 'flex';
            card.classList.add('highlight');

            // تأثير توضيح عند العثور على نتيجة
            setTimeout(() => {
                card.classList.remove('highlight');
            }, 1000);

        } else {
            card.style.display = 'none';
        }
    });

    // إظهار عدد النتائج
    showSearchResultsCount(searchTerm);
});

// زر البحث
document.querySelector('.search-box button').addEventListener('click', function () {
    const searchInput = document.querySelector('.search-box input');
    const searchTerm = searchInput.value.toLowerCase().trim();

    if (searchTerm === '') {
        showNotification('الرجاء إدخال كلمة بحث');
        searchInput.focus();
        return;
    }

    // تشغيل البحث تلقائياً
    const event = new Event('input');
    searchInput.dispatchEvent(event);
});

// عرض عدد نتائج البحث
function showSearchResultsCount(searchTerm) {
    const visibleCards = document.querySelectorAll('.material-card[style*="display: flex"]');
    const totalCards = document.querySelectorAll('.material-card').length;

    // إزالة عداد النتائج السابق إن وجد
    const oldCounter = document.querySelector('.search-counter');
    if (oldCounter) oldCounter.remove();

    if (searchTerm !== '') {
        const counter = document.createElement('div');
        counter.className = 'search-counter';
        counter.innerHTML = `
    <span>عُثر على ${visibleCards.length} من ${totalCards} نتيجة لـ "${searchTerm}"</span>
    <button class="clear-search-btn">✕ إلغاء</button>
`;

        // إضافة العداد بعد ترويسة المحتوى
        const contentHeader = document.querySelector('.content-header');
        contentHeader.parentNode.insertBefore(counter, contentHeader.nextSibling);

        // حدث إلغاء البحث
        counter.querySelector('.clear-search-btn').addEventListener('click', function () {
            document.querySelector('.search-box input').value = '';
            const event = new Event('input');
            document.querySelector('.search-box input').dispatchEvent(event);
            counter.remove();
        });
    }
}

// إضافة CSS للنتائج
const searchStyles = `
.material-card.highlight {
animation: highlightPulse 1s ease;
border: 2px solid #4caf50;
box-shadow: 0 0 20px rgba(76, 175, 80, 0.3);
}

@keyframes highlightPulse {
0% { transform: scale(1); }
50% { transform: scale(1.02); }
100% { transform: scale(1); }
}

.search-counter {
background: #e8eaf6;
padding: 15px 25px;
border-radius: 10px;
margin: 20px 0;
display: flex;
justify-content: space-between;
align-items: center;
border-right: 5px solid #1a237e;
animation: slideDown 0.3s ease;
}

.search-counter span {
color: #1a237e;
font-weight: 600;
font-size: 1.1rem;
}

.clear-search-btn {
background: #ff4757;
color: white;
border: none;
padding: 8px 20px;
border-radius: 6px;
cursor: pointer;
font-size: 0.9rem;
transition: all 0.3s;
}

.clear-search-btn:hover {
background: #ff3742;
transform: scale(1.05);
}

@keyframes slideDown {
from {
    opacity: 0;
    transform: translateY(-20px);
}
to {
    opacity: 1;
    transform: translateY(0);
}
}

.material-card {
transition: all 0.3s ease;
}

/* تحسين عرض البطاقات في وضع البحث */
.material-card[style*="display: none"] {
display: none !important;
}

.material-card[style*="display: flex"] {
display: flex !important;
flex-direction: column;
}
`;

// إضافة الأنماط إلى الصفحة
const styleSheet = document.createElement('style');
styleSheet.textContent = searchStyles;
document.head.appendChild(styleSheet);

// إظهار إشعارات (نفس الدالة السابقة)
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    notification.style.cssText = `
position: fixed;
top: 100px;
left: 20px;
background: #1a237e;
color: white;
padding: 15px 25px;
border-radius: 8px;
box-shadow: 0 5px 15px rgba(0,0,0,0.2);
z-index: 1000;
animation: slideIn 0.3s ease;
`;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// إضافة أنميشن للإشعارات
const notificationStyle = document.createElement('style');
notificationStyle.textContent = `
@keyframes slideIn {
from { transform: translateX(-100%); opacity: 0; }
to { transform: translateX(0); opacity: 1; }
}
@keyframes slideOut {
from { transform: translateX(0); opacity: 1; }
to { transform: translateX(-100%); opacity: 0; }
}
`;
document.head.appendChild(notificationStyle);
// document.querySelector('.search-box input').addEventListener('keyup', function(e) {
//     if (e.key === 'Enter') {
//         searchMaterials(this.value);
//     }
// });

// document.querySelector('.search-box button').addEventListener('click', function() {
//     const input = document.querySelector('.search-box input');
//     searchMaterials(input.value);
// });

// function searchMaterials(query) {
//     if (query.trim() !== '') {
//         showNotification(`جاري البحث عن: ${query}`);
//         // هنا يمكن إضافة منطق البحث الفعلي
//     }
// }

// إشعارات
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        left: 20px;
        background: #1a237e;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        z-index: 1000;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// إضافة أنميشن للإشعارات
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(-100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(-100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// تفاعل عند التمرير
window.addEventListener('scroll', function () {
    const materials = document.querySelectorAll('.material-card');
    materials.forEach(card => {
        const rect = card.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }
    });
});

// تهيئة البطاقات عند التحميل
document.addEventListener('DOMContentLoaded', function () {
    const materials = document.querySelectorAll('.material-card');
    materials.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });

    setTimeout(() => {
        materials.forEach(card => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        });
    }, 100);
});
