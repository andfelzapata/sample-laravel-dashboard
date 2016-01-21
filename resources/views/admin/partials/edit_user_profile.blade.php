<h1>Billing Address</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-md-4">
        <div class="form-group col-md-8">
            @if( isset($profile->id) )
                {{ Form::hidden('id',$profile->id,array('class'=>'profile-field')) }}
            @endif
            {{ Form::label('first_name','First Name') }}
            @if( isset($profile->first_name) )
                {{ Form::text('first_name',$profile->first_name,array('class'=>'form-control profile-field','maxlength'=> 35)) }}
            @else
                {{ Form::text('first_name',null,array('class'=>'form-control profile-field','maxlength'=> 35)) }}
            @endif
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('last_name','Last Name') }}
            @if( isset($profile->last_name) )
                {{ Form::text('last_name',$profile->last_name,array('class'=>'form-control profile-field','maxlength'=> 35)) }}
            @else
                {{ Form::text('last_name',null,array('class'=>'form-control profile-field','maxlength'=> 35)) }}
            @endif
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
            {{ Form::label('street_address','Street Address') }}
            @if( isset($profile->street_address) )
                {{ Form::text('street_address',$profile->street_address,array('class'=>'form-control profile-field','maxlength'=> 90)) }}
            @else
                {{ Form::text('street_address',null,array('class'=>'form-control profile-field','maxlength'=> 90)) }}
            @endif
            <span class="validation-error"></span>
        </div>
        <div class="form-group col-md-8">
                {{ Form::label('apt_suite','APT/Suite') }}
                @if( isset($profile->apt_suite) )
                    {{ Form::text('apt_suite',$profile->apt_suite,array('class'=>'form-control profile-field','maxlength'=> 8)) }}
                @else
                    {{ Form::text('apt_suite',null,array('class'=>'form-control profile-field','maxlength'=> 8)) }}
                @endif
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- end of left section -->

        <!-- middle section -->
        <div class="col-md-4">
            <div class="form-group col-md-8">
                {{ Form::label('city','City') }}
                @if( isset($profile->city) )
                    {{ Form::text('city',$profile->city,array('class'=>'form-control profile-field','maxlength'=> 45)) }}
                @else
                    {{ Form::text('city',null,array('class'=>'form-control profile-field','maxlength'=> 45)) }}
                @endif
                <span class="validation-error"></span>
            </div>
            <div class="form-group col-md-8">
                {{ Form::label('state','State') }}
                @if( isset($profile->state) )
                    {{ Form::select('state',$states,$profile->state,array('class'=>'form-control profile-field')) }}
                @else
                    {{ Form::select('state',$states,null,array('class'=>'form-control profile-field')) }}
                @endif
                <span class="validation-error"></span>
            </div>
            <div class="form-group col-md-8">
                {{ Form::label('zip','Zip') }}
                @if( isset($profile->zip) )
                    {{ Form::text('zip',$profile->zip,array('class'=>'form-control profile-field','maxlength'=> 5)) }}
                @else
                    {{ Form::text('zip',null,array('class'=>'form-control profile-field','maxlength'=> 5)) }}
                @endif
                <span class="validation-error"></span>
            </div>
            <div class="col-md-8">
                {{ Form::button('save',array('class'=>'btn btn-success','id'=>'updateProfile')) }}
            </div>
        </div>
        <!-- end of middle section -->

        <!-- right section -->
        <div class="col-md-4">
        </div>
        <!-- end of right section -->
</div>
