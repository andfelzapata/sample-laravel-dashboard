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
                {{ Form::text('plant_searchable_names', null, array('class' => 'form-control', 'id' => 'searchableNames')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize searchable names multi-tag select.
                     */
                    $(function() {
                        $('#searchableNames').magicSuggest({
                            data: {!! $searchable_names  !!},
                            valueField: 'searchable_id',
                            displayField: 'name',
                            placeholder: 'Search for plant related names'
                        });
                    });
                </script>
            </div>

        </div>

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('category', 'Category') }}
                {{ Form::text('category', null, array('class' => 'form-control', 'id' => 'categories')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize category selection.
                     */
                    $(function() {
                        $('#categories').magicSuggest({
                            data: {!! $categories  !!},
                            valueField: 'categorizable_id',
                            displayField: 'category',
                            placeholder: 'Search for plant categories'
                        });
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('subcategory', 'Subcategory') }}
                {{ Form::text('subcategory', null, array('class' => 'form-control', 'id' => 'subcategories')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize subcategory selection.
                     */
                    $(function() {
                        $('#subcategories').magicSuggest({
                            data: {!! $subcategories  !!},
                            valueField: 'subcategorizable_id',
                            displayField: 'subcategory',
                            placeholder: 'Search for plant subcategories'
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('zone_id', 'Zone') }}
                {{ Form::text('zone_id', null, array('class' => 'form-control', 'id' => 'zones')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize subcategory selection.
                     */
                    $(function() {
                        $('#zones').magicSuggest({
                            data: {!! $zones  !!},
                            valueField: 'id',
                            displayField: 'zone',
                            placeholder: 'Search for zones'
                        });
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('plant_tolerations', 'Tolerates') }}
                {{ Form::text('plant_tolerations', null, array('class' => 'form-control', 'id' => 'tolerations')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize subcategory selection.
                     */
                    $(function() {
                        $('#tolerations').magicSuggest({
                            data: {!! $tolerations  !!},
                            valueField: 'id',
                            displayField: 'toleration',
                            placeholder: 'Search for existing tolerations'
                        });
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('plant_negative_characteristics', 'Negative Characteristics') }}
                {{ Form::text('plant_negative_characteristics', null, array('class' => 'form-control', 'id' => 'negativeTraits')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize subcategory selection.
                     */
                    $(function() {
                        $('#negativeTraits').magicSuggest({
                            data: {!! $negative_traits !!},
                            valueField: 'id',
                            displayField: 'characteristic',
                            placeholder: 'Search for negative characteristics'
                        });
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('plant_negative_characteristics', 'Positive Characteristics') }}
                {{ Form::text('plant_negative_characteristics', null, array('class' => 'form-control', 'id' => 'positiveTraits')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize subcategory selection.
                     */
                    $(function() {
                        $('#positiveTraits').magicSuggest({
                            data: {!! $positive_traits  !!},
                            valueField: 'id',
                            displayField: 'characteristics',
                            placeholder: 'Search for positive characteristics'
                        });
                    });
                </script>
            </div>

            <div class="form-group selectize">
                {{ Form::label('plant_growth_rate', 'Growth Rate') }}
                <select id="growthRates" name="plant_growth_rate">
                    <option value=""></option>
                    @foreach($growth_rates as $rate)
                        <option value="{{ $rate['id'] }}">{{ $rate['type'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    $(function() {
                        $('#growthRates').selectize({
                            allowEmptyOption: true,
                            create: true
                        });
                    });
                </script>
            </div>


        </div>

        <div class="col-xs-6">

            <div class="form-group selectize">
                {{ Form::label('plant_average_size', 'Average Size') }}
                <select id="averageSizes" name="plant_average_size">
                    <option value=""></option>
                    @foreach($average_sizes as $size)
                        <option value="{{ $size['id'] }}">{{ $size['size'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    $(function() {
                        $('#averageSizes').selectize({
                            allowEmptyOption: true,
                            create: true,
                        });
                    });
                </script>
            </div>

            <div class="form-group selectize">
                {{ Form::label('plant_maintenance', 'Maintenance') }}
                <select id="maintenance" name="plant_maintenance">
                    <option value=""></option>
                    @foreach($maintenances as $maintenance)
                        <option value="{{ $maintenance['id'] }}">{{ $maintenance['maintenance'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    $(function() {
                        $('#maintenance').selectize({
                            allowEmptyOption: true,
                            create: true,
                        });
                    });
                </script>
            </div>

            <div class="form-group selectize">
                {{ Form::label('plant_sun_exposure', 'Sun') }}
                <select id="sunExposure" name="plant_sun_exposure">
                    <option value=""></option>
                    @foreach($sun_exposure as $exposure)
                        <option value="{{ $exposure['id'] }}">{{ $exposure['exposure'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    $(function() {
                        $('#sunExposure').selectize({
                            allowEmptyOption: true,
                            create: true,
                        });
                    });
                </script>
            </div>

            <div class="form-group">
                {{ Form::label('moisture', 'Moisture') }}
                {{ Form::number('moisture', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>

            <div class="form-group">
                {{ Form::label('plant_soils', 'Soil') }}
                {{ Form::text('plant_soils', null, array('class' => 'form-control', 'id' => 'soils')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize subcategory selection.
                     */
                    $(function() {
                        $('#soils').magicSuggest({
                            data: {!! $soils !!},
                            valueField: 'id',
                            displayField: 'soil_type',
                            placeholder: 'Search for soil types'
                        });
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
            {{ Form::label('sponsor_name', 'Name') }}
            <select id="sponsors" name="sponsor_name">
                <option value=""></option>
                @foreach($sponsors as $sponsor)
                    <option value="{{ $sponsor['id'] }}">{{ $sponsor['name'] }}</option>
                @endforeach
            </select>
            <span class="validation-error"></span>
            <script>
                $(function() {
                    $('#sponsors').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                });
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
            {{ Form::text('sponsor_active_from', null, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
            {{ Form::label('sponsor_active_to', 'Active To') }}
            {{ Form::text('sponsor_active_to', null, array('class' => 'form-control')) }}
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
                {{ Form::button('Create',array('class'=>'btn btn-success','id'=>'create')) }}
                <span class="validation-error"></span>
            </div>
    </div>

{!! Form::close() !!}