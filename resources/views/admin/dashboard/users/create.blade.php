@include('admin.partials.create_user_account')
@include('admin.partials.create_user_profile')
@include('admin.partials.create_user_settings')
@include('admin.partials.create_user_other_settings')
@include('admin.partials.create_user_payment_options')
@include('admin.partials.create_user_transactions')
<script type="text/javascript">
$.fn.bootstrapSwitch.defaults.size = 'small';
$('input[type="checkbox"]').bootstrapSwitch();
$('input[type="checkbox"]').on('switchChange.bootstrapSwitch',function(event,state) {
    state = state === true ? '1' : '0';
    this.setAttribute('value',state);
});
</script>
