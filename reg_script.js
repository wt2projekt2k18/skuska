function highschoolcheck() {
    var checkbox = document.getElementById("check");
    var optional=document.getElementById("optional");
    var breaker=document.getElementById("break");
    if (checkbox.checked === true) {
        optional.style.display="inline-block";
        breaker.style.display="inline-block";
    }
    else{
        optional.style.display="none";
        breaker.style.display="none";
    }
}

function psccheck(){
    var psc=document.getElementById("psc");
    if(psc.value.length!==5){
        alert("PSČ musí byť 5 ciferné číslo!");
        psc.focus();
        return false;
    }
    return true;
}