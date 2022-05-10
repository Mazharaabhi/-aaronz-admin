<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

{{-- AIzaSyAUH0-xyOTyiJiGxpCby07Y3CKGYpQRW7E --}}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiymHR5OEAT8WDV-Zm6Ksm7G1X4ikEabY&libraries=places&callback=initMap" async defer>
    google.maps.event.addDomListener(window, 'load', initMap);
    </script>
<script>
    let mymap;
    let marker;
    let lat;
    let lng;
    let is_from_map = 0;
    let state_id;
    let area_id;
// function initMap() {
//     mymap = new google.maps.Map(document.getElementById("map"), {
//     center: { lat: 25.1124317, lng: 55.13897799999999 },
//     zoom: 12,
//     mapTypeId: 'roadmap',
//     // disableDefaultUI: true,
//     zoomControl: true,
//     panControl: false,
//     mapTypeControl: false,
//     scaleControl: false,
//     streetViewControl: false,
//     overviewMapControl: false,
//     rotateControl: false,
//     fullscreenControl:false
//   });

//   function addMarker(property){
//       // The marker, positioned at Uluru
//          marker = new google.maps.Marker({
//             position: property.location,
//             map: mymap,
//             // draggable:true
//             // icon:"{{ asset('common/location.png') }}"
//         });

//         // if(proerty.content){
//         //     const detailWindow = new google.maps.InfoWindow({
//         //     content: property.content
//         // });

//         // marker.addListener('mouseover', () => {
//         //     detailWindow.open(mymap, marker);
//         // })
//         // }
//   }

//   addMarker({location:{ lat: 25.1124317, lng: 55.13897799999999 }, content:""});

//     // Configure the click listener.
//     mymap.addListener("click", (mapsMouseEvent) => {
//         is_from_map = 1;
//         let coords = mapsMouseEvent.latLng.toJSON();
//         lat = parseFloat(coords.lat);
//         lng = parseFloat(coords.lng);
//         marker.setMap(null);
//         marker = new google.maps.Marker({
//             position: mapsMouseEvent.latLng.toJSON(),
//             map: mymap,
//             draggable:true
//         });
//     });

// }

function initMap(lat,lng) {
    var markers = [
        {
          //  "title": 'Lahore',
            "lat": lat,
            "lng": lng,
        }
    ];


        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var geocoder = geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        updateLatLng(lat,lng)
        // $('#lat').val(lat);
        // $('#lng').val(lng);
       // var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,
                draggable: true,
                animation: google.maps.Animation.DROP
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
                google.maps.event.addListener(marker, "dragend", function (e) {
                    var lat, lng, address;
                    geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            lat = marker.getPosition().lat();
                            lng = marker.getPosition().lng();
                            address = results[0].formatted_address;

                            updateLatLng(lat,lng)

                           // alert("Latitude: " + lat + "\nLongitude: " + lng + "\nAddress: " + address);

                        }
                    });
                });
            })(marker, data);
            latlngbounds.extend(marker.position);
        }
        var bounds = new google.maps.LatLngBounds();
        map.setCenter(latlngbounds.getCenter());
        //map.fitBounds(latlngbounds);
}

//Setting Map Location Con Chaging the Location From Locations Drop Down
function SetMap(object){
    value = object.value;
    is_from_map = 0;
    const valueArray = value.split(',');
    state_id =valueArray[0];
    area_id = valueArray[1];

    if(valueArray[2] != "" && valueArray[3] != "")
    {
        initMap(valueArray[2],valueArray[3])

        lat = parseFloat(valueArray[2]);
        lng = parseFloat(valueArray[3]);

        mymap.setCenter({lat , lng });
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: {lat , lng },
            map: mymap,
            draggable:true
        });

    }else{
        getLocationText(valueArray[0], valueArray[1]);

        //Gettin Data From Async Function
        setTimeout(() => {
            mymap.setCenter({lat , lng });
            marker.setMap(null);
            marker = new google.maps.Marker({
                position: {lat , lng },
                map: mymap,
                draggable:true
            });
        },1000)
    }

}

async function updateLatLng(lat,lng){
    console.log(lat,lng)
    console.log('state_id,area_id')
    console.log(state_id,area_id)
    var level_id = state_id ;

        const _token = "{{ csrf_token() }}";
        const response = await axios.post("{{ route('change-lat-lng') }}", {level_id,area_id,lat,lng, _token});
        var search = response.data;
        console.log(search)
}

// Getting Location text
async function getLocationText(level, id) {
    try {
        const _token = "{{ csrf_token() }}";
        const response = await axios.post("{{ route('get.location-text') }}", {level, id, _token});
        var search = response.data;
        // return console.log(search);

        //Getting Geo Coding

        try{
            var {data} = await axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params:{
                    address: search,
                    key: "AIzaSyBiymHR5OEAT8WDV-Zm6Ksm7G1X4ikEabY"
                }
            });
// AIzaSyDxlb2VjJj5RrQVIRtyuTnMtKsqC3aLy48

            if(data.status === 'OK')
            {
                 lat = data.results[0].geometry.location.lat;
                 lng = data.results[0].geometry.location.lng;

            }
            else{
                $(`#title_english_error`).html('Location Not Found!');
                $(`#short_name`).val('');
            }
        }catch(error){
            console.log(error);
        }

        //End Getting Geo Coding
    } catch (error) {
        console.log(error);
    }
}

</script>
