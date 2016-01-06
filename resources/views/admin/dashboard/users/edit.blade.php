<h1> Edit {{$user->username}} </h1>
{{ Form::open() }}
<div class="row">
    <div class="form-group col-xs-4 p-l-0">
        {{ Form::label('username','Username') }}
        {{ Form::text('username',$user->username,array('class'=>'form-control')) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4 p-l-0">
        {{ Form::label('email','Email') }}
        {{ Form::text('email',$user->email,array('class'=>'form-control')) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4 p-l-0">
        {{ Form::button('Update',array('class'=>'btn btn-success')) }}
    </div>
</div>
{{ Form::close() }} 
