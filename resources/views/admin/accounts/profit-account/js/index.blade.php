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
        MakeMenuActive('#c_accounts', '#profit_account', '#service_anchor');

        $('#company_id').change(function(){
              if($(this).val() != '')
              {
                GetJournalEntries($(this).val());
              }
              else
              {
                GetJournalEntries('');
              }
        });

        GetJournalEntries('');
        function GetJournalEntries(company_id)
        {
            //TODO: Seding Ajax Requrest for creating navbar menu
          $.ajax({
                    url:"{{ route('admin.accounts.profit-account.index') }}",
                    method:"GET",
                    data:{company_id},
                    beforeSend:function()
                    {
                        $('#tbody').html('<tr><td colspan="7" class="text-center"><i class="fa fa-spinner fa-spin text-danger" style="font-size:44px"></i></td></tr>')
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
