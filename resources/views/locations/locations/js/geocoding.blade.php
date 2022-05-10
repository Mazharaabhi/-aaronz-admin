var latitude = "{{ isset($storedData[0]->latitude) ? $storedData[0]->latitude : ''  }}";
var longitude = "{{ isset($storedData[0]->longitude) ? $storedData[0]->longitude : ''  }}";
$(`#title_english_${input_id}`).focusout(async function(){
try{
   if($(this).val() != ""){
    const address = $(this).val() + ', ' + $('select[id="area_id"] :selected').text() +  ', ' + $('select[id="state"] :selected').text() + ', ' + $('select[id="country"] :selected').text();
    {{--  console.log(address);  --}}
    var {data} = await axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
        params:{
            address: address,
            key: "AIzaSyBiymHR5OEAT8WDV-Zm6Ksm7G1X4ikEabY"
        }
    });

    if(data.status === 'OK')
    {
        const short_name = data.results[0].address_components[0].short_name;
        $(`#short_name`).val(short_name);
        latitude = data.results[0].geometry.location.lat;
        longitude = data.results[0].geometry.location.lng;
    }
    else{
        $(`#title_english_error`).html('Location Not Found!');
        $(`#short_name`).val('');
    }
   }
}catch(error){
    console.log(error);
}
});
