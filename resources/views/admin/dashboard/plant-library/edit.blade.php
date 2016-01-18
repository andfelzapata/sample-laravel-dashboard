<style>
    .modal-backdrop.fade.in {
        display: none;
    }

    .modal-dialog {
        margin-top: 10%;
        margin-left: 40%;
    }
</style>

<script>
    var searchableNamesList = {!! $searchable_names !!};
    var plantSearchableNames =  {!! $plant->searchablenames->lists('id') !!};
    var plantCategory = {!! $plant->category->id !!};
    var plantSubcategory = {!!  $plant->subcategory->id !!};
    var plantSponsor = {!! $plant->sponsor->id !!};
    var plantZone = {!! $plant->zone->id !!};
    var tolerationsList = {!! $tolerations !!};
    var plantTolerations = {!! $plant->tolerations->lists('id') !!};
    var negativeTraitsList = {!! $negative_traits !!};
    var plantNegativeTraits = {!! $plant->negativetraits->lists('id') !!};
    var positiveTraitsList = {!! $positive_traits  !!};
    var plantPositiveTraits = {!! $plant->positivetraits->lists('id') !!};
    var plantGrowthRate = {!! $plant->growthrate->id !!};
    var plantAverageSize = {!! $plant->averagesize->id !!};
    var plantMaintenance = {!! $plant->maintenance->id !!};
    var plantSunExposure = {!! $plant->sunexposure->id !!};
    var soilsList = {!! $soils !!};
    var plantSoils = {!! $plant->soils->lists('id') !!};
</script>

<p>
<h1 class="page-header"> {{ $plant->common_name  }} <i> {{ $plant->botanical_name }}</i> </h1>
</p>

{!! Form::open(array('id' => 'update-user-form', 'class' => "panel", "files" => 'true')) !!}

        <!-- Common Name, Botanical Name, Plant Searchable Names, Category, Subcategory, Sponsor -->
<div class="row well">
    <!-- Common Name, Botanical Name, Plant Searchable Names -->
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('common_name', 'Plant Common Name') }}
            {{ Form::text('common_name', $plant->common_name, array('class'=>'form-control')) }}
            <span class="validation-error"></span>
        </div>
        <div class="form-group">
            {{ Form::label('botanical_name', 'Botanical Name') }}
            {{ Form::text('botanical_name', $plant->botanical_name, array('class'=>'form-control')) }}
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
                // Populate searhable names with existing values.
                searchableNames.setValue(plantSearchableNames)
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
                 * Setup plant categories select.
                 */
                var $categoryId = $('#categoryId').selectize({
                    allowEmptyOption: true,
                    labelField: 'category',
                    valueField: 'id',
                    create:function (input, callback) {
                        $("#category-name").val(input);
                        $('#createCategoryModal').modal("show");
                        $('#category-create').click(function(){
                            ServerCall.request(
                                    'POST',
                                    'categories/',
                                    {
                                        category: $("#category-name").val(),
                                        category_type: 'plant',
                                        _token: $("input[name='_token']").val()
                                    }
                            ).success(function(response){
                                $("#category-name").val("");
                                $('#createCategoryModal').modal("hide");
                                callback({id: response.id, category: response.category });
                            }).error(function (response) {

                            });
                        });
                    }
                });
                var categoryId = $categoryId[0].selectize;
                categoryId.setValue(plantCategory);
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
                 * Setup plant subcategories select.
                 */
                var $subcategoryId = $('#subcategoryId').selectize({
                    allowEmptyOption: true,
                    labelField: 'subcategory',
                    valueField: 'id',
                    create:function (input, callback) {
                        $("#subcategory-name").val(input);
                        $('#createSubcategoryModal').modal("show");
                        $('#subcategory-create').click(function(){
                            ServerCall.request(
                                    'POST',
                                    'subcategories/',
                                    {
                                        subcategory: $("#subcategory-name").val(),
                                        subcategory_type: 'plant',
                                        _token: $("input[name='_token']").val()
                                    }
                            ).success(function(response){
                                $("#subcategory-name").val("");
                                $('#createSubcategoryModal').modal("hide");
                                callback({id: response.id, subcategory: response.subcategory });
                            }).error(function (response) {

                            });
                        });
                    }
                });
                var subcategoryId = $subcategoryId[0].selectize;
                subcategoryId.setValue(plantSubcategory);
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
                    labelField: 'name',
                    valueField: 'id',
                    create:function (input, callback) {
                        $("#sponsor-name").val(input);
                        $('#sponsorModal').modal("show");
                        $('#sponsor-create').click(function(){
                            ServerCall.request(
                                    'POST',
                                    'sponsors/',
                                    {
                                        name: $("#sponsor-name").val(),
                                        email: $("#sponsor-email").val(),
                                        url: $("#sponsor-url").val(),
                                        description: $("#sponsor-description").val(),
                                        active_from: $("#sponsor-active-from").val(),
                                        active_to: $("#sponsor-active-to").val(),
                                        _token: $("input[name='_token']").val()
                                    }
                            ).success(function(response){
                                $("#sponsor-name").val("");
                                $('#sponsorModal').modal("hide");
                                callback({id: response.id, name: response.name });
                            }).error(function (response) {

                            });
                        });
                    }
                });
                var sponsors = $sponsors[0].selectize;
                sponsors.setValue(plantSponsor);
            </script>
        </div>
    </div>
    <!-- End Category, Subcategory -->
</div>
<!-- End Common Name, Botanical Name, Plant Searchable Names, Category, Subcategory -->

<!-- Zone, Toleration, Negative Traits, Positive Traits, Growth Rate, Average Size, Maintenance, Sun Exposure, Moisture, Soil -->
<div class="row well">
    <!-- Zone, Toleration, Negative Traits, Positive Traits, Growth Rate-->
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
                 * Setup plant zones select.
                 */
                var $zoneId = $('#zoneId').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var zoneId = $zoneId[0].selectize;
                zoneId.setValue(plantZone);
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
                    data: tolerationsList,
                    valueField: 'id',
                    displayField: 'toleration',
                    placeholder: 'Search for existing tolerations'
                });
                tolerations.setValue(plantTolerations);
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
                negativeTraits.setValue(plantNegativeTraits);
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
                positiveTraits.setValue(plantPositiveTraits);
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
                growthRates.setValue(plantGrowthRate);
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
                averageSizes.setValue(plantAverageSize);
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
                maintenance.setValue(plantMaintenance);
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
                var sunExposure = $sunExposure[0].selectize;
                sunExposure.setValue(plantSunExposure);
            </script>
        </div>
        <div class="form-group">
            {{ Form::label('moisture', 'Moisture') }}
            {{ Form::number('moisture', $plant->moisture, array('class' => 'form-control')) }}
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
                soils.setValue(plantSoils);
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
            {{ Form::textarea('description', $plant->description, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
        </div>
    </div>
    <!-- Important Notes -->
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('notes', 'Important Notes') }}
            {{ Form::textarea('notes', $plant->notes, array('class' => 'form-control')) }}
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
                {{ Form::file('main_image', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
            </div>
            <span class="validation-error"></span>
        </div>
    </div>
    <!-- Image Description -->
    <div class="col-xs-3">
        <div class="form-group">
            {{ Form::label('main_image_description', 'Description') }}
            {{ Form::text('main_image_description', null, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
        </div>
    </div>
    <!-- Image Credit -->
    <div class="col-xs-3">
        <div class="form-group">
            {{ Form::label('main_image_credit', 'Credit') }}
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
                    {{ Form::label('main_image', 'Image') }}
                    {{ Form::file('main_image', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
                </div>
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Image Description -->
        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_description', 'Description') }}
                {{ Form::text('main_image_description', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Image Credit -->
        <div class="col-xs-3">
            <div class="form-group">
                {{ Form::label('main_image_credit', 'Credit') }}
                {{ Form::text('main_image_credit', null, array('class' => 'form-control')) }}
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
        {{ Form::hidden('id', $plant->id) }}
        {{ Form::button('Update',array('class'=>'btn btn-success','id'=>'update-plant')) }}
    </div>
</div>

{!! Form::close() !!}

<div class="modal fade" id="createCategoryModal" role="dialog" aria-labelledby="createCategoryModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="createCategoryModalLabel">Create New Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" id="category-name" name="category-name" type="text">
                    <span class="validation-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="category-create" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createSubcategoryModal" role="dialog" aria-labelledby="createSubcategoryModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="createSubcategoryModalLabel">Create New Subcategory</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Subcategory Name</label>
                    <input class="form-control" id="subcategory-name" name="subcategory-name" type="text">
                    <span class="validation-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="subcategory-create" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sponsorModal" role="dialog" aria-labelledby="sponsorModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="sponsorModalLabel">Create New Sponsor</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" id="sponsor-name" name="sponsor-name" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" id="sponsor-email" name="sponsor-email" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Url</label>
                    <input class="form-control" id="sponsor-url" name="sponsor-url" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input class="form-control" id="sponsor-description" name="sponsor-description" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Active From</label>
                    <input class="form-control" id="sponsor-active-from" name="sponsor-active-from" type="date">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Active To</label>
                    <input class="form-control" id="sponsor-active-to" name="sponsor-active-to" type="date">
                    <span class="validation-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="sponsor-create" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>