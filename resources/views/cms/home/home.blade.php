@extends('cms.home.parent')

@section('title', 'CyberEye - Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/style.css') }}">
<style>
    /* تنسيق خاص للقاموس */
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
        .con h1 {
            font-size: 2rem;
        }
        
        .mySlides img {
            height: 250px;
        }
        
        .term-caption h3 {
            font-size: 1rem;
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
            <a href="#">START NOW</a>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</section>

 <!-- Cybersecurity Dictionary -->
 <div class="con" id="dictionary">
    <h1>Cybersecurity Dictionary</h1>
    <div class="containar">
        <div class="mySlides">
            <img src="../cyber/backdoor.jpg" alt="Backdoor">
        </div>
        <div class="mySlides">
            <img src="../cyber/botnet.png" alt="Botnet">
        </div>
        <div class="mySlides">
            <img src="../cyber/fa.jpg" alt="Firewall">
        </div>
        <div class="mySlides">
            <img src="../cyber/firewall.png" alt="Firewall">
        </div>
        <div class="mySlides">
            <img src="../cyber/hardening.png" alt="Hardening">
        </div>
        <div class="mySlides">
            <img src="../cyber/malware.jpg" alt="Malware">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/pishing.jpg') }}" alt="Phishing">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/ransomware.jpg') }}" alt="Ransomware">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/social.jpg') }}" alt="Social Engineering">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/spyware.png') }}" alt="Spyware">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/vpn.jpg') }}" alt="VPN">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/trojan.jpg') }}" alt="Trojan">
        </div>
        <div class="mySlides">
            <img src="{{ asset('cms/cyber/brute.png') }}" alt="Brute Force">
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 10px;">
        <span class="dot" onclick="enter(0)"></span>
        <span class="dot" onclick="enter(1)"></span>
        <span class="dot" onclick="enter(2)"></span>
        <span class="dot" onclick="enter(3)"></span>
        <span class="dot" onclick="enter(4)"></span>
        <span class="dot" onclick="enter(5)"></span>
        <span class="dot" onclick="enter(6)"></span>
        <span class="dot" onclick="enter(7)"></span>
        <span class="dot" onclick="enter(8)"></span>
        <span class="dot" onclick="enter(9)"></span>
        <span class="dot" onclick="enter(10)"></span>
        <span class="dot" onclick="enter(11)"></span>
        <span class="dot" onclick="enter(12)"></span>
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
                <img src="{{ asset('cms/img/image.jpg') }}" onclick="functio(this)" alt="Thumbnail 1">
                <img src="{{ asset('cms/img/image.jpg') }}" onclick="functio(this)" alt="Thumbnail 2">
                <img src="{{ asset('cms/img/image.jpg') }}" onclick="functio(this)" alt="Thumbnail 3">
                <img src="{{ asset('cms/img/image.jpg') }}" onclick="functio(this)" alt="Thumbnail 4">
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
        <div class="review-card">
            <div class="card-top">
                <div class="profile">
                    <div class="profile-image">
                        <img src="{{asset('cms/img/student1.jpg')  }}" alt="Student">
                    </div>
                    <div class="name">
                        <strong>Bara'a</strong>
                        <div class="like">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="comment">
                <p>"CyberEye transformed my career! The courses are well-structured and the instructors are experts in their field. Highly recommended!"</p>
            </div>
        </div>
        
        <div class="review-card">
            <div class="card-top">
                <div class="profile">
                    <div class="profile-image">
                        <img src="{{ asset('cms/img/student2.jpg') }}" alt="Student">
                    </div>
                    <div class="name">
                        <strong>Noor</strong>
                        <div class="like">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="comment">
                <p>"Great platform for beginners. The roadmap helped me understand what to learn next. The community is very supportive."</p>
            </div>
        </div>
        
        <div class="review-card">
            <div class="card-top">
                <div class="profile">
                    <div class="profile-image">
                        <img src="{{ asset('cms/img/student3.jpg') }}" alt="Student">
                    </div>
                    <div class="name">
                        <strong>Bassmah</strong>
                        <div class="like">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="comment">
                <p>"The practical exercises are amazing! I learned more here than in my university courses. The certificates helped me get a job."</p>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('cms/js/index.js') }}"></script>
<script>
    let slideIndex = 0;
    let slides;
    let dots;
    let slideInterval;
    
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
        
        if (n >= slides.length) { slideIndex = 0 }
        if (n < 0) { slideIndex = slides.length - 1 }
        
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
    
 
    document.addEventListener('DOMContentLoaded', function() {
        initSlideshow();
    });
    

    function changeImage(element) {
        document.getElementById('imagbox').src = element.src;
    }


    
</script>
@endsection