function initMap() {
    var location = { lat: 40.712776, lng: -74.005974 };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: location
    });

    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}
