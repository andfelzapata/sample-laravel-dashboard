<div class="row">
    <!-- left section -->
    <div class="col-md-4">
        <div class="form-group col-md-8">
            {{ Form::label('first_name','First Name') }}
            {{ Form::text('first_name',null,array('class'=>'form-control profile-field','maxlength'=> 35,'disabled'=>'')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('last_name','Last Name') }}
            {{ Form::text('last_name',null,array('class'=>'form-control profile-field','maxlength'=> 35,'disabled'=>'')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('street_address','Street Address') }}
            {{ Form::text('street_address',null,array('class'=>'form-control profile-field','maxlength'=> 90,'disabled'=>'')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
                {{ Form::label('apt_suite','APT/Suite') }}
                {{ Form::text('apt_suite',null,array('class'=>'form-control profile-field','maxlength'=> 8,'disabled'=>'')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- end of left section -->

        <!-- middle section -->
        <div class="col-md-4">
            <div class="form-group col-md-8">
                {{ Form::label('city','City') }}
                {{ Form::text('city',null,array('class'=>'form-control profile-field','maxlength'=> 45,'disabled'=>'')) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group col-md-8">
                {{ Form::label('state','State') }}
                {{ Form::text('state',null,array('class'=>'form-control profile-field','disabled'=>'')) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group col-md-8">
                {{ Form::label('zip','Zip') }}
                {{ Form::text('zip',null,array('class'=>'form-control profile-field','maxlength'=> 5,'disabled'=>'')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- end of middle section -->

        <!-- right section -->
        <div class="col-md-4">
        </div>
        <!-- end of right section -->
</div>
