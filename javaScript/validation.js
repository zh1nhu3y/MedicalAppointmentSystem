// JS for Form Validation, Confirmation 

// Confirm Booking for Appointment Form Page
function bookingConfirm() {
    var agree = confirm ("Do you want to confirm Booking?");
    if (agree) {
    return true;
    } else {
    return false;
    }
}

// Validate Confirm Password
function validatePassword() {
    var pass = document.getElementById('password').value;
    var confirm_pass = document.getElementById('confPass').value;
    if (pass != confirm_pass) {
        document.getElementById('message1').style.color = 'red';
        document.getElementById('message1').innerHTML
        = '✖ Use same password';
        document.getElementById('message1').disabled = true;
        return false;
    } else {
        document.getElementById('message1').style.color = 'green';
        document.getElementById('message1').innerHTML =
            '✔ Password Matched';
        document.getElementById('message1').disabled = false;
        return true;
    }
}
function pass() {
    document.getElementById("message2").innerHTML =
        'Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters';
    document.getElementById('message2').style.color = '#9C765D';
}

// Wrong Password Alert
function wrongPassAlert() {
    if (document.getElementById('password').value !=
        document.getElementById('confPass').value) {
        alert("Please use the same password!");
    } 
}

// Confirm Changes Validation
function confirmChange() {
    var agree = confirm ("Do you want to save changes?");
    if (agree) {
    return true;
    } else {
    return false;
    }
}

// Confirm Delete
function confirmDelete() {
    var agree = confirm ("Do you want to delete this record?");
    if (agree) {
    return true;
    } else {
    return false;
    }
}
