//Inizializza la mappa
function initMap(la, lo) {
    //Luogo dell'evento
    const luogo = { lat: la, lng: lo };
    //Mappa centrata nel luogo dell'evento
    const map = new google.maps.Map(document.getElementById("Map"), {
    zoom: 16,
            center: luogo,
    });
    //Inserisce un puntatore
    const marker = new google.maps.Marker({
    position: luogo,
            map: map,
    });
    }