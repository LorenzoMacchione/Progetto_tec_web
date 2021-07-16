//Handler per la mappa
function initMap() {
    let latitude = $("#latitudine").val()
    let longitude = $("#longitudine").val()
    var coordinates;
    if (latitude !== "" && longitude !== ""){
        coordinates = new google.maps.LatLng(latitude , longitude);
    }else{
        coordinates = new google.maps.LatLng(42.70 , 12.90);
    } 
    var marker;

    function placeMarker(location) {
        if (marker){
            marker.setPosition(location);
        }else{
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
        
        $("#latitudine").val(location.lat);
        $("#longitudine").val(location.lng);
    }
    const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: coordinates,
    });
    if (latitude !== "" && longitude !== ""){
        placeMarker(coordinates)
    }
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });
}

//Handler per mostrare l'immagine appena caricata

var loadFile = function (event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};
