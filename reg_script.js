function highschoolcheck() {
    var checkbox = document.getElementById("check");
    var optional = document.getElementById("optional");
    var breaker = document.getElementById("break");
    if (checkbox.checked === true) {
        optional.style.display = "inline-block";
        breaker.style.display = "inline-block";
    }
    else {
        optional.style.display = "none";
        breaker.style.display = "none";
    }
}

document.getElementById("formular").onsubmit = function () {
    alert("halo");
    var email = emailcheck(document.getElementById("email").value);
    var psc = psccheck();
    var answer = email.responseText !== "Email already exists";
    var pw=pass();
    return answer && psc && pw;
};

function pass() {
    var psw = document.getElementById("password");
    if (psw.value.length < 8) {
        //psc.focus();
        document.getElementById("pswlabel").innerHTML = "Password must be at least 8 characters long.";
        return false;
    }
    else {
        document.getElementById("pswlabel").innerHTML = "";
        return true;
    }
}

function psccheck() {
    var psc = document.getElementById("psc");
    if (psc.value.length !== 5) {
        //psc.focus();
        document.getElementById("psclabel").innerHTML = "PSČ must be a 5 digit number!";
        return false;
    }
    else {
        document.getElementById("psclabel").innerHTML = "";
        return true;
    }
}

function emailcheck(val) {
    return $.ajax({
        type: "POST",
        url: "usercheck.php",
        async: false,
        data: "data=" + val,
        success: function (data) {
            $("#emaillabel").html(data)
        }
    });

}