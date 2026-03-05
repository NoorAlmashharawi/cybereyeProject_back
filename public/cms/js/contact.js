
// تنفيذ نموذج الاتصال
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // جمع البيانات من النموذج
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value,
        newsletter: document.getElementById('newsletter').checked
    };
    
    // التحقق من البيانات
    if (!formData.name || !formData.email || !formData.subject || !formData.message) {
        alert('يرجى ملء جميع الحقول المطلوبة');
        return;
    }
    
    // في التطبيق الحقيقي، هنا سيتم إرسال البيانات للخادم
    console.log('بيانات النموذج:', formData);
    
    // عرض رسالة نجاح
    alert('شكراً على رسالتك! سنتواصل معك قريباً.');
    
    // إعادة تعيين النموذج
    this.reset();
});

// تنفيذ الأسئلة الشائعة
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        const icon = question.querySelector('i');
        
        // إغلاق جميع الإجابات الأخرى
        document.querySelectorAll('.faq-answer').forEach(ans => {
            if (ans !== answer) {
                ans.classList.remove('active');
                ans.parentElement.querySelector('i').classList.remove('fa-chevron-up');
                ans.parentElement.querySelector('i').classList.add('fa-chevron-down');
            }
        });
        
        // تبديل الإجابة الحالية
        answer.classList.toggle('active');
        icon.classList.toggle('fa-chevron-up');
        icon.classList.toggle('fa-chevron-down');
    });
});

// تأثير الكتابة في البانر
const heroTitle = document.querySelector('.hero-content h1');
const text = heroTitle.textContent;
heroTitle.textContent = '';

let i = 0;
function typeWriter() {
    if (i < text.length) {
        heroTitle.textContent += text.charAt(i);
        i++;
        setTimeout(typeWriter, 100);
    }
}

// بدء تأثير الكتابة عند تحميل الصفحة
window.addEventListener('load', () => {
    typeWriter();
});

// تأثير التمرير السلس للروابط الداخلية
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });
        }
    });
});
