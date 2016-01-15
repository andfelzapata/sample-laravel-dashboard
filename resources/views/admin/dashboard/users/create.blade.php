<h1> Create User </h1>
<form>
{{ Form::hidden('_token',csrf_token(),array('class'=>'user-field profile-field')) }}
@include('admin.partials.create_user_top')
<div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('save',array('class'=>'btn btn-success','id'=>'createAccount')) }}</div></div>
@include('admin.partials.create_user_middle')
<div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('save',array('class'=>'btn btn-success','id'=>'createProfile')) }}</div></div>
</form>
