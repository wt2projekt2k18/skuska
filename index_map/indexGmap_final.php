<?php
/**
 * Created by PhpStorm.
 * User: xkristian
 * Date: 18.5.2018
 * Time: 16:15
 */

?>

<!DOCTYPE html >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/plain; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link rel="shortcut icon" type="image/png" href="img/logofavicon.png"/>
    <link rel="shortcut icon" type="image/png" href="https://www.webte2tim18.sk/Projekt_ku_skuske/img/logofavicon.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>
        Fast & FEIous
    </title>

    <!--    //-------------------------------------------------------------------------------------------->
    <!--    //              check-box style                                                                   -->
    <!--    //-------------------------------------------------------------------------------------------->

    <style>
        #myInput {
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

    </style>
</head>

<body id="gradientIndex" onload="start()">

<div class="navbar-fixed">
    <nav class="blue-grey darken-4">
        <div class="nav-wrapper">
            <a href="../home.php" class="brand-logo center"><img id="logoFast" src="../img/run-with-fei-logo-white-720.png" alt="logo"></a>
    
            <ul class="right">
                <li><a class='waves-effect waves-light white-text' href='indexGmap_final.php'><i class='material-icons white-text'>map</i></a></li>
                <li><a class='waves-effect waves-light white-text' href='../news.php?admin=true'><i class='material-icons white-text'>fiber_new</i></a></li>
            </ul>
    
        </div>
    </nav>
</div>

<div id="mapCheckbox" class="col s12 container" align="center">
    <div class="switch">
        <label>
            Origin
            <input type="checkbox" name="vyber">
            <span class="lever"></span>
            School
        </label>
    </div>
    <div id="bu" style="padding-top: 5px"></div>

    <!--<label>Origin</label>
    <label class="switch">
    <input type="checkbox" name="vyber" >
    <span class="slider round"></span>
    </label>
    <label>School</label>
    <div id="bu"></div>-->
</div>


<div id="map" style="height: 720px; margin-bottom: 100px;"></div>


<script>


//    $('#bu').css("color", "green");


    var count = [];

    $('#bu').css("color", "white");
    $('#bu').html("Wait for it");

    function start (){
        $('input[name=vyber]').attr("disabled", true);
        $('#bu').empty();
        $('#bu').css("color", "white");
        $('#bu').html("Wait for it");
        send("","all");
//        alert(count);
        origin();
        setTimeout(function () {
            $('#bu').css("color", "white");
            $('#bu').html("You can change your selection");
            $('input[name=vyber]').removeAttr("disabled");
        },950 * count);
    }

    $('input[name=vyber]').change(function () {
        $('input[name=vyber]').attr("disabled", true);
        $('#bu').css("color", "white");
        $('#map').empty();
        $('#bu').empty();
        $('#bu').html("Wait for it");
        send("","all");
//        alert(count);
        if ($(this).is(':checked')) {
            school();
            setTimeout(function () {
                $('#bu').css("color", "white");
                $('#bu').html("You can change your selection");
                $('input[name=vyber]').removeAttr("disabled");
            },950 * count);

        } else {
            origin();
            setTimeout(function () {
                $('#bu').css("color", "white");
                $('#bu').html("You can change your selection");
                $('input[name=vyber]').removeAttr("disabled");
            },950 * count);

        }
    });

    function school() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(48.669026, 19.69902400000001),
            zoom: 8
        });


        downloadUrl('https://www.webte2tim18.sk/Projekt_ku_skuske/index_map/xml_school.php', function (data) { // https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            var i = 0;

            Array.prototype.forEach.call(markers, function (markerElem) {

//                console.log(i);
                i++;
                var address = markerElem.getAttribute('address');

                if (address !== "") {

                    var geocoder = new google.maps.Geocoder();
                    var infoWindow = new google.maps.InfoWindow;

                    var infowincontent = document.createElement('div');
                    var text = document.createElement('text');
                    text.textContent = address;
                    infowincontent.appendChild(text);

                    setTimeout(function () {

                    geocoder.geocode({'address': address}, function (results, status) {

                        if (status !== "OK") {

                            console.log(status);
                        }

                        if (status === 'OK') {
                            send(address,"school");
                            var marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                                label: count
                            });
                            marker.addListener('click', function () {
                                infoWindow.setContent(infowincontent);
                                infoWindow.open(map, marker);
                            });
                        }
                    });
                    }, 950 * i); //
                }
            });
        });

    }

    function origin() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(48.669026, 19.69902400000001),
            zoom: 8
        });


        downloadUrl('https://www.webte2tim18.sk/Projekt_ku_skuske/index_map/xml_origin.php', function (data) { // https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            var geocoder = new google.maps.Geocoder();
            var infoWindow = new google.maps.InfoWindow;
            var i = 0;

            Array.prototype.forEach.call(markers, function (markerElem) {

//                console.log(i);
                i++;
                var city = markerElem.getAttribute('city');
                var address = markerElem.getAttribute('address');
                var psc = markerElem.getAttribute('PSC');

                if (address !== "" && city !== "" && psc !== 0) {


                    var add = city + ", " + address + ", " + psc;

                    var infowincontent = document.createElement('div');
                    var text = document.createElement('text');
                    text.textContent = add;
                    infowincontent.appendChild(text);

                    setTimeout(function () {

                        geocoder.geocode({'address': add}, function (results, status) {


                            if (status !== "OK") {

                                console.log(status);
                            }

                            if (status === 'OK') {
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: results[0].geometry.location
                                });
                                marker.addListener('click', function () {
                                    infoWindow.setContent(infowincontent);
                                    infoWindow.open(map, marker);
                                });
                            }
                        });
                    }, 950 * i); //
                }
            });
        });

    }


    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}

    function send(val,typ) {
        $.ajax({
            async:false,
            type: "POST",
            url: "counter.php",
            data:{'address':val, 'typ':typ},
            success: function (response) {
//            console.log(response);
                count = response;
//            console.log(count);
            console.log("Ajax : " + val + " - " + count);
            }
        });
    }

</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5J2wo0KFU2gxeSPhMAs1VA3MxALbXbKU"> // async defer &callback=school&callback=origin
</script>


<footer class="page-footer blue-grey darken-4" style="position: fixed"> <!-- style="position: fixed" -->
    <div class="footer-copyright blue-grey darken-3">
        <div class="container">
            &copy; 2018 WEBTE2
            <a class="grey-text text-lighten-4 right" href="../about.html">About</a>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="../styleJS.js"></script>

</body>
</html>