function passwordmatch() {
    //alert("vstup do funkcie");
    var prvy = document.getElementById("psw1").value;
    var druhy = document.getElementById("psw2").value;
    var odpoved = document.getElementById("matchreturn");

    if (prvy === druhy) {
        odpoved.innerHTML = "Passwords match";
        if (prvy.length < 8) {
            odpoved.innerHTML = "Password must be at least 8 characters long.";
            return false;
        }
        return true;
    }
    else odpoved.innerHTML = "Passwords do not match";
    return false;
}


