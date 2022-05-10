<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiymHR5OEAT8WDV-Zm6Ksm7G1X4ikEabY&libraries=places&callback=initMap" async defer>
    google.maps.event.addDomListener(window, 'load', initMap);
    </script>
<script>
    let mymap;
    let marker;
    let lat = parseFloat("{{ $propertyData[0]->lat  }}");
    let lng = parseFloat("{{ $propertyData[0]->lng  }}");
    let title = "{{ $propertyData[0]->title  }}";
    let is_from_map = "{{ $propertyData[0]->is_from_map  }}";
function initMap() {
    mymap = new google.maps.Map(document.getElementById("map"), {
    center: { lat, lng},
    zoom: 12,
    mapTypeId: 'roadmap',
    // disableDefaultUI: true,
    zoomControl: true,
    panControl: false,
    mapTypeControl: false,
    scaleControl: false,
    streetViewControl: false,
    overviewMapControl: false,
    rotateControl: false,
    fullscreenControl:false
  });

  function addMarker(property){
      // The marker, positioned at Uluru
         marker = new google.maps.Marker({
            position: property.location,
            map: mymap,
            // draggable:true
            // icon:"{{ asset('common/location.png') }}"
        });

        // if(proerty.content){
        //     const detailWindow = new google.maps.InfoWindow({
        //     content: property.content
        // });

        // marker.addListener('mouseover', () => {
        //     detailWindow.open(mymap, marker);
        // })
        // }
  }

  addMarker({location:{ lat, lng }, content:`<p>${title}</p>`});

    // Configure the click listener.
    mymap.addListener("click", (mapsMouseEvent) => {
        is_from_map = 1;
        let coords = mapsMouseEvent.latLng.toJSON();
        lat = parseFloat(coords.lat);
        lng = parseFloat(coords.lng);
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: mapsMouseEvent.latLng.toJSON(),
            map: mymap,
            draggable:true
        });
    });

}

//Setting Map Location Con Chaging the Location From Locations Drop Down
function SetMap(object){
    value = object.value;
    is_from_map = 0;
    console.log(value);
    const valueArray = value.split(',');
    console.log(valueArray)
    if(valueArray[2] != "" && valueArray[3] != "")
    {
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

// Getting Location text
async function getLocationText(level, id) {
    try {
        const _token = "{{ csrf_token() }}";
        const response = await axios.post("{{ route('get.location-text') }}", {level, id, _token});
        var search = response.data;
        console.log(search);

        //Getting Geo Coding

        try{
            var {data} = await axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params:{
                    address: search,
                    key: "AIzaSyBiymHR5OEAT8WDV-Zm6Ksm7G1X4ikEabY"
                }
            });


            if(data.status === 'OK')
            {

                 lat = data.results[0].geometry.location.lat;
                 lng = data.results[0].geometry.location.lng;
                 alert(`lat ${lat}, lng ${lng}`)
            }
            else{
                alert(`lat ${lat}, lng ${lng}`)

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
