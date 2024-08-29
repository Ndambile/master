window.onscroll = function() {stickyNavbar()};

var navbar = document.querySelector(".navbar");
var sticky = navbar.offsetTop;

function stickyNavbar() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

// Navbar Hover Effect
document.querySelectorAll('.navbar a').forEach(link => {
    link.addEventListener('mouseover', function() {
        this.style.backgroundColor = '#ff9800';  // Change to your preferred hover color
        this.style.color = '#fff';
    });

    link.addEventListener('mouseout', function() {
        this.style.backgroundColor = '';  // Reset to original color
        this.style.color = '';
    });
});

// Form Validation
function validateForm(form) {
    let valid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');

    inputs.forEach(input => {
        if (input.value.trim() === '') {
            valid = false;
            input.style.border = '2px solid red';  // Highlight the field
        } else {
            input.style.border = '';  // Reset border if valid
        }
    });

    return valid;
}

// Attach validation to forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        if (!validateForm(this)) {
            event.preventDefault();  // Prevent form submission if invalid
            alert('Please fill out all required fields.');
        }
    });
});

// Dynamic Content Update for Guider Dashboard
document.getElementById('tour').addEventListener('change', function() {
    const tourId = this.value;
    if (tourId) {
        fetch(`get_students.php?tour_id=${tourId}`)
            .then(response => response.json())
            .then(data => {
                const studentTable = document.getElementById('student-table-body');
                studentTable.innerHTML = '';  // Clear previous data

                if (data.length > 0) {
                    data.forEach(student => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${student.name}</td><td>${student.phone}</td>`;
                        studentTable.appendChild(row);
                    });
                } else {
                    studentTable.innerHTML = '<tr><td colspan="2">No students booked for this tour.</td></tr>';
                }
            });
    }
});

// Dynamic Accommodation Selection
document.getElementById('university').addEventListener('change', function() {
    const universityId = this.value;
    const accommodationSelect = document.getElementById('accommodation');

    if (universityId) {
        fetch(`get_accommodation.php?university_id=${universityId}`)
            .then(response => response.json())
            .then(data => {
                accommodationSelect.innerHTML = '<option value="">Select Accommodation</option>';

                if (data.length > 0) {
                    data.forEach(accommodation => {
                        const option = document.createElement('option');
                        option.value = accommodation.accommodation_id;
                        option.textContent = accommodation.name;
                        accommodationSelect.appendChild(option);
                    });
                } else {
                    accommodationSelect.innerHTML = '<option value="">No accommodations available</option>';
                }
            });
    } else {
        accommodationSelect.innerHTML = '<option value="">Select Accommodation</option>';
    }
});

// Payment Confirmation
document.getElementById('booking-form').addEventListener('submit', function(event) {
    const paymentConfirmed = confirm('Have you made the payment? Press OK to confirm.');
    
    if (!paymentConfirmed) {
        event.preventDefault();  // Prevent form submission if payment is not confirmed
        alert('Please make the payment to proceed with the booking.');
    }
});

// Image Preview for Tour and Accommodation
document.querySelectorAll('.image-input').forEach(input => {
    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(input.dataset.previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
});