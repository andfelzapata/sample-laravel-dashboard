<h1> Edit {{ $user->username  }} </h1>
<form>
{{ Form::hidden('_token',csrf_token(),array('class'=>'user-field profile-field')) }}
@include('admin.partials.edit_user_top')
<div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('save',array('class'=>'btn btn-success','id'=>'editAccount')) }}</div></div>
@include('admin.partials.edit_user_middle')
<div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('save',array('class'=>'btn btn-success','id'=>'editProfile')) }}</div></div>
</form>
