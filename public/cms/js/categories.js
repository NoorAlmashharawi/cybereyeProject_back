
// تبديل طريقة العرض
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const view = this.getAttribute('data-view');
        const categoriesView = document.getElementById('categoriesView');

        if (view === 'grid') {
            categoriesView.classList.remove('list-view');
            categoriesView.classList.add('grid-view');
        } else {
            categoriesView.classList.remove('grid-view');
            categoriesView.classList.add('list-view');
        }
    });
});



// البحث
document.querySelector('.search-box input').addEventListener('input', function (e) {
    const searchTerm = e.target.value.toLowerCase();
    const categories = document.querySelectorAll('.category-card');

    categories.forEach(category => {
        const title = category.querySelector('h3').textContent.toLowerCase();
        const description = category.querySelector('p').textContent.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            category.style.display = 'flex';
        } else {
            category.style.display = 'none';
        }
    });
});

// تأثير Hover على البطاقات
document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('mouseenter', function () {
        this.style.transform = 'translateY(-10px)';
    });

    card.addEventListener('mouseleave', function () {
        this.style.transform = 'translateY(0)';
    });
});
