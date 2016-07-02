<html>
<head>
    <title>AJAX Test</title>

    <script>
        function showUser(str) {

            loading = document.getElementById('loadingdiv');

            if (str == "")
            {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            else
            {
                if(str.length > 1)
                {
                    if (window.XMLHttpRequest)
                    {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                    {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange = function() {



                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                            loading.style.visibility = "hidden";
                            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        }
                    }
                    loading.style.visibility = "visible";

                    xmlhttp.open("POST","<?= base_url() ?>pds/getdata/"+str,true);
                    xmlhttp.send();
                }

            }
        }
    </script>

</head>

<body>

<form>
<!--    <select name="users" onchange="showUser(this.value)">-->
<!--        <option value="">Select a person:</option>-->
<!--        <option value="Bajan">Bajan</option>-->
<!--        <option value="Canada">Canada</option>-->
<!--        <option value="Quiboloy">Quiboloy</option>-->
<!--        <option value="Quiboloy">Reyes</option>-->
<!--    </select>-->

    <input type="text" onkeyup="showUser(this.value)"/>

    <div id="loadingdiv" style="visibility: hidden;">
        <p>please wait.. </p>
    </div>


</form>
<br>
<div id="txtHint"><b>Person info will be listed here.</b></div>

</body>

</body>
</html>