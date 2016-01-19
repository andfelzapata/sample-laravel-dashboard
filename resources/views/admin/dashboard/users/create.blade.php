<form>
{{ Form::hidden('_token',csrf_token(),array('class'=>'user-field profile-field')) }}
@include('admin.partials.create_user_account')
@include('admin.partials.create_user_profile')
@include('admin.partials.create_user_settings')
@include('admin.partials.create_user_other_settings')
@include('admin.partials.create_user_payment_options')
@include('admin.partials.create_user_transactions')
</form>
<script type="text/javascript">
$("[name='receive_emails']").bootstrapSwitch({
    'size': 'small',
});
$("[name='receive_text_alerts']").bootstrapSwitch({
    'size': 'small',
});
$("[name='google_ical_alerts']").bootstrapSwitch({
    'size': 'small',
});
$("[name='receive_push_alerts']").bootstrapSwitch({
    'size': 'small',
});
$("[name='show_latin_names_plants']").bootstrapSwitch({
    'size': 'small',
});
$("[name='show_latin_names_culinary_plants']").bootstrapSwitch({
    'size': 'small',
});
$("[name='show_latin_names_pests']").bootstrapSwitch({
    'size': 'small',
});
</script>
