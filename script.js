// Validate Function 
function validate() {
    const age = parseInt(document.getElementById('age').value);
    const phone = document.getElementById('phone').value;

    //Validating if users age is between 18 and 65
    if (age < 18 || age > 65) {
        alert("Your Age Must Be Between 18-65 To Apply!");
        return false;
    }else if (!completePayment()) {
        alert("Payment Failed!");
        return false;
    }
    return true;
}

// Mock Payment Function
function completePayment() {
    // Implementing payment logic
    return true;
}
