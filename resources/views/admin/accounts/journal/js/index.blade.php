<script>
    //TODO: Copy Redirect Url
    function copyToClipboard(element) {
    var $temp = $("<input>");
    element = "#"+element;
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    }
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_accounts', '#journal', '#service_anchor');

        GetJournalEntries();
        function GetJournalEntries()
        {
            //TODO: Seding Ajax Requrest for creating navbar menu
          $.ajax({
                    url:"{{ route('admin.accounts.journal-entries.index') }}",
                    method:"GET",
                    beforeSend:function()
                    {
                        $('#tbody').html('<tr><td colspan="6" class="text-center"><i class="fa fa-spinner fa-spin text-danger" style="font-size:44px"></i></td></tr>')
                    },
                    success:function(res)
                    {
                        $('#tbody').html(res);    
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
        });
        }
});
</script>
