// About Us


document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll('.animate-fade-in, .animate-slide-left, .animate-slide-right');

    function checkPosition() {
        animatedElements.forEach((element) => {
            const positionFromTop = element.getBoundingClientRect().top;
            if (positionFromTop - window.innerHeight <= 0) {
                element.classList.add('in-view');
            }
        });
    }

    window.addEventListener('scroll', checkPosition);
    checkPosition(); // Initial check in case elements are in view on load
});

// Contact

document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll('.animate-fade-in');

    function checkPosition() {
        animatedElements.forEach((element) => {
            const positionFromTop = element.getBoundingClientRect().top;
            if (positionFromTop - window.innerHeight <= 0) {
                element.classList.add('in-view');
            }
        });
    }

    window.addEventListener('scroll', checkPosition);
    checkPosition(); // Initial check in case elements are in view on load
});


// Cookies disapear after 3 sec 

