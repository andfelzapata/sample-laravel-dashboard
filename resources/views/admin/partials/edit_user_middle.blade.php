<div class="row">
    <!-- left section -->
    <div class="col-md-4">
        <div class="form-group col-md-8">
            {{ Form::label('first_name','First Name') }}
            {{ Form::text('first_name',$profile->first_name,array('class'=>'form-control profile-field disabled','maxlength'=> 35)) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('last_name','Last Name') }}
            {{ Form::text('last_name',$profile->last_name,array('class'=>'form-control profile-field disabled','maxlength'=> 35)) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('street_address','Street Address') }}
            {{ Form::text('street_address',$profile->street_address,array('class'=>'form-control profile-field disabled','maxlength'=> 90)) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
                {{ Form::label('apt_suite','APT/Suite') }}
                {{ Form::text('apt_suite',$profile->apt_suite,array('class'=>'form-control profile-field disabled','maxlength'=> 8)) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- end of left section -->

        <!-- middle section -->
        <div class="col-md-4">
            <div class="form-group col-md-8">
                {{ Form::label('city','City') }}
                {{ Form::text('city',$profile->city,array('class'=>'form-control profile-field disabled','maxlength'=> 45)) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group col-md-8">
                {{ Form::label('state','State') }}
                {{ Form::select('state',$states,$profile->state,array('class'=>'form-control profile-field disabled')) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group col-md-8">
                {{ Form::label('zip','Zip') }}
                {{ Form::text('zip',$profile->zip,array('class'=>'form-control profile-field disabled','maxlength'=> 5)) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- end of middle section -->

        <!-- right section -->
        <div class="col-md-4">
        </div>
        <!-- end of right section -->
</div>
