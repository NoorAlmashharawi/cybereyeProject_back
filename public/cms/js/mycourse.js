function loadUser(){
    const name = localStorage.getItem("userName") || "المستخدم";
    const email = localStorage.getItem("userEmail") || "example@email.com";
    userName.textContent = name;
    userEmail.textContent = email;
    avatar.textContent = name.charAt(0);
}

let allCourses = JSON.parse(localStorage.getItem("enrolledCourses")) || [];

function loadCourses(filter='all'){
    const container = document.getElementById("courses");
    const continueBox = document.getElementById("continueBox");
    let courses = allCourses;

    if(filter==='in-progress') courses = courses.filter(c=>c.progress<100);
    if(filter==='completed') courses = courses.filter(c=>c.progress>=100);
    if(filter==='wishlist') courses = courses.filter(c=>c.wishlist);

    document.querySelectorAll('.sidebar ul li').forEach(li=>li.classList.remove('active'));
    const map = {'all':0,'in-progress':1,'completed':2,'wishlist':3};
    document.querySelectorAll('.sidebar ul li')[map[filter]].classList.add('active');

    const inProgress = courses.find(c=>c.progress<100);
    if(inProgress){
        continueBox.innerHTML = `
        <div class="continue-box">
            <div class="continue-info">
                <h3>Continue Learning</h3>
                <p>${inProgress.title}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:${inProgress.progress}%"></div>
                </div>
                <small>${inProgress.progress}% مكتمل</small>
            </div>
            <button class="btn primary" onclick="openCourse('${inProgress.id}')">
                <i class="fas fa-play"></i> استمر
            </button>
        </div>`;
    }else{
        continueBox.innerHTML='';
    }

    if(courses.length===0){
        container.innerHTML = `
        <div class="empty">
            <i class="fas fa-user-graduate"></i>
            <h3>لا توجد مساقات</h3>
            <p>ابدأ الآن وابنِ مستقبلك</p>
            <div style="margin-top:20px; display:flex; gap:12px; justify-content:center;">
                <button class="btn primary" onclick="browseCourses()">
                    <i class="fas fa-search"></i> تصفح الكورسات
                </button>
                <button class="btn secondary" onclick="viewCertificates()">
                    <i class="fas fa-certificate"></i> الشهادات
                </button>
            </div>
        </div>`;
        return;
    }

    container.innerHTML='';
    courses.forEach(c=>{
        container.innerHTML+=`
        <div class="course-card">
            <div class="course-cover">
                <i class="${c.icon||'fas fa-shield-alt'}"></i>
            </div>
            <div class="course-body">
                <h3>${c.title}</h3>
                <p>${c.description||''}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:${c.progress}%"></div>
                </div>
                <div class="progress-text">${c.progress}% مكتمل</div>
                <div class="actions">
                    <button class="btn primary" onclick="openCourse('${c.id}')">استمر</button>
                    <button class="btn secondary">تفاصيل</button>
                </div>
            </div>
        </div>`;
    });
}

function openCourse(id){
    const course = allCourses.find(c=>c.id===id);
    if(course){
        localStorage.setItem("currentCourse",JSON.stringify(course));
        location.href="course-player.html";
    }
}
function filterCourses(type){ loadCourses(type); }
function browseCourses(){ location.href="../html/courses.html"; }
function viewCertificates(){ location.href="../html/certification.html"; }

document.addEventListener("DOMContentLoaded",()=>{
    loadUser();
    loadCourses();
});