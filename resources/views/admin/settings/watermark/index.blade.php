@extends('layouts.master')
@section('title', 'Watermark')
@section('first', 'Watermark')
@section('second', 'Settings')
@section('third', 'Watermarks')

@section('content')
<style>
    div#filecvr {
  position: relative;
  overflow: hidden;
}
input#filebtn {
  position: absolute;
  font-size: 50px;
  opacity: 0;
  right: 0;
  top: 0;
}
.logoimg{
position: absolute;
z-index: 10;
}
/* top-left (default)
top
top-right
left
center
right
bottom-left
bottom
bottom-right */
.left-top{
    left: 15;
    top:10;
    }
.left-center{
    left: 15;
    top:25%;
    }
.left-bottom{
    left: 15;
    bottom:75;
    }
.top-center{
    left: 25%;
    top:10;
    }
.center{
    left: 25%;
    top:25%;
    }
.center-bottom{
    left: 25%;
    bottom:75;
    }
.top-right{
    right: 15;
    top:10;
    }
.center-right{
    right: 15;
    top:25%;
    }
.bottom-right{
    right: 15;
    bottom:75;
    }

</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
<div class="row">
    <div class="col-8">
                    <div class="row">
                        <div class="col-4"><h4> Watermark Position</h4></div>
                        <div class="col-8">
                            <div class="row positioning">
                                <div class="col-4">
                            <div class="form-check my-3">
                                <input class="form-check-input" type="radio" name="position" value="left-top" {{ ($logoimg->position =='left-top') ? 'checked' : ''; }} id="Position1">
                                <label class="form-check-label" for="Position1">
                                  Left Top
                                </label>
                              </div>
                              <div class="form-check my-3">
                                <input class="form-check-input" type="radio" name="position" value="left-center" {{ ($logoimg->position =='left-center') ? 'checked' : ''; }} id="Position2" >
                                <label class="form-check-label" for="Position2">
                                  Left Center
                                </label>
                              </div>
                              <div class="form-check my-3">
                                <input class="form-check-input" type="radio" name="position" value="left-bottom" {{ ($logoimg->position =='left-bottom') ? 'checked' : ''; }} id="Position3" >
                                <label class="form-check-label" for="Position3">
                                  Left Bottom
                                </label>
                              </div>
                             </div>
                             <div class="col-4">
                                <div class="form-check my-3">
                                    <input class="form-check-input" type="radio" name="position" value="top-center" {{ ($logoimg->position =='top-center') ? 'checked' : ''; }} id="Position4">
                                    <label class="form-check-label" for="Position4">
                                      Mid Top
                                    </label>
                                  </div>
                                  <div class="form-check my-3">
                                    <input class="form-check-input" type="radio" name="position" value="center" {{ ($logoimg->position =='center') ? 'checked' : ''; }} id="Position5" >
                                    <label class="form-check-label" for="Position5">
                                        Mid Center
                                    </label>
                                  </div>
                                  <div class="form-check my-3">
                                    <input class="form-check-input" type="radio" name="position" value="center-bottom"  {{ ($logoimg->position =='center-bottom') ? 'checked' : ''; }} id="Position6" >
                                    <label class="form-check-label" for="Position6">
                                        Mid Bottom
                                    </label>
                                  </div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-check my-3">
                                        <input class="form-check-input" type="radio" name="position" value="top-right" {{ ($logoimg->position =='top-right') ? 'checked' : ''; }} id="Position7">
                                        <label class="form-check-label" for="Position7">
                                          Right Top
                                        </label>
                                      </div>
                                      <div class="form-check my-3">
                                        <input class="form-check-input" type="radio" name="position" value="center-right" {{ ($logoimg->position =='center-right') ? 'checked' : ''; }} id="Position8" >
                                        <label class="form-check-label" for="Position8">
                                            Right Center
                                        </label>
                                      </div>
                                      <div class="form-check my-3">
                                        <input class="form-check-input" type="radio" name="position" value="bottom-right" {{ ($logoimg->position =='bottom-right') ? 'checked' : ''; }} id="Position9" >
                                        <label class="form-check-label" for="Position9">
                                            Right Bottom
                                        </label>
                                      </div>
                                     </div>
                            </div>
                        </div>

                      </div>
                      {{-- <div class="row">
                        <div class="col-4"><h4> Image Transparency </h4> </div>
                        <div class="col-8" >

                            <div id="contrastSlider" class="my-5">
                            <input id="contrast" type="range" value="contrast" max="0.9" min="0" step="0.01"/>
                            <span class="badge rounded-pill bg-success">Success</span>

                            </div>

                        </div>
                      </div> --}}

                      <div class="row">
                        <div class="col-4"><h4> Watermark Image </h4> </div>
                        <div class="col-8" >

                        <div style="background:#ccc">
                             <img src="{{$logoimg->file_name}}" style="opacity: {{$logoimg->opacity}}" id="watermarklogo" />
                        </div>
                        <div class="my-3">
                            <form enctype="multipart/form-data" method="post">
                            <div class="file btn btn-lg btn-outline-success" id="filecvr">
                                Change Image
                                <input type="file" name="file" id="filebtn"/>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-4" style="position: relative" >
                        <img src="/images/preview.jpg" id="preview" />
                        <img src="{{$logoimg->file_name}}" style="opacity: {{$logoimg->opacity}}% " id="wmlogo" class="logoimg {{$logoimg->position}} " width="200px" />
                        <div id="contrastSlider" class="my-5">
                        <div><label for="contrast" class="form-label">Set Watermark Transparency</label></div>
                        <div>
                            <input type="range" value="{{ $logoimg->opacity }}" max="100" min="0" step="1" class="form-range" id="contrast">
                             <button type="button"  id="saveOpacity" class="btn btn-sm btn-outline-primary  pull-right">Save Transparency</button>
                        </div>
                            {{-- <input id="contrast" type="range" value="contrast" max="0.9" min="0" step="0.01"/>
                            <span class="badge rounded-pill bg-success">Success</span> --}}
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                          <h4>Watermark Size</h4>
                        </div>
                        <div class="col-md-8">
                            <span>Width <span id="rangeValue">{{ $logoimg->width }}</span> (%)</span>
                            <div class="slider">
                              <input type="range" min="1" max="100" value="{{ $logoimg->width }}" class="form-control" id="width"  oninput="rangeValue.innerText = this.value">

                            </div>
                        </div>
                    </div>
                </div>
                      <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
{{-- @include('admin.settings.document-types.js.index'); --}}
<script  type="text/javascript">

   $(document).ready(function () {


    var range = '';
    $('#contrast').on('input', function() {
        range = $(this).val();
    $('#watermarklogo, #wmlogo').css('opacity', range+'%');
  });

      $('#saveOpacity').on('click', function() {
      var formData = new FormData();
       formData.append('opacity',range);
       formData.append('_token',"{{ csrf_token() }}");
       $.confirm({
                    title: 'Confirm!',
                    content: 'Do You Realy Want to chane Opacity  ?.',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                        type:'POST',
                                        url:"{{ route('admin.settings.watermark.opacity') }}" ,
                                        data:formData,
                                        cache:false,
                                        contentType: false,
                                        processData: false,
                                        success:function(res){
                                         // return  console.log(res)
                                           // window.location.reload();
                                            $.alert('Opacity updated Successfully');
                                        },
                                        error:function(xhr){
                                            console.log(xhr.responseText);
                                        }
                                    });
                                 }
                             }
                         }
                     });
               });



    $(".positioning input[type='radio']").on("change",function() {
        var selected = $(this).val();
        if(selected){
            $('#wmlogo').attr('class', 'logoimg '+selected);
        }
        var formData = new FormData();
       formData.append('position',selected);
       formData.append('_token',"{{ csrf_token() }}");
            $.ajax({
            type:'POST',
            url:"{{ route('admin.settings.watermark.position') }}" ,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(res){
                console.log(res)
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
        });

    $("#filebtn").on("change", function() {
        //e.preventDefault();
       var formData = new FormData();
       var image = document.getElementById('filebtn').files[0];
       var width = $('#width').val();
       formData.append('file',image);
       formData.append('width',width);
       formData.append('_token',"{{ csrf_token() }}");
       $.confirm({
                    title: 'Confirm!',
                    content: 'Do You Realy Want to change Water Mark  ?.',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                        type:'POST',
                                        url:"{{ route('admin.settings.watermark.imageFileUpload') }}" ,
                                        data:formData,
                                        cache:false,
                                        contentType: false,
                                        processData: false,
                                        success:function(res){
                                           $('#watermarklogo').attr("src", "/storage/"+res);
                                           // console.log(res)
                                           // window.location.reload();
                                            $.alert('Water Mark Updated Successfully');
                                        },
                                        error:function(xhr){
                                            console.log(xhr.responseText);
                                        }
                                    });
                                 }
                             }
                         }
                     });
                });
    $('#width').change(function(){
        let width = $('#width').val();
        $('#wmlogo').attr('width',width+'%');
    });
    $('#width').change(function(){
        const logo_width = $(this).val();
        var formData = new FormData();
       formData.append('logo_width',logo_width);
       formData.append('_token',"{{ csrf_token() }}");
            $.ajax({
            type:'POST',
            url:"{{ route('admin.settings.watermark.logo-width') }}" ,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(res){
                console.log(res)
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    });

});
</script>
@endsection
