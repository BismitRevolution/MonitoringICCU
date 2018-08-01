// $(document).ready(function () {
    console.log('data loaded');

    function retrive() {
        console.log('retrieved');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("demo").innerHTML = this.responseText;
                var arrayResponse = JSON.parse(this.responseText);
                var a;
                for (a = 0; a < arrayResponse.length; a++) {
                    console.log(arrayResponse[a].value);
                }
                // console.log('Data: ' + this.responseText);
            }
        };
        xhttp.open("GET", "/retrieve", true);
        xhttp.send();
    }

// });
