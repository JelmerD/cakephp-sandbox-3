var geoLocation, timer, isReady = true, user = null, map, markers = [];

$(document).ready(function () {
    global = $.parseJSON(global);
    console.log(global);
    initMap();
    tick();
    timer = setInterval(tick, 1000);
});

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: {lat: 52, lng: 5}
    });
}

function tick() {
    getLocation();
    if (isReady) {
        updateData();
    }
}

function usr(userHash) {
    var u = Cookies.get('Way_' + global.groupHash);
    if (userHash == undefined) {
        return (u == undefined ? null : u);
    }
    if (u == undefined) {
        Cookies.set('Way_' + global.groupHash, userHash);
    }
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(updateLocation);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

function updateLocation(loc) {
    geoLocation = loc;
}

function updateMap(users) {
    while(markers.length) {markers.pop().setMap(null);}
    for(var i = 0; i < users.length; i++) {
        console.log(users[i]);
        markers.push(new google.maps.Marker({
            position: {
                lat: users[i].locations[0].lat,
                lng: users[i].locations[0].lng
            },
            label: String(users[i].id),
            map: map
        }));
    }
}

function addMarker() {

}

function updateData() {
    if (geoLocation == undefined) {
        console.log('geoLocation has not yet been determined');
        return false;
    }
    isReady = false;
    $.ajax({
        type: "POST",
        url: global.baseUrl + 'data/' + global.groupHash,
        data: {
            'timestamp': geoLocation.timestamp,
            'user': usr(),
            'lat': geoLocation.coords.latitude,
            'lng': geoLocation.coords.longitude,
            'accuracy': geoLocation.coords.accuracy
        },
        success: function (data) {
            console.log(data);
            usr(data.user);
            debug('users', data.users.length);
            updateMap(data.users);
            //isReady = true;
        },
        dataType: 'json'
    });
}

function debug(name, val) {
    $('#debug > .' + name + ' > span').html(val);
}