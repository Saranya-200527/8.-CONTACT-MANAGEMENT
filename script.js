document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("contactForm");

    if (form) {

        form.addEventListener("submit", function (event) {

            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();

            // Name validation
            if (name.length < 3) {
                alert("Name must contain at least 3 characters.");
                event.preventDefault();
                return;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                event.preventDefault();
                return;
            }

            // Phone validation
            const phonePattern = /^[0-9]{10}$/;

            if (!phonePattern.test(phone)) {
                alert("Phone number must contain exactly 10 digits.");
                event.preventDefault();
                return;
            }

            alert("Contact details are valid!");

        });

    }

});