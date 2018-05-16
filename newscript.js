function passwordmatch() {
    //alert("vstup do funkcie");
    var prvy = document.getElementById("psw1").value;
    var druhy = document.getElementById("psw2").value;
    var odpoved = document.getElementById("matchreturn");

    if (prvy === druhy) {
        odpoved.innerHTML = "Heslá sa zhodujú";
        if (prvy.length < 8) {
            odpoved.innerHTML = "Heslo musí mať najmenej 8 znakov";
            return false;
        }
        return true;
    }
    else odpoved.innerHTML = "Heslá sa nezhodujú";
    return false;
}


