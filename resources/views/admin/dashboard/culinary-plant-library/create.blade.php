
<script>
    var searchableNamesList = {!! $searchable_names !!};
    var tolerationsList = {!! $tolerations !!};
    var negativeTraitsList = {!! $negative_traits !!};
    var positiveTraitsList = {!! $positive_traits  !!};
    var soilsList = {!! $soils !!};
</script>


<h1 class="page-header"> Create Culinary Plant </h1>

{!! Form::open(array('id' => 'create-culinary-plant-form', 'class' => "panel", "files" => 'true')) !!}

    <!-- Common Name, Botanical Name, Plant Searchable Names, Category, Subcategory, Sponsor -->
    <div class="row well">
        <!-- Common Name, Botanical Name, Plant Searchable Names -->
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
                        data: searchableNamesList,
                        valueField: 'id',
                        displayField: 'name',
                        placeholder: 'Search for plant related names'
                    });
                </script>
            </div>

        </div>
        <!-- End Common Name, Botanical Name, Plant Searchable Names -->

        <!-- Category, Subcategory, Sponsor -->
        <div class="col-xs-6">
            <!-- Category -->
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
            <!-- Subcategory -->
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
            <!-- Sponsor -->
            <div class="form-group">
                {{ Form::label('sponsor_id', 'Sponsor') }}
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
        </div>
        <!-- End Category, Subcategory -->
    </div>
    <!-- End Common Name, Botanical Name, Plant Searchable Names, Category, Subcategory -->

    <!-- Zone, Toleration, Negative Traits, Positive Traits, Growth Rate, Average Size, Maintenance, Sun Exposure, Moisture, Soil -->
    <div class="row well">
        <!-- Toleration, Negative Traits, Positive Traits, Growth Rate-->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('plant_tolerations', 'Tolerates') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'tolerations')) }}
                <span class="validation-error"></span>
                <script>
                    /**
                     * Initialize plant tolerations selection.
                     */
                    var tolerations = $('#tolerations').magicSuggest({
                        data: tolerationsList,
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
                        data: negativeTraitsList,
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
                    var positiveTraits = $('#positiveTraits').magicSuggest({
                        data: positiveTraitsList,
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
        <!-- End Zone, Toleration, Negative Traits, Positive Traits, Growth Rate-->

        <!-- Average Size, Maintenance, Sun Exposure, Moisture, Soil -->
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
                <select id="moisture" name="plant_moisture_id">
                    @foreach($moistures as $moisture)
                        <option value="{{ $moisture['id'] }}">{{ $moisture['moisture'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    /**
                     * Setup plant sun exposure.
                     */
                    var $moisture = $('#moisture').selectize({
                        allowEmptyOption: true,
                        create: true,
                    });
                    var moisture = $moisture[0].serialize;
                </script>
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
                        data: soilsList,
                        valueField: 'id',
                        displayField: 'soil_type',
                        placeholder: 'Search for soil types'
                    });
                </script>
            </div>
        </div>
        <!-- End Average Size, Maintenance, Sun Exposure, Moisture, Soil -->
    </div>
    <!-- Zone, Toleration, Negative Traits, Positive Traits, Growth Rate, Average Size, Maintenance, Sun Exposure, Moisture, Soil -->

    <!-- Description, Important Notes -->
    <div class="row well">
        <!-- Description -->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Important Notes -->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('notes', 'Important Notes') }}
                {{ Form::textarea('notes', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
    </div>
    <!-- End Description, Important Notes -->

    <!-- Main Image: Image, Description, Image Credit -->
    <h2>Main Image</h2>
    <div class="row well">
        <!-- Image -->
        <div class="col-xs-3">
            <div class="form-group">
                <div class="">
                    {{ Form::label('main_image', 'Image') }}
                    {{ Form::file('main_image',null, array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
                </div>
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Image Description -->
        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_description', 'Enter Description Text') }}
                {{ Form::text('main_image_description', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Image Credit -->
        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_credit', 'Photo Credit') }}
                {{ Form::text('main_image_credit', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
    </div>
    <!-- End Main Image: Image, Description, Image Credit -->

    <!-- Other Images, Image, Description, Image Credit -->
    <!-- click on #add-new-image-fields adds a group of image, description and image credit inputs -->
    <h2>Other Images</h2>
    <div class="row well">
        <!-- Image Group Wrapper -->
        <div class="other-images-input-group col-xs-12">
            <!-- Image input -->
            <div class="col-xs-3">
                <div class="form-group">
                    <div class="">
                        {{ Form::label('main_image_', 'Image') }}
                        {{ Form::file('main_image_', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
                    </div>
                    <span class="validation-error"></span>
                </div>
            </div>
            <!-- Image Description -->
            <div class="col-xs-3">
                <div class="form-group">
                    {{ Form::label('main_image_description_', 'Description') }}
                    {{ Form::text('main_image_description_', null, array('class' => 'form-control')) }}
                    <span class="validation-error"></span>
                </div>
            </div>
            <!-- Image Credit -->
            <div class="col-xs-3">
                <div class="form-group">
                    {{ Form::label('main_image_credit_', 'Credit') }}
                    {{ Form::text('main_image_credit_', null, array('class' => 'form-control')) }}
                    <span class="validation-error"></span>
                </div>
            </div>
            <!-- Wrapper for button that deletes whole input group for multiple images -->
            <div class="remove-field-wrapper col-xs-3"></div>
        </div>
        <!-- End Image Group Wrapper -->

        <!-- #multi-input-placeholder serves as a anchor for inserting new multiple image groups before it -->
        <div id="multi-input-placeholder"></div>
        <div class="btn btn-success" id="add-new-image-fields">
            <i class="fa fa-plus"></i>
        </div>
    </div>
    <!-- End Other Images, Image, Description, Image Credit -->

    <!-- Plant Associated Procedures -->
    <h2>Associated Procedures</h2>
    <div class="row well">
    </div>

    <!-- Plant Associated Pests -->
    <h2>Associated Pests</h2>
    <div class="row well">
    </div>

    <!-- Input, Plant Type Id -->
    <div class="row">
            <div class="form-group col-xs-4">
                {{ Form::hidden('plant_type_id', $plant_types->find(2)->id) }}
                {{ Form::button('Create',array('class'=>'btn btn-success','id'=>'create-plant')) }}
            </div>
    </div>

{!! Form::close() !!}