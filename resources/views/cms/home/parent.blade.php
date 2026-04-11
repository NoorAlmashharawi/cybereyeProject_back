<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEye - Home</title>
    <link rel="stylesheet" href="{{ asset('cms/css/navbar.css') }}">
  
    <link rel="shortcut icon" href="{{ asset('cms/img/digital.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


    @yield('styles')
</head>

<body>
  
     <!-- شريط التنقل -->
     <nav>
        <div class="logo">
            <h1>CYBER<span>eye</span></h1>
        </div>
        
        <ul>
            <li><a href="{{ route('home') }}" class="active">Home</a></li>
            <li><a href="{{ route('home') }}#dictionary">Dictionary</a></li>
             <li><a href="{{ route('home') }}#roadmap">Roadmap</a></li>
            {{-- <li><a href="../html/courses.html">Courses</a></li> --}}
            <li><a href="{{ route('home') }}#resources">Resources</a></li>
            <li><a href="{{ route('home') }}#about">About</a></li>
            <li><a href="{{ route('home') }}#Review">Review</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li class="search">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button onclick="performSearch()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </li>
        </ul>
        
        <div class="icons">
            <a href="#"><i class="fa-solid fa-heart"></i></a>
            {{-- login --}}
            <a href="../html/cyber.html"><i class="fa-solid fa-user"></i></a>
        </div>
    </nav>

    @yield('content')
<!-- Footer -->
<div class="footer">
    <p>cybereye@gmail.com | ©  CyberEye. All rights reserved.</p>
    <div class="footer-links">
        <a href="{{ route('home') }}">Home</a> | 
        <a href="../html/contact.html">Contact</a> | 
        <a href="../html/cyber.html">Login</a>
    </div>
</div>


  

    <script src="../js/index.js"></script>
    <script>
function performSearch() {
    let searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
    
    if (searchTerm === "") {
        alert("الرجاء إدخال كلمة للبحث");
        return;
    }
    
    let found = false;
    let searchResults = [];
    
    // 1. البحث في قسم القاموس (Dictionary)
    let dictionarySection = document.getElementById('dictionary');
    if (dictionarySection) {
        let dictionaryItems = dictionarySection.querySelectorAll('.mySlides');
        for (let item of dictionaryItems) {
            let term = item.querySelector('.term-caption h3')?.innerText.toLowerCase() || '';
            let definition = item.querySelector('.term-caption p')?.innerText.toLowerCase() || '';
            
            if (term.includes(searchTerm) || definition.includes(searchTerm)) {
                dictionarySection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                found = true;
                highlightElement(item);
                break;
            }
        }
    }
    
    // 2. البحث في قسم Roadmap (الخطوات)
    if (!found) {
        let roadmapSection = document.getElementById('roadmap');
        if (roadmapSection) {
            let steps = roadmapSection.querySelectorAll('.step');
            for (let step of steps) {
                let stepText = step.innerText.toLowerCase();
                if (stepText.includes(searchTerm)) {
                    step.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    found = true;
                    highlightElement(step);
                    break;
                }
            }
        }
    }
    
    // 3. البحث في قسم Resources (المصادر)
    if (!found) {
        let resourcesSection = document.getElementById('resources');
        if (resourcesSection) {
            let cards = resourcesSection.querySelectorAll('.card');
            for (let card of cards) {
                let cardText = card.innerText.toLowerCase();
                if (cardText.includes(searchTerm)) {
                    card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    found = true;
                    highlightElement(card);
                    break;
                }
            }
        }
    }
    
    // 4. البحث في قسم About (عن الموقع)
    if (!found) {
        let aboutSection = document.getElementById('about');
        if (aboutSection && aboutSection.innerText.toLowerCase().includes(searchTerm)) {
            aboutSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            found = true;
            highlightElement(aboutSection);
        }
    }
    
    // 5. البحث في قسم Reviews (التقييمات)
    if (!found) {
        let reviewSection = document.getElementById('Review');
        if (reviewSection) {
            let reviews = reviewSection.querySelectorAll('.review-card');
            for (let review of reviews) {
                let reviewText = review.innerText.toLowerCase();
                if (reviewText.includes(searchTerm)) {
                    review.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    found = true;
                    highlightElement(review);
                    break;
                }
            }
        }
    }
    
    // 6. البحث في القسم الرئيسي (Hero)
    if (!found) {
        let heroSection = document.getElementById('home');
        if (heroSection && heroSection.innerText.toLowerCase().includes(searchTerm)) {
            heroSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            found = true;
            highlightElement(heroSection);
        }
    }
    
    if (!found) {
        alert("❌ لم يتم العثور على نتائج للبحث: \"" + searchTerm + "\"");
    }
}

    </script>
    @yield('scripts')



</body>

</html>
