@extends('layouts.master')
@section('title', 'Buildings')
@section('first', 'Buildings')
@section('second', 'Locations')
@section('third', 'Buildings')
@section('fourth', 'Create')

@section('content')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style>

    #map {
      height: 250px;
    }
    </style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <div>
                            @include('languages')
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('locations.buildings.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Building:</legend>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country" class="d-block">Countries</label>
                                <select name="country" id="country" class="form-control fa-select select2">
                                <option value="">---select Country---</option>
                                    @if (count($location_countries) > 0)
                                        @foreach ($location_countries as $item)
                                            <option value="{{ $item->id }}" {{ $item->is_default == 1 ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="country_id_error" class="text-danger d-block"></span>
                                </div><!-- /grid column -->
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="d-block">Cities</label>
                                    <select name="state" id="state" class="form-control fa-select select2">
                                    <option value="">---select city---</option>
                                    </select>
                                    <span id="state_error" class="text-danger d-block"></span>
                                    </div><!-- /grid column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="area_id" class="d-block">Areas</label>
                                        <select name="area_id" id="area_id" class="form-control fa-select select2">
                                        <option value="">---select area---</option>
                                        </select>
                                        <span id="area_id_error" class="text-danger d-block"></span>
                                        </div><!-- /grid column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="area_id" class="d-block">Location</label>
                                        <select name="location_id" id="location_id" class="form-control fa-select select2">
                                        <option value="">---select location---</option>
                                        </select>
                                        <span id="location_id_error" class="text-danger d-block"></span>
                                        </div><!-- /grid column -->
                                <!-- grid column -->
                           @if(count($languages) > 0)
                                @foreach ($languages as $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Name {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <span id="title_english_error" class="text-danger"></span>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                            @endif
                            <div class="col-md-6 col-mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" placeholder="Slug" class="form-control">
                                <span class="text-danger" id="slug_error"></span>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div id="map"></div>
                            </div>
                            <div class="col-md-12 col-lg-12 mb-4 ">
                                <label class="mr-2">Image</label>
                                <div class="group-contain" style="
                                   display: flex;
                                   ">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="#" alt="Preview Image" id="blah-one" class="d-none">
                                      </div>
                                   </div>
                                </div>
                           </div>

                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_language">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                @lang('translation.save')
                        </button>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('locations.buildings.js.create');
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiymHR5OEAT8WDV-Zm6Ksm7G1X4ikEabY&callback=initMap&v=weekly&channel=2"async></script>
<script>
var latitude = "{{ isset($storedData[0]->latitude) ? $storedData[0]->latitude : ''  }}";
var longitude = "{{ isset($storedData[0]->longitude) ? $storedData[0]->longitude : ''  }}";
function initMap(lat=latitude,lng=longitude) {
    var markers = [
        {
          //  "title": 'Lahore',
            "lat": lat, //"{{ isset($storedData[0]->latitude) ? $storedData[0]->latitude : ''  }}",
            "lng": lng, //"{{ isset($storedData[0]->longitude) ? $storedData[0]->longitude : ''  }}",
        }
    ];

// // Create the initial InfoWindow.
// let infoWindow = new google.maps.InfoWindow({
// content: "Click the map to get Lat/Lng!",
// position: myLatlng,
// });

// infoWindow.open(map);
// // Configure the click listener.
// map.addListener("click", (mapsMouseEvent) => {
// // Close the current InfoWindow.
// infoWindow.close();
// // Create a new InfoWindow.
// infoWindow = new google.maps.InfoWindow({
//   position: mapsMouseEvent.latLng,
// });
// infoWindow.setContent(
//   JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
// );
// infoWindow.open(map);
// });
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var geocoder = geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
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
                            alert("Latitude: " + lat + "\nLongitude: " + lng + "\nAddress: " + address);
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
</script>
@endsection
