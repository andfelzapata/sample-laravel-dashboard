<h1 class="form-group-header-h1">Account Info</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-md-4">
        <div class="form-group col-md-8">
            {{ Form::hidden('user_id',$user->id,array('class'=>'user-field profile-field setting-field payment-field')) }}
            {{ Form::label('username','Username') }}
            {{ Form::text('username',$user->username,array('class'=>'form-control user-field')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('email','Email') }}
            {{ Form::text('email',$user->email,array('class'=>'form-control user-field')) }}
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
            {{ Form::button('save',array('class'=>'btn btn-success','id'=>'updateAccount')) }}
        </div>
    </div>
    <!-- end of middle section -->

    <!-- right section -->
    <div id="file-upload" class="col-md-4 dropzone">

     </div>
     <!-- end of right section -->
</div>
