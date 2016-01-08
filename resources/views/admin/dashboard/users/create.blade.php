<h1> Create User </h1>
<form id="form">
{{ Form::open() }}
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::label('username','Username') }}
        {{ Form::text('username',null,array('class'=>'form-control')) }}
        <span class="validation-error"></span>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::label('email','Email') }}
        {{ Form::text('email',null,array('class'=>'form-control')) }}
        <span class="validation-error"></span>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::button('Create',array('class'=>'btn btn-success','id'=>'create')) }}
        <span class="validation-error"></span>
    </div>
</div>
</form>
