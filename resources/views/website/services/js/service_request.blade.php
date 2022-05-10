<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        @include('messages.jquery-messages')
        $('#send-lead-request').on('click',function(){
            var questions = $("input[name='questions[]']").map(function(){return $(this).val();}).get();
            var question_names = $("input[name='question_names[]']").map(function(){return $(this).val();}).get();
            var question_answers = [];
            for(var i =0 ; i < questions.length ; i++){
              var answer = $(`#answer_${questions[i]}`).val()
              question_answers.push(answer);
             }
             var name=$('#name').val();
             var email=$('#email').val();
             var phone=$('#phone-number').val();
             var details=$('#deatils').val();
             var company_id=$('#company_id').val();
             var service_id=$('#service_id').val();
             var location=$('#l').val();
             var formData = new FormData();
                formData.append('name',name);
                formData.append('phone',phone);
                formData.append('email',email);
                formData.append('details',details);
                formData.append('company_id',company_id);
                formData.append('service_id',service_id);
                formData.append('location',location);
                for(var count = 0; count<questions.length; count++){ formData.append("questions[]",questions[count]); }
                for(var count = 0; count<question_names.length; count++){ formData.append("question_names[]",question_names[count]); }
                for(var count = 0; count<question_answers.length; count++){ formData.append("answers[]",question_answers[count]); }
                formData.append('_token',_token);
                 $.ajax({
                     url:"{{ route('service.service-request-lead') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#send-lead-request').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#send-lead-request').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#send-lead-request').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#send-lead-request').html(`${save_icon} @lang('translation.save')`);
                        $('#send-lead-request').attr('class',`${btn_cherwell } btn-block`);
                        $('#send-lead-request').removeAttr('disabled');
                    },
                     success:function(res){
                       $('#mysuccModal').modal();
                        window.location.href="{{URL::to('/') }}"
                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });
        });
    });
</script>
