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



//// Live Search javascript 
$(document).ready(function() {
    $('#live_search').on('input', function() {
        let suggestion = $(this).val();

        if (suggestion.length > 0) {
            $.ajax({
                url: 'suggestion.php',
                method: 'POST',
                data: { suggestion: suggestion },
                success: function(response) {
                    $('#test').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error: ", error);
                }
            });
        } else {
            $('#test').html('');
        }
    });
});
