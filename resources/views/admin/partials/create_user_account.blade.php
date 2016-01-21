<h1>Account Info</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-md-4">
        <div class="form-group col-md-8">
            {{ Form::label('username','Username') }}
            {{ Form::text('username',null,array('class'=>'form-control user-field')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('email','Email') }}
            {{ Form::text('email',null,array('class'=>'form-control user-field')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('password','Password') }}
            {{ Form::password('password',array('class'=>'form-control user-field')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('password','Retype Password') }}
            {{ Form::password('password_confirmation',array('class'=>'form-control user-field')) }}
            <span class="validation-error"></span>
        </div>
    </div>
    <!-- end of left section -->

    <!-- middle section -->
    <div class="col-md-4">
        <div class="form-group col-md-8">
            {{ Form::label('plants','Plants') }}
            {{ Form::text('plants',null,array('class'=>'form-control','readonly'=>'')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('procedures','Procedures') }}
            {{ Form::text('procedures',null,array('class'=>'form-control','readonly'=>'')) }}
            <span class="validation-error"></span>
        </div>
        <div class="col-md-8">
            {{ Form::button('save',array('class'=>'btn btn-success','id'=>'createAccount')) }}
        </div>
    </div>
    <!-- end of middle section -->

    <!-- right section -->
    <div class="col-md-4">
        {{ Form::label('change_image','Change Image') }}
        {{ Form::file('change_image',array('class'=>'form-control')) }}
     </div>
     <!-- end of right section -->
</div>
