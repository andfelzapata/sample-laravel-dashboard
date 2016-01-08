<h1> Edit {{$user->username}} </h1>
<form id="form">
{{ Form::open() }}
{{ Form::hidden('id',$user->id) }}
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::label('username','Username') }}
        {{ Form::text('username',$user->username,array('class'=>'form-control')) }}
        <span class="validation-error"></span>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::label('email','Email') }}
        {{ Form::text('email',$user->email,array('class'=>'form-control')) }}
        <span class="validation-error"></span>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::button('Update',array('class'=>'btn btn-success','id'=>'update')) }}
        <span class="validation-error"></span>
    </div>
</div>
</form>
