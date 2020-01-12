<html>
    <title>
        Cloud API Demo
    </title>

    <head>
        <script>
        // Open connection to api.openalpr.com
        var secret_key = "sk_551d2ecd165899240a41f799";
        var url = "https://api.openalpr.com/v2/recognize_bytes?recognize_vehicle=1&country=us&secret_key=" + secret_key;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);

        // Send POST data and display response
        xhr.send("base64_string");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                document.getElementById("response").innerHTML = xhr.responseText;
            } else {
                document.getElementById("response").innerHTML = "Waiting on response...";
            }
        }
        </script>
    </head>

    <body>
        JSON response: <p id="response"></p><br>
    </body>
</html>