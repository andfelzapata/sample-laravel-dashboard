<h1 class="form-group-header-h1">Change Notification Settings</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('receive_emails',0,false,array('class'=>'setting-field')) }} 
                <small>Receive Emails</small>
            </div>
                <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('receive_text_alerts',0,false,array('class'=>'setting-field')) }} 
                <small>Receive Text Alerts</small>
            </div>
                <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('google_ical_alerts',0,false,array('class'=>'setting-field')) }}
                <small>Google and iCal Alerts</small>
            </div>
                <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('receive_push_alerts',0,false,array('class'=>'setting-field')) }}
                <small>Receive Push Alerts</small>
            </div>
                <span class="validation-error"></span>
        </div>
    </div>
    <!-- end of left section -->

    <!-- middle section -->
    <div class="col-md-4">
    </div>
    <!-- end of middle section -->

    <!-- right section -->
    <div class="col-md-4">
    </div>
    <!-- end of right section -->
</div>
