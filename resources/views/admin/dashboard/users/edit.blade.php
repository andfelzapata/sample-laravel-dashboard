<h1> Edit {{ $user->username  }} </h1>
<form>
{{ Form::hidden('_token',csrf_token(),array('class'=>'user-field profile-field')) }}
@include('admin.partials.edit_user_account')
@include('admin.partials.edit_user_profile')
@include('admin.partials.edit_user_settings')
@include('admin.partials.edit_user_other_settings')
@include('admin.partials.edit_user_payment_options')
@include('admin.partials.edit_user_transactions')
</form>
