@extends('cms.home.parent')

@section('title', 'CyberEye - Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/style.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    /* تنسيق القاموس الذكي */
    .dictionary-section {
        padding: 80px 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        direction: rtl;
    }

    .dictionary-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
    }

    .dictionary-title {
        font-size: 2rem;
        color: #1a237e;
        margin-bottom: 10px;
    }

    .dictionary-subtitle {
        color: #666;
        margin-bottom: 30px;
    }

    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-input {
        width: 100%;
        padding: 15px 20px;
        font-size: 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        outline: none;
        transition: all 0.3s;
        font-family: 'Cairo', sans-serif;
    }

    .search-input:focus {
        border-color: #1a237e;
        box-shadow: 0 0 10px rgba(26, 35, 126, 0.2);
    }

    .search-input::placeholder {
        color: #aaa;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #1a237e;
        font-size: 1.2rem;
    }

    .result-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        margin-top: 20px;
        text-align: right;
        display: none;
        border-right: 4px solid #4caf50;
    }

    .result-term {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a237e;
        margin-bottom: 10px;
    }

    .result-definition {
        color: #444;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .result-category {
        display: inline-block;
        background: #e8eaf6;
        color: #1a237e;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-top: 10px;
    }

    .result-example {
        background: #fff3e0;
        padding: 12px;
        border-radius: 10px;
        margin-top: 15px;
        color: #e65100;
        font-size: 0.9rem;
    }

    .not-found {
        background: #ffebee;
        color: #c62828;
        padding: 20px;
        border-radius: 15px;
        margin-top: 20px;
        display: none;
    }

    .loading-spinner {
        display: none;
        margin-top: 20px;
        color: #1a237e;
    }

    /* سلايد شو القاموس القديم */
    .con {
        padding: 50px 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        text-align: center;
    }

    .con h1 {
        font-size: 2.5rem;
        color: #1a237e;
        margin-bottom: 40px;
        position: relative;
        display: inline-block;
    }

    .con h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #1a237e, #4caf50);
        border-radius: 2px;
    }

    .slideshow-container {
        position: relative;
        max-width: 800px;
        margin: auto;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .mySlides {
        display: none;
        animation: fade 1.5s ease;
    }

    .mySlides img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    @keyframes fade {
        from {opacity: 0.4}
        to {opacity: 1}
    }

    .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin: 0 5px;
        background-color: #bbb;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot:hover {
        background-color: #1a237e;
        transform: scale(1.2);
    }

    .dot.active {
        background-color: #4caf50;
        width: 30px;
        border-radius: 6px;
    }

    .term-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
        padding: 20px;
        text-align: center;
    }

    .term-caption h3 {
        margin: 0;
        font-size: 1.5rem;
    }

    .term-caption p {
        margin: 5px 0 0;
        font-size: 0.9rem;
        opacity: 0.8;
    }

    @media (max-width: 768px) {
        .dictionary-container {
            margin: 0 20px;
            padding: 25px;
        }
        .mySlides img {
            height: 250px;
        }
    }
</style>
@endsection

@section('content')
<!-- القسم الرئيسي -->
<section>
    <div class="main" id="home">
        <div class="main-content">
            <div class="main-text">
                <h1>Cyber <br> <span>Security</span></h1>
                <p>Welcome to CyberEye, your ultimate guide to cybersecurity education. Learn everything from basics to advanced security techniques. Join thousands of students who have transformed their careers with our comprehensive courses and resources.</p>
            </div>

            <div class="main-image">
                <img src="{{ asset('cms/img/cyber.jpg') }}" alt="Cybersecurity">
            </div>
        </div>

        <div class="social-icon">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>

        <div class="button">
            <a href="{{ route('view.login', ['guard' => 'student']) }}">START NOW</a>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</section>

<!-- ========== القاموس الذكي (البحث) ========== -->
<div class="dictionary-section" id="dictionary">
    <div class="dictionary-container">
        <h2 class="dictionary-title">📖 القاموس الذكي 🔍</h2>
        <p class="dictionary-subtitle">ابحث عن أي مصطلح أمني أو تقني</p>

        <div class="search-box">
            <input type="text" id="searchInput" class="search-input" placeholder="مثال: Phishing, Malware, Firewall, Laravel..." autocomplete="off">
            <i class="fas fa-search search-icon"></i>
        </div>

        <div class="loading-spinner" id="loadingSpinner">
            <i class="fas fa-spinner fa-spin"></i> جاري البحث...
        </div>

        <div class="result-card" id="resultCard">
            <div class="result-term" id="resultTerm"></div>
            <div class="result-definition" id="resultDefinition"></div>
            <div class="result-category" id="resultCategory"></div>
            <div class="result-example" id="resultExample"></div>
        </div>

        <div class="not-found" id="notFound">
            <i class="fas fa-times-circle"></i> <span id="notFoundMessage"></span>
        </div>
    </div>
</div>

<!-- ========== السلايد شو (قاموس الصور) ========== -->
<div class="con">
    <h1>Cybersecurity Dictionary</h1>
    <div class="slideshow-container">
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/backdoor.jpg') }}" alt="Backdoor">
            <div class="term-caption">
                <h3>Backdoor</h3>
                <p>طريقة سرية للوصول إلى النظام</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/botnet.png') }}" alt="Botnet">
            <div class="term-caption">
                <h3>Botnet</h3>
                <p>شبكة من الأجهزة المخترقة</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/fa.jpg') }}" alt="Firewall">
            <div class="term-caption">
                <h3>Firewall</h3>
                <p>جدار حماية يمنع الدخول غير المصرح به</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/firewall.png') }}" alt="Firewall">
            <div class="term-caption">
                <h3>Firewall</h3>
                <p>نظام أمان يراقب حركة البيانات</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/hardening.png') }}" alt="Hardening">
            <div class="term-caption">
                <h3>Hardening</h3>
                <p>عملية تأمين النظام</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/malware.jpg') }}" alt="Malware">
            <div class="term-caption">
                <h3>Malware</h3>
                <p>برمجيات ضارة</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/pishing.jpg') }}" alt="Phishing">
            <div class="term-caption">
                <h3>Phishing</h3>
                <p>هندسة اجتماعية لسرقة البيانات</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/ransomware.jpg') }}" alt="Ransomware">
            <div class="term-caption">
                <h3>Ransomware</h3>
                <p>برمجيات فدية تطلب دفع فدية</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/social.jpg') }}" alt="Social Engineering">
            <div class="term-caption">
                <h3>Social Engineering</h3>
                <p>هندسة اجتماعية لخداع المستخدمين</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/spyware.png') }}" alt="Spyware">
            <div class="term-caption">
                <h3>Spyware</h3>
                <p>برامج تجسس</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/vpn.jpg') }}" alt="VPN">
            <div class="term-caption">
                <h3>VPN</h3>
                <p>شبكة خاصة افتراضية</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/trojan.jpg') }}" alt="Trojan">
            <div class="term-caption">
                <h3>Trojan</h3>
                <p>حصان طروادة</p>
            </div>
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/brute.png') }}" alt="Brute Force">
            <div class="term-caption">
                <h3>Brute Force</h3>
                <p>هجوم القوة العشوائية</p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 10px;">
        <span class="dot" onclick="currentSlide(0)"></span>
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
        <span class="dot" onclick="currentSlide(7)"></span>
        <span class="dot" onclick="currentSlide(8)"></span>
        <span class="dot" onclick="currentSlide(9)"></span>
        <span class="dot" onclick="currentSlide(10)"></span>
        <span class="dot" onclick="currentSlide(11)"></span>
        <span class="dot" onclick="currentSlide(12)"></span>
    </div>
</div>

<!-- Cybersecurity Roadmap -->
<div class="roadmap" id="roadmap">
    <h1>Cybersecurity Roadmap</h1>
    <div class="step">
        <div class="step-content">
            <h2>Operating Systems</h2>
            <p>Windows, Linux</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#windows" class="btn">Windows</a>
            <a href="../html/courses.html#linux" class="btn">Linux</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Networking</h2>
            <p>IP Address, DNS, HTTP/HTTPS, TCP/UDP, Ports, Firewalls, VPN, OSI Model, Subnetting</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#network" class="btn">Networking</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Programming</h2>
            <p>Java, Bash/Shell, JavaScript</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#java" class="btn">Java</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Security Fundamentals</h2>
            <p>CIA, Malware, Phishing, Social Engineering, Encryption, Authentication, Authorization</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#security" class="btn">Security</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Ethical Hacking</h2>
            <p>Install (Kali Linux), Tools (Nmap, Metasploit, Burp Suite, Wireshark)</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#ethical" class="btn">Ethical Hacking</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Penetration Testing</h2>
            <p>Learn (SQL Injection, XSS, CSRF, File Upload Attacks, Brute Force) Practice on (TryHackMe, Hack The Box)</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#penetration" class="btn">Penetration Testing</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Web Security</h2>
            <p>How websites work, Cookies & Sessions, APIs, Authentication Bugs</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html#websec" class="btn">Web Security</a>
        </div>
    </div>

    <div class="step">
        <div class="step-content">
            <h2>Choose a Path</h2>
            <p>Red Team, Blue Team, Purple Team, SOC Analyst, Cloud Security, Digital Forensics, Malware Analysis</p>
        </div>
        <div class="step-actions">
            <a href="../html/courses.html" class="btn">Explore Paths</a>
        </div>
    </div>
</div>

<!-- Resources -->
<div class="ex" id="resources">
    <h1>Resources</h1>
    <div class="external">
        <div class="card">
            <img src="{{ asset('cms/img/zero') }}" alt="Al Zero">
            <h3>Al Zero Academy</h3>
            <p>منصة عربية لتعلم البرمجة والتصميم والمجالات التقنية مجاناً.</p>
            <a href="https://academy.zer0s.com/" target="_blank">Visit</a>
        </div>

        <div class="card">
            <img src="{{ asset('cms/img/cisco.jpg') }}" alt="Cisco">
            <h3>Cisco Networking Academy</h3>
            <p>منصة عالمية لتعلم الشبكات والأمن السيبراني والشهادات المعتمدة.</p>
            <a href="https://www.netacad.com/" target="_blank">Visit</a>
        </div>

        <div class="card">
            <img src="{{ asset('cms/img/udemy.png') }}" alt="Udemy">
            <h3>Udemy</h3>
            <p>أكبر منصة تعليمية عالميًا بها آلاف الدورات في كل المجالات.</p>
            <a href="https://www.udemy.com/" target="_blank">Visit</a>
        </div>

        <div class="card">
            <img src="{{ asset('cms/img/coursera.png') }}" alt="Coursera">
            <h3>Coursera</h3>
            <p>منصة تعليمية عالمية بشهادات جامعية ودورات من أفضل الجامعات.</p>
            <a href="https://www.coursera.org/" target="_blank">Visit</a>
        </div>

        <div class="card">
            <img src="{{ asset('cms/img/khan.png') }}" alt="Khan Academy">
            <h3>Khan Academy</h3>
            <p>منصة تعليمية مجانية لتعلم العلوم والرياضيات والبرمجة لجميع الأعمار.</p>
            <a href="https://www.khanacademy.org/" target="_blank">Visit</a>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="about" id="about">
    <h1>Web <span>About</span></h1>
    <div class="about-main">
        <div class="about-image">
            <div class="about-small-image">
                <img src="{{ asset('cms/admins/baraa.jpg') }}" onclick="changeImage(this)" alt="Thumbnail 1">
                <img src="{{ asset('cms/admins/noor.jpg') }}" onclick="changeImage(this)" alt="Thumbnail 2">
                <img src="{{ asset('cms/admins/saja.jpg') }}" onclick="changeImage(this)" alt="Thumbnail 3">
                <img src="{{ asset('cms/admins/bassmah.jpg') }}" onclick="changeImage(this)" alt="Thumbnail 4">
                <img src="{{ asset('cms/admins/safa.jpg') }}" onclick="changeImage(this)" alt="Thumbnail 5">
            </div>
            <div class="image-contaner">
                <img src="{{ asset('cms/img/NetSec.jpg') }}" id="imagbox" alt="Main Image">
            </div>
        </div>
        <div class="about-text">
            <p>CyberEye is a comprehensive cybersecurity learning platform designed to help individuals and professionals enhance their security skills. Our mission is to make cybersecurity education accessible to everyone through structured courses, practical exercises, and real-world scenarios.</p>
            <p>We offer a wide range of courses covering fundamental to advanced topics in cybersecurity. Our experienced instructors and up-to-date curriculum ensure that you gain the skills needed in today's digital world.</p>
            <p>Join our community of learners and start your journey towards becoming a cybersecurity expert today!</p>
        </div>
    </div>
</div>

<!-- Reviews -->
<div class="review" id="Review">
    <h1>Student's <span>Review</span></h1>
    <div class="review-box">
        @forelse($latestReviews as $review)
            <div class="review-card">
                <div class="card-top">
                    <div class="profile">
                        <div class="profile-image">
                            <img src="{{ $review->user->profile_image ? asset('storage/' . $review->user->profile_image) : asset('cms/img/student1.jpg') }}" alt="Student">
                        </div>
                        <div class="name">
                            <strong>{{ $review->user->username }}</strong>
                            <p style="font-size: 0.7rem; color: #666; margin: 0;">Course: {{ $review->course->course_name }}</p>
                            <div class="like">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>"{{ Str::limit($review->comment, 150) }}"</p>
                </div>
            </div>
        @empty
            <p>No reviews available yet.</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('cms/js/index.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // السلايد شو
    let slideIndex = 0;
    let slides;
    let dots;

    function initSlideshow() {
        slides = document.getElementsByClassName("mySlides");
        dots = document.getElementsByClassName("dot");
        if (slides.length > 0) {
            showSlides(slideIndex);
            startAutoSlide();
        }
    }

    function showSlides(n) {
        if (!slides || slides.length === 0) return;
        if (n >= slides.length) slideIndex = 0;
        if (n < 0) slideIndex = slides.length - 1;
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            if (dots[i]) dots[i].classList.remove('active');
        }
        slides[slideIndex].style.display = "block";
        if (dots[slideIndex]) dots[slideIndex].classList.add('active');
    }

    function currentSlide(n) {
        slideIndex = n;
        showSlides(slideIndex);
        resetAutoSlide();
    }

    let slideInterval;
    function startAutoSlide() {
        if (slideInterval) clearInterval(slideInterval);
        slideInterval = setInterval(function() {
            slideIndex++;
            if (slideIndex >= slides.length) slideIndex = 0;
            showSlides(slideIndex);
        }, 4000);
    }

    function resetAutoSlide() {
        if (slideInterval) clearInterval(slideInterval);
        startAutoSlide();
    }

    // تغيير الصورة الرئيسية في قسم About
    function changeImage(element) {
        document.getElementById('imagbox').src = element.src;
    }

    // ========== القاموس الذكي (AJAX Search) ==========
    let searchTimeout;

    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        let term = $(this).val();
        if (term.length < 2) {
            $('#resultCard').hide();
            $('#notFound').hide();
            $('#loadingSpinner').hide();
            return;
        }
        searchTimeout = setTimeout(() => performSearch(term), 500);
    });

    function performSearch(term) {
        $('#loadingSpinner').show();
        $('#resultCard').hide();
        $('#notFound').hide();

        $.ajax({
            url: '{{ route("dictionary.search") }}',
            type: 'POST',
            data: { term: term, _token: '{{ csrf_token() }}' },
            success: function(response) {
                $('#loadingSpinner').hide();
                if (response.found) {
                    $('#resultTerm').text(response.term);
                    $('#resultDefinition').text(response.definition);
                    $('#resultCategory').text(response.category || 'عام');
                    if (response.example) {
                        $('#resultExample').html('<i class="fas fa-lightbulb"></i> مثال: ' + response.example).show();
                    } else {
                        $('#resultExample').hide();
                    }
                    $('#resultCard').show();
                } else {
                    $('#notFoundMessage').text(response.message);
                    $('#notFound').show();
                }
            },
            error: function() {
                $('#loadingSpinner').hide();
                $('#notFoundMessage').text('حدث خطأ أثناء البحث، حاول مرة أخرى');
                $('#notFound').show();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initSlideshow();
    });
</script>
@endsection