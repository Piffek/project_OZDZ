function show(str) {
    if (str.length == 0) {
        document.getElementById("art").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("art").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/product/search/"+str, true);
        xmlhttp.send();
        console.log(str.length);
    }
}