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
            {{-- <li class="search">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button onclick="performSearch()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </li> --}}
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
        <a href="{{ route('home') }}">Home</a> 
        <a href="{{ route('contact') }}">Contact</a> 
        <a href="{{ route('view.login', ['guard' => 'student']) }}">Login</a>
    </div>
</div>


  

    <script src="../js/index.js"></script>
    <script>


    </script>
    @yield('scripts')



</body>

</html>
