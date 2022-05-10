<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_accounts', '#liabilities', '#cms_anchor');

        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        dom: '<"top"i>rt<"bottom"flp><"clear">',
        ajax: "{{ route('admin.accounts.liabilites.index')  }}",
        columns: [
            { data: 'id' },
            { data: 'time' },
            { data: 'amount' }
            ]
        });

  
});
</script>
