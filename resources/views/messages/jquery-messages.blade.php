{{-- //TODO: Initialzing the global token variable --}}
const _token = "{{ csrf_token() }}";

{{-- TODO:: Buttons Classes --}}
const btn_danger = "btn btn-danger font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3";
const btn_cherwell = "btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3";
const btn_success = "btn btn-success mr-2";
const spinner = "spinner spinner-right spinner-white pr-15";
const btn_primary = "btn btn-primary font-weight-bold";
const save_icon = '<span class="svg-icon svg-icon-md fa fa-floppy-o"></span>';

{{-- TODO: For auto focosuing --}}
$('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  });

  //TODO: Reloading the table data
  $('#reload').click(function()
  {
      DataTable.ajax.reload();
      ToastSuccess("@lang('translation.records_reloaded_successfully')");
  });

{{-- //TODO: Showing Jquery Confirm Dialouge Box --}}
function ToastSuccess(message)
{
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "2000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    toastr["success"](message);
}
{{-- //TODO: Showing Jquery Confirm Dialouge Box --}}
function ToastError(type, message)
{
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "2000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    toastr[type](message);
}
{{-- //TODO: Showing Jquery Confirm Dialouge Box --}}
function Message(type, message, color)
{
    $.confirm({
                        title: type,
                        content: message,
                        boxWidth: '20%',
                        type: color,
                        typeAnimated: true,
                        buttons: {
                            close: {
                                text: 'ok',
                                btnClass: `btn-${color}`,
                                action: function(){
                                }
                            }
                        }
                        });
}

{{-- //TODO --}}
function Redirect(param, route)
{
    // TODO: Loading the interval here for two section to direct user to login page after reset the password
                            {{-- var i = 0;

                            var interval = setInterval(function(){
                                i++;
                                if(i == 1){ --}}
                                    if(param == 1){
                                    window.location = route;
                                   }else{
                                    window.location.reload();
                                    }
                                {{--  }
                            }, 1000); --}}
}

{{-- TODO: For Making Menu and Menu Items Active --}}
function MakeMenuActive(parent, child, anchor)
{

    if(child == "")
    {
        $(`${parent}`).attr('class', 'menu-item menu-item-active');
    }else
    {
        if(!anchor)
        {
        $(`${parent}`).attr('class', 'menu-item menu-item-submenu menu-item-open');
        }else{
        $(`${parent}`).attr('class', 'menu-item menu-item-submenu menu-item-active menu-item-open');
        $(`${parent} .menu-submenu`).attr('style', '');
        }
        $(`${child}`).attr('class', 'menu-item menu-item-active');
        $(`${anchor}`).attr('class', 'menu-link menu-toggle');
    }

}

function GrandMenuActive(parent)
{
    $(`${parent}`).attr('class', 'menu-item menu-item-submenu menu-item-open');
    $(`${parent} .menu-submenu`).attr('style', '');
}
