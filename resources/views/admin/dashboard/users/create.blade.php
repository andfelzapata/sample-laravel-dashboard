<form>
{{ Form::hidden('_token',csrf_token(),array('class'=>'user-field profile-field')) }}
@include('admin.partials.create_user_account')
@include('admin.partials.create_user_profile')
@include('admin.partials.create_user_settings')
@include('admin.partials.create_user_other_settings')
@include('admin.partials.create_user_payment_options')
@include('admin.partials.create_user_transactions')
</form>
