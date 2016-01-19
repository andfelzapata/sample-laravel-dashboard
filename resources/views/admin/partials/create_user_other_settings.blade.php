<h1>Other Notification Settings</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('show_latin_names_plants',null,false,array('class'=>'setting-field disabled')) }}
                <label>Show Latin Names for Plants</label>
                <span class="validation-error"></span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('show_latin_names_culinary_plants',null,false,array('class'=>'setting-field disabled')) }}
                <label>Show Latin Names for Culinary Plants</label>
                <span class="validation-error"></span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::checkbox('show_latin_names_pests',null,false,array('class'=>'setting-field disabled')) }}
                <label>Show Latin Names for Pests</label>
                <span class="validation-error"></span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::button('save',array('class'=>'btn btn-success','id'=>'createSettings')) }}
            </div>
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
