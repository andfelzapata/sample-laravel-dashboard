<h1 class="form-group-header-h1">Change Notification Settings</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->id) )
                {{ Form::hidden('id',$settings->id,array('class'=>'setting-field')) }}
                @endif
                @if( isset($settings->receive_emails) )
                    {{ Form::checkbox('receive_emails',$settings->receive_emails,$settings->receive_emails,array('class'=>'setting-field')) }} 
                @else
                    {{ Form::checkbox('receive_emails',0,false,array('class'=>'setting-field')) }} 
                @endif
                    <small>Receive Emails</small>
            </div>
            <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->receive_text_alerts) )
                    {{ Form::checkbox('receive_text_alerts',$settings->receive_text_alerts,$settings->receive_text_alerts,array('class'=>'setting-field')) }} 
                @else
                    {{ Form::checkbox('receive_text_alerts',0,false,array('class'=>'setting-field')) }} 
                @endif
                    <small>Receive Text Alerts</small>
            </div>
            <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->google_ical_alerts) )
                    {{ Form::checkbox('google_ical_alerts',$settings->google_ical_alerts,$settings->google_ical_alerts,array('class'=>'setting-field')) }} 
                @else
                    {{ Form::checkbox('google_ical_alerts',0,false,array('class'=>'setting-field')) }} 
                @endif
                    <small>Google and iCal Alerts</small>
            </div>
            <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->receive_push_alerts) )
                    {{ Form::checkbox('receive_push_alerts',$settings->receive_push_alerts,$settings->receive_push_alerts,array('class'=>'setting-field')) }} 
                @else
                    {{ Form::checkbox('receive_push_alerts',0,false,array('class'=>'setting-field')) }} 
                @endif
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
