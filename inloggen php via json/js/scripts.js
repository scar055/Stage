function checkform(a) {
    var pass1 = document.getElementById("p1");
    var pass2 = document.getElementById("p2");
    if(pass1.value === pass2.value){
        return true;
    }
    else {
        alert("het 2e wachtwoord is niet het zelfd");
        return false;
    }
}