<?php
/**
 * Created by PhpStorm.
 * User: xkristian
 * Date: 18.5.2018
 * Time: 16:15
 */

?>

<!DOCTYPE html >
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>bububu</title>
<!--    //-------------------------------------------------------------------------------------------->
<!--    //              map style                                                                   -->
<!--    //-------------------------------------------------------------------------------------------->

    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            top: 50px;
            height: calc(100% - 50px - 30px);
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

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

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 23px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(17px);
            -ms-transform: translateX(17px);
            transform: translateX(17px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 23px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>

<body>

<label>Origin</label>
<label class="switch">
    <input type="checkbox" name="vyber">
    <span class="slider round"></span>
</label>
<label>School</label>

<div id="map"></div>

<script>
    var count;

$('input[name=vyber]').change(function(){
    $('#map').empty();
    if($(this).is(':checked')) {
        school();
    } else {
        origin();
    }
});

    function school() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(48.669026, 19.69902400000001),
            zoom: 8
        });


        downloadUrl('https://www.webte2tim18.sk/Projekt_ku_skuske/index_map/xml_school.php', function(data) { // https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
                <?php usleep(1000000000000); ?>
                var address = markerElem.getAttribute('address');

                if (address !== ""){

                var geocoder = new google.maps.Geocoder();
                var infoWindow = new google.maps.InfoWindow;

                var infowincontent = document.createElement('div');
                var text = document.createElement('text');
                text.textContent = address;
                infowincontent.appendChild(text);

                geocoder.geocode({'address': address}, function(results, status) {
                    
                    if(status === "INVALID_REQUEST")
                        alert("INVALID_REQUEST");
                    if(status === "REQUEST_DENIED")
                        alert("REQUEST_DENIED");
                    if(status === "OVER_QUERY_LIMIT")
                        console.log("OVER_QUERY_LIMIT");
                    if(status === "ZERO_RESULTS")
                        alert("ZERO_RESULTS");
                    if(status === "UNKNOWN_ERROR")
                        alert("UNKNOWN_ERROR");
                    if(status === "ERROR")
                        alert("ERROR");

                    if (status === 'OK') {
                        send(address,"school");
                        console.log("School Marker : " + address + " - " + count);
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

                }
            });

        });

    }

function origin() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(48.669026, 19.69902400000001),
        zoom: 8
    });


    downloadUrl('https://www.webte2tim18.sk/Projekt_ku_skuske/index_map/xml_origin.php', function(data) { // https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
            <?php usleep(1000000000000); ?>
            var city = markerElem.getAttribute('city');
            var address = markerElem.getAttribute('address');
            var psc = markerElem.getAttribute('PSC');

            if (address !== "" && city !== "" && psc !== 0){

                var geocoder = new google.maps.Geocoder();
                var infoWindow = new google.maps.InfoWindow;
                var add = city + ", " + address + ", " + psc;

                var infowincontent = document.createElement('div');
                var text = document.createElement('text');
                text.textContent = add;
                infowincontent.appendChild(text);

                geocoder.geocode({'address': add}, function(results, status) {
                    if(status === "INVALID_REQUEST")
                        alert("INVALID_REQUEST");
                    if(status === "REQUEST_DENIED")
                        alert("REQUEST_DENIED");
                    if(status === "OVER_QUERY_LIMIT") {

                        console.log("OVER_QUERY_LIMIT");
                    }
                    if(status === "ZERO_RESULTS")
                        alert("ZERO_RESULTS");
                    if(status === "UNKNOWN_ERROR")
                        alert("UNKNOWN_ERROR");
                    if(status === "ERROR")
                        alert("ERROR");
                    if (status === 'OK') {
//                        send(add,city,psc,"origin");
//                        console.log("Origin Mraker : " + add + " - " + count);
//                        map.setCenter(results[0].geometry.location);
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
            }
        });

    });

}


    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
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
//            console.log("Ajax : " + val + " - " + count);
        }
    });
}

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5J2wo0KFU2gxeSPhMAs1VA3MxALbXbKU&callback=school&callback=origin">
</script>
<!--<script async defer-->
<!--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNN-9g64xL_pY6o__PO5H2TUiPqIMpiA0&callback=origin">-->
<!--</script>-->
</body>
</html>