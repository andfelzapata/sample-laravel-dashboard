<h1 class="form-group-header-h1"> Edit {{ $user->username  }} </h1>
{{ Form::hidden('_token',csrf_token(),array('class'=>'user-field profile-field setting-field payment-field')) }}
@include('admin.partials.edit_user_account')
@include('admin.partials.edit_user_profile')
@include('admin.partials.edit_user_settings')
@include('admin.partials.edit_user_other_settings')
@include('admin.partials.edit_user_payment_options')
@include('admin.partials.edit_user_transactions')
<script type="text/javascript">Stripe.setPublishableKey('pk_test_0Om29XYJhuvlN0JrY7uMnIeK');</script>
<script type="text/javascript">

$.fn.bootstrapSwitch.defaults.size = 'small';

$('input[type="checkbox"]').bootstrapSwitch();
$('input[type="checkbox"]').on('switchChange.bootstrapSwitch',function(event,state) {
    state = state === true ? '1' : '0';
    this.setAttribute('value',state);
});

$('.payment-form').submit(function(e) {
    var $form = $(this);
    
    $form.find('button').prop('disabled',true);
    $form.removeClass('payment-form');
    $form.addClass('payment-form-submitted');

    Stripe.card.createToken($form,function(status, response) {
        if( response.error ) 
        {
            swal('Payment Error',response.error.message,'error');
            $form.find('button').prop('disabled',false);
        }

        else 
        {
            var token = response.id;
            $form.append($('<input type="hidden" class="payment-field" name="token" />').val(token));
            $form.find('input[name="submit"]').click();
        }
        
        $form.removeClass('payment-form-submitted');
        $form.addClass('payment-form');
    });

    return false;
});

</script>
