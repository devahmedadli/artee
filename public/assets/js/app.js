// Navbar
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('nav');

    function onScroll() {
        if (window.scrollY > 50) { // You can adjust this value as needed
            nav.classList.add('bg-white');
            nav.classList.add('shadow-sm');
        } else {
            nav.classList.remove('bg-white');
            nav.classList.remove('shadow-sm');
        }
    }

    window.addEventListener('scroll', onScroll);

    // Initial check in case the page is loaded with scroll position
    onScroll();
});
// Settings - Image Preview
// Preview Uploaded Image
function previewImage(event, id) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById(id);
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()


// Making the numbers counting
var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            countUp(entry.target);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

$('.counter-item').each(function () {
    observer.observe(this);
});

// Function to animate counting effect for each element
function countUp(element) {
    var target = +$(element).find('.count').text();
    var countDuration = 2000;
    var interval = 50;
    var steps = target / (countDuration / interval);
    var currentStep = 0;
    var counter = setInterval(function () {
        currentStep++;
        $(element).find('.count').text(Math.ceil(currentStep * steps));
        if (currentStep >= countDuration / interval) {
            clearInterval(counter);
        }
    }, interval);
}
