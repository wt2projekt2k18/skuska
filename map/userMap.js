function initMap() {
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: 48.669, lng: 19.699}  // Slovakia.
    });

    let directionsService = new google.maps.DirectionsService;
    let directionsDisplay = new google.maps.DirectionsRenderer({
        draggable: true,
        map: map,
        panel: document.getElementById('steps-panel')
    });

    directionsDisplay.addListener('directions_changed', function() {
        computeTotalDistance(directionsDisplay.getDirections());
    });

    let routes = [];

    // new Ajax.Request('map/loadRoutesFromDatabase.php', {
    //
    //     onSuccess : function(xmlHTTP) {
    //
    //         //alert(xmlHTTP.responseText);
    //     }
    // });

    getSession();

    //alert(routes);
    let asd = document.createElement('p');
    asd.innerHTML = routes.toString();
    document.getElementsByTagName("div")[1].appendChild(asd);

    displayRoute('Perth, WA', 'Sydney, NSW', directionsService,
        directionsDisplay);
}

function getSession() {
    return $.ajax({
        type: "GET",
        url: "map/loadRoutesFromDatabase.php",
        async: false,
        success: function (data) {
            // alert(data);
        }
    });

}

function displayRoute(origin, destination, service, display) {
    service.route({
        origin: origin,
        destination: destination,
        waypoints: [{location: 'Adelaide, SA'}, {location: 'Broken Hill, NSW'}],
        travelMode: 'DRIVING',
        avoidTolls: true
    }, function(response, status) {
        if (status === 'OK') {
            display.setDirections(response);
        } else {
            alert('Could not display directions due to: ' + status);
        }
    });
}

function computeTotalDistance(result) {
    let total = 0;
    let myroute = result.routes[0];
    for (let i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    document.getElementById('dlzka-trasy').innerHTML = total + ' km';
}
