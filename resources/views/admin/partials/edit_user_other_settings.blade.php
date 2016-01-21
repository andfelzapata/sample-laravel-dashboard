<h1>Other Settings</h1>
<div class="row well">
    <!-- left section -->
    <div class="col-xs-12">
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->show_latin_names_plants) )
                    {{ Form::checkbox('show_latin_names_plants',$settings->show_latin_names_plants,$settings->show_latin_names_plants,array('class'=>'setting-field')) }}
                @else
                    {{ Form::checkbox('show_latin_names_plants',0,false,array('class'=>'setting-field')) }}
                @endif
                    <small>Show Latin Names for Plants</small>
            </div>
            <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->show_latin_names_culinary_plants) )
                    {{ Form::checkbox('show_latin_names_culinary_plants',$settings->show_latin_names_culinary_plants,$settings->show_latin_names_culinary_plants,array('class'=>'setting-field')) }}
                @else
                    {{ Form::checkbox('show_latin_names_culinary_plants',0,false,array('class'=>'setting-field')) }}
                @endif
                    <small>Show Latin Names for Culinary Plants</small>
            </div>
            <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                @if( isset($settings->show_latin_names_pests) )
                    {{ Form::checkbox('show_latin_names_pests',$settings->show_latin_names_pests,$settings->show_latin_names_pests,array('class'=>'setting-field')) }}
                @else
                    {{ Form::checkbox('show_latin_names_pests',0,false,array('class'=>'setting-field')) }}
                @endif
                    <small>Show Latin Names for Pests</small>
            </div>
            <span class="validation-error"></span>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                {{ Form::button('save',array('class'=>'btn btn-success','id'=>'updateSettings')) }}
            </div>
        </div>
    </div>
    <!-- end of left section -->

    <!-- middle section -->
    <!--<div class="col-md-4">
    </div>-->
    <!-- end of middle section -->

    <!-- right section -->
    <!--<div class="col-md-4">
    </div>-->
    <!-- end of right section -->
</div>
