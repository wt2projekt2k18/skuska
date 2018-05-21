var map;
var directionsService;
var directionsDisplay;
var startPlaceSet = false;
var startPlaceLocation;
var endPlaceSet = false;
var endPlaceLocation;
var params = {};
var delayFactor = 100;

function initMap(get) {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: { lat: 48.669, lng: 19.699 }  // Slovakia.
    });

    initSearchInput();

    directionsService = new google.maps.DirectionsService;

    if (directionsDisplay != null) {
        directionsDisplay.setMap(null);
        directionsDisplay = null;
    }

    params = get;

    getRoutes();

    //
    // directionsDisplay.addListener('directions_changed', function() {
    //     computeTotalDistance(directionsDisplay.getDirections());
    // });

    //
    // let asd = document.createElement('p');
    // asd.innerHTML = routes.toString();
    // document.getElementsByTagName("div")[1].appendChild(asd);
    //
}

function initSearchInput() {

    var inputStart = document.getElementById('startSearch');
    var inputEnd = document.getElementById('endSearch');
    var searchBox = new google.maps.places.SearchBox(inputStart);
    var searchBoxEnd = new google.maps.places.SearchBox(inputEnd);

    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    map.addListener('bounds_changed', function() {
        searchBoxEnd.setBounds(map.getBounds());
    });

    var markers = [];

    searchBox.addListener('places_changed', function() {

        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });

        markers = [];

        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {

            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            markers.push(new google.maps.Marker({
                map: map,
                // icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            startPlaceLocation = place.geometry.location;
        });

        map.fitBounds(bounds);

        startPlaceSet = true;
    });

    var markers2 = [];

    searchBoxEnd.addListener('places_changed', function() {

        var places2 = searchBoxEnd.getPlaces();

        if (places2.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers2.forEach(function(marker) {
            marker.setMap(null);
        });

        markers2 = [];

        var bounds = new google.maps.LatLngBounds();

        places2.forEach(function(place) {

            if (!place.geometry) {
                endPlaceSet = false;
                return;
            }

            markers2.push(new google.maps.Marker({
                map: map,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            endPlaceLocation = place.geometry.location;
        });

        map.fitBounds(bounds);

        endPlaceSet = true;

        if (startPlaceSet && endPlaceSet) {
          directionsDisplay = new google.maps.DirectionsRenderer({
            map: map,
            panel: document.getElementById('steps-panel'),
            polylineOptions: {
              strokeColor: "yellow"
            }
          });

          var request = {
            origin: startPlaceLocation,
            destination: endPlaceLocation,
            travelMode: 'WALKING'
          };

          displayRoute(request, directionsService, directionsDisplay);
        }
    });
}

function getRoutes() {
    $.ajax({
        type: "GET",
        url: "/Projekt_ku_skuske/map/loadRoutesFromDatabase.php",
        async: false,
        data: params,
        success: function (data) {
            console.log(data);
            var routes = JSON.parse(data);

            for (var i = 0 ; i < routes.length ; i ++) {

                var start =  new google.maps.LatLng(routes[i]['start_lat'], routes[i]['start_long']);
                var end =  new google.maps.LatLng(routes[i]['end_lat'], routes[i]['end_long']);

                var request = {
                    origin: start,
                    destination: end,
                    travelMode: 'WALKING'
                };

                var routeColor = "blue";

                // Javascript problem ked mas if (routes[i]['is_active']) tak zobere aj false ako true lebo je tam string.
                if (routes[i]['is_active'] == true) {
                    routeColor = "green";
                }

                directionsDisplay = new google.maps.DirectionsRenderer({
                    map: map,
                    panel: document.getElementById('steps-panel'),
                    polylineOptions: {
                        strokeColor: routeColor
                    }
                });

                // directionsDisplay.addListener('directions_changed', function() {
                //   computeTotalDistance(directionsDisplay.getDirections());
                // });

                displayRoute(request, directionsService, directionsDisplay);
            }
        }
    });
}

function displayRoute(request, service, display) {
    console.log("DISPLAY");
    service.route(request, function(response, status) {

        if (status === 'OK') {
            console.log(delayFactor);
            display.setDirections(response);

        } else if (status === google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
            delayFactor++;
            setTimeout(function () {
                displayRoute(request, service, display);
            }, delayFactor);
        } else {
            alert('Could not display directions due to: ' + status);
        }
    });
}

// function computeTotalDistance(result) {
//     let total = 0;
//     let myroute = result.routes[0];
//     for (let i = 0; i < myroute.legs.length; i++) {
//         total += myroute.legs[i].distance.value;
//     }
//     total = total / 1000;
//     document.getElementById('dlzka-trasy').innerHTML = total + ' km';
// }
