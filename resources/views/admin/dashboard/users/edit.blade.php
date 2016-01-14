<h1> Create User </h1>
@include('admin.partials.edit_user_top')
    <div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('save',array('class'=>'btn btn-success','id'=>'editAccount')) }}</div></div>
@include('admin.partials.edit_user_middle')
    <div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('save',array('class'=>'btn btn-success','id'=>'editProfile')) }}</div></div>
