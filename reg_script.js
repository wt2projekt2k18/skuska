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
    var email = emailcheck(document.getElementById("email").value);
    var psc = psccheck();
    var answer = email.responseText !== "Email už existuje";
    return answer && psc;
};

function psccheck() {
    var psc = document.getElementById("psc");
    if (psc.value.length !== 5) {
        //psc.focus();
        document.getElementById("psclabel").innerHTML = "PSČ musí byť 5 ciferné číslo!";
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