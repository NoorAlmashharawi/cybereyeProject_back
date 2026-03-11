
        // Slideshow functionality
        let current_slide = 0;
        let dotes = document.getElementsByClassName("dot");
        
        showSlide();
        
        function plusSlide(n) {
            current_slide += n;
            
            if (current_slide > 12) {
                current_slide = 0;
            } else if (current_slide < 0) {
                current_slide = 12;
            }
            showSlide();
        }
        
        function showSlide() {
            let slides = document.getElementsByClassName("mySlides");
            
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            
            for (let i = 0; i < dotes.length; i++) {
                dotes[i].className = "dot";
            }
            
            if (slides[current_slide]) {
                slides[current_slide].style.display = "block";
                dotes[current_slide].className += " active_dot";
            }
        }
        
        function enter(n) {
            current_slide = n;
            showSlide();
        }
        
        // Auto slideshow every 3 seconds
        setInterval(() => {
            plusSlide(1);
        }, 3000);
        
        // Image gallery function
        function functio(small) {
            var full = document.getElementById("imagbox");
            full.src = small.src;
        }
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    