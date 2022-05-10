<script>
    //mapboxgl Access Token
    mapboxgl.accessToken = 'pk.eyJ1IjoiaGFtemE1NTUiLCJhIjoiY2twZjlpZG10MDg0dDJ4bmgyZnUwcnAxNiJ9.hvBfhr_4QDQdlNz5PzIETQ';

    //Intialzing Some Map Box Properties
    let center = [54.2561723713588, 23.8520599823879];
    let place_name = '';
    let longitude = '';
    let latitude = '';

    //Map Box function
        var map = new mapboxgl.Map({
            container:"map",
            style:"mapbox://styles/mapbox/streets-v11",
            center:center,
            zoom:8
        });


    //Search
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl,
        placeholder: 'Search for places in UAE', //Search Input Places Holder
        bbox:[51.4160146192147, 22.6282410017159, 56.4814183948386, 26.094609499407], //Area Boundry for Dubai
        proximity: {
            longitude: 54.2561723713588,
            latitude: 23.8520599823879
        },
        marker:{
            color:"orange",
        },
    });
    //For Plceing GeoCoder Out side the Map box
    map.addControl(geocoder);
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
    //On gecorder Serach Result
    geocoder.on('result', function (e) {
    // map.getSource('single-point').setData(e.result.geometry);
        place_name = e.result.place_name;
        longitude = e.result.geometry.coordinates[0];
        latitude = e.result.geometry.coordinates[1];
        console.log({place_name, longitude, latitude});
    });


    //Add fullScreen button
    map.addControl(new mapboxgl.FullscreenControl());
    //Add zoom and rotate controls to the map
    map.addControl(new mapboxgl.NavigationControl());
    //Add geolocate controls to the map
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions:{
            enableHighAccuracy:true,
        },
        trackUserLocation:true
    }));

</script>
