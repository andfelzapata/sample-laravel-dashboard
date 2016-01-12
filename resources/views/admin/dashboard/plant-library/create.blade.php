<style>
    .row.well {
        margin-left: 0px;
        margin-right:0px;
    }
</style>

<h1 class="page-header"> Create Plant </h1>

{!! Form::open(array('id' => 'form', 'class' => "panel")) !!}

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('common_name', 'Plant Common Name') }}
                {{ Form::text('common_name', null, array('class'=>'form-control')) }}
                <span class="validation-error"></span>
            </div>

            <div class="form-group">
                {{ Form::label('botanical_name', 'Botanical Name') }}
                {{ Form::text('botanical_name', null, array('class'=>'form-control')) }}
                <span class="validation-error"></span>
            </div>

            <div class="form-group">
                {{ Form::label('plant_searchable_names', 'Searchable Names') }}
                {{ Form::text('plant_searchable_names', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>

        </div>

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('category', 'Category') }}
                {{ Form::text('category', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>

            <div class="form-group">
                {{ Form::label('subcategory', 'Subcategory') }}
                {{ Form::text('subcategory', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
    </div>

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('zone_id', 'Zone') }}
                {{ Form::text('zone_id', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_tolerations', 'Tolerates') }}
                {{ Form::text('plant_tolerations', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_negative_characteristics', 'Negative Characteristics') }}
                {{ Form::text('plant_negative_characteristics', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_negative_characteristics', 'Positive Characteristics') }}
                {{ Form::text('plant_negative_characteristics', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_growth_rate', 'Growth Rate') }}
                {{ Form::text('plant_growth_rate', null, array('class' => 'form-control')) }}
            </div>


        </div>

        <div class="col-xs-6">

            <div class="form-group">
                {{ Form::label('plant_average_size', 'Average Size') }}
                {{ Form::text('plant_average_size', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_maintenance', 'Maintenance') }}
                {{ Form::text('plant_maintenance', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_sun_exposure', 'Sun') }}
                {{ Form::text('plant_sun_exposure', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('moisture', 'Moisture') }}
                {{ Form::number('moisture', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('plant_soils', 'Soil') }}
                {{ Form::text('plant_soils', null, array('class' => 'form-control')) }}
            </div>

        </div>
    </div>

    <div class="row well">
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('plant_maintenance', 'Maintenance') }}
                    {{ Form::text('plant_maintenance', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('plant_sun_exposure', 'Sun') }}
                    {{ Form::text('plant_sun_exposure', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('moisture', 'Moisture') }}
                    {{ Form::number('moisture', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('plant_soils', 'Soil') }}
                    {{ Form::text('plant_soils', null, array('class' => 'form-control')) }}
                </div>

            </div>
    </div>

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('notes', 'Important Notes') }}
                {{ Form::textarea('notes', null, array('class' => 'form-control')) }}
            </div>
        </div>
    </div>

    <div class="row well">
        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image', 'Main Image') }}
                {{ Form::file('main_image', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_description', 'Description') }}
                {{ Form::text('main_image_description', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_credit', 'Credit') }}
                {{ Form::text('main_image_credit', null, array('class' => 'form-control')) }}
            </div>
        </div>

    </div>

    <h2> Sponsor </h2>
    <div class="row well">
        <div class="cdi-xs-3">
            {{ Form::label('sponsor_name', 'Name') }}
            {{ Form::text('sponsor_name', null, array('class' => 'form-control')) }}
        </div>

        <div class="col-xs-3">
            {{ Form::label('sponsor_url', 'Url') }}
            {{ Form::text('sponsor_url', null, array('class' => 'form-control')) }}
        </div>

        <div class="col-xs-3">
            {{ Form::label('sponsor_description', 'Description') }}
            {{ Form::text('sponsor_description', null, array('class' => 'form-control')) }}
        </div>

        <div class="col-xs-3">
            {{ Form::label('sponsor_active_from', 'Active From') }}
            {{ Form::text('sponsor_active_from', null, array('class' => 'form-control')) }}
            {{ Form::label('sponsor_active_to', 'Active To') }}
            {{ Form::text('sponsor_active_to', null, array('class' => 'form-control')) }}
        </div>

    </div>

    <h2>Associated Procedures</h2>
    <div class="row well">

    </div>

    <h2>Associated Pests</h2>
    <div class="row well">
    </div>

    <div class="row">
            <div class="form-group col-xs-4">
                {{ Form::button('Create',array('class'=>'btn btn-success','id'=>'create')) }}
                <span class="validation-error"></span>
            </div>
    </div>

{!! Form::close() !!}