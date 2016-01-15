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
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'searchableNames')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize searchable names multi-tag select.
                     */
                    var searchableNames = $('#searchableNames').magicSuggest({
                        data: {!! $searchable_names  !!},
                        valueField: 'id',
                        displayField: 'name',
                        placeholder: 'Search for plant related names'
                    });

                </script>
            </div>

        </div>

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('category_id', 'Category') }}
                <select id="categoryId" name="category_id">

                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['category'] }}</option>
                    @endforeach

                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant growth rates select.
                     */
                    var $categoryId = $('#categoryId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var categoryId = $categoryId[0].selectize;
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('subcategory_id', 'Subcategory') }}
                <select id="subcategoryId" name="subcategory_id">

                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory['id'] }}">{{ $subcategory['subcategory'] }}</option>
                    @endforeach

                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant growth rates select.
                     */
                    var $subcategoryId = $('#subcategoryId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var subcategoryId = $subcategoryId[0].selectize;
                </script>
            </div>
        </div>
    </div>

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('zone_id', 'Zone') }}
                <select id="zoneId" name="zone_id">

                    @foreach($zones as $zone)
                        <option value="{{ $zone['id'] }}">{{ $zone['zone'] }}</option>
                    @endforeach

                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant growth rates select.
                     */
                    var $zoneId = $('#zoneId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var zoneId = $zoneId[0].selectize;
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('plant_tolerations', 'Tolerates') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'tolerations')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize plant tolerations selection.
                     */
                    var tolerations = $('#tolerations').magicSuggest({
                        data: {!! $tolerations  !!},
                        valueField: 'id',
                        displayField: 'toleration',
                        placeholder: 'Search for existing tolerations'
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('plant_negative_characteristics', 'Negative Characteristics') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'negativeTraits')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize negative characteristics dd selection.
                     */
                    var negativeTraits = $('#negativeTraits').magicSuggest({
                        data: {!! $negative_traits !!},
                        valueField: 'id',
                        displayField: 'characteristic',
                        placeholder: 'Search for negative characteristics'
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('plant_positive_characteristics', 'Positive Characteristics') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'positiveTraits')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize positive characteristics selection.
                     */
                    var positiveTratis = $('#positiveTraits').magicSuggest({
                        data: {!! $positive_traits  !!},
                        valueField: 'id',
                        displayField: 'characteristic',
                        placeholder: 'Search for positive characteristics'
                    });
                </script>
            </div>

            <div class="form-group selectize">
                {{ Form::label('plant_growth_rate_id', 'Growth Rate') }}
                <select id="growthRates" name="plant_growth_rate_id">

                    @foreach($growth_rates as $rate)
                        <option value="{{ $rate['id'] }}">{{ $rate['type'] }}</option>
                    @endforeach

                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant growth rates select.
                     */
                    var $growthRates = $('#growthRates').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var growthRates = $growthRates[0].selectize;
                </script>
            </div>


        </div>

        <div class="col-xs-6">

            <div class="form-group selectize">
                {{ Form::label('plant_average_size_id', 'Average Size') }}
                <select id="averageSizes" name="plant_average_size_id">

                    @foreach($average_sizes as $size)
                        <option value="{{ $size['id'] }}">{{ $size['size'] }}</option>
                    @endforeach

                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant average sizes select.
                     */
                    var $averageSizes = $('#averageSizes').selectize({
                        allowEmptyOption: true,
                        create: true,
                    });
                    var averageSizes = $averageSizes[0].selectize;
                </script>
            </div>

            <div class="form-group selectize">
                {{ Form::label('plant_maintenance_id', 'Maintenance') }}
                <select id="maintenance" name="plant_maintenance_id">

                    @foreach($maintenances as $maintenance)
                        <option value="{{ $maintenance['id'] }}">{{ $maintenance['maintenance'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant maintenance type select.
                     */
                    var $maintenance = $('#maintenance').selectize({
                        allowEmptyOption: true,
                        create: true,
                    });
                    var maintenance = $maintenance[0].selectize;
                </script>
            </div>

            <div class="form-group selectize">
                {{ Form::label('plant_sun_exposure_id', 'Sun') }}
                <select id="sunExposure" name="plant_sun_exposure_id">

                    @foreach($sun_exposure as $exposure)
                        <option value="{{ $exposure['id'] }}">{{ $exposure['exposure'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant sun exposure.
                     */
                    var $sunExposure = $('#sunExposure').selectize({
                        allowEmptyOption: true,
                        create: true,
                    });
                    var sunExposure = $sunExposure[0].serialize;
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('moisture', 'Moisture') }}
                {{ Form::number('moisture', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>

            <div class="form-group">
                {{ Form::label('plant_soils', 'Soil') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'soils')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize soils selection.
                     */
                    var soils = $('#soils').magicSuggest({
                        data: {!! $soils !!},
                        valueField: 'id',
                        displayField: 'soil_type',
                        placeholder: 'Search for soil types'
                    });
                </script>
            </div>

        </div>
    </div>

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('notes', 'Important Notes') }}
                {{ Form::textarea('notes', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
    </div>

    <div class="row well">
        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image', 'Main Image') }}
                {{ Form::file('main_image', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_description', 'Description') }}
                {{ Form::text('main_image_description', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_credit', 'Credit') }}
                {{ Form::text('main_image_credit', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>

    </div>

    <h2> Sponsor </h2>
    <div class="row well">
        <div class="col-xs-3">
            {{ Form::label('sponsor_id', 'Name') }}
            <select id="sponsors" name="sponsor_id">

                @foreach($sponsors as $sponsor)
                    <option value="{{ $sponsor['id'] }}">{{ $sponsor['name'] }}</option>
                @endforeach
            </select>
            <span class="validation-error"></span>
            <script>
                var $sponsors = $('#sponsors').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var sponsors = $sponsors[0].serialize;
            </script>

        </div>

        <div class="col-xs-3">
            {{ Form::label('sponsor_url', 'Url') }}
            {{ Form::text('sponsor_url', null, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
        </div>

        <div class="col-xs-3">
            {{ Form::label('sponsor_description', 'Description') }}
            {{ Form::text('sponsor_description', null, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
        </div>

        <div class="col-xs-3">
            {{ Form::label('sponsor_active_from', 'Active From') }}
            {{ Form::date('sponsor_active_from', null, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
            {{ Form::label('sponsor_active_to', 'Active To') }}
            {{ Form::date('sponsor_active_to', null, array('class' => 'form-control')) }}
            <span class="validation-error"></span>

    </div>

    <h2>Associated Procedures</h2>
    <div class="row well">

    </div>

    <h2>Associated Pests</h2>
    <div class="row well">

    </div>

    <div class="row">
            <div class="form-group col-xs-4">
                {{ Form::hidden('plant_type_id', $plant_types->first()->id) }}
                {{ Form::button('Create',array('class'=>'btn btn-success','id'=>'createPlant')) }}
            </div>
    </div>

{!! Form::close() !!}