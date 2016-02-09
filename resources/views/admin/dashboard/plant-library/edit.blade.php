<script>
    var searchableNamesList = {!! $searchable_names !!};
    var plantSearchableNames =  {!! $plant->searchablenames->lists('id') !!};
    var plantCategory = {!! $plant->category->id !!};
    var plantSponsor = {!! $plant->sponsor->id !!};
    var plantZone = {!! $plant->zone->id !!};
    var plantMoisture = {{ $plant->moisture->id }}
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

{!! Form::open(array('id' => 'update-plant-form', 'class' => "panel", "files" => 'true')) !!}

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
                // Populate searchable names with existing values.
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
            <script>
                /**
                 * Setup plant categories select.
                 */
                var $categoryId = $('#categoryId').selectize({
                    allowEmptyOption: true,
                    labelField: 'category',
                    valueField: 'id',
                    create:function (input, callback) {
                        $("#category-create").unbind();
                        $("#category-name").val(input);
                        $("#createCategoryModal .validation-error").html("");
                        $('#createCategoryModal').modal("show");
                        $('#category-create').click(function(){
                            ServerCall.request(
                                    'POST',
                                    'categories',
                                    {
                                        category: $("#category-name").val(),
                                        category_type: 'plant',
                                        _token: $("input[name='_token']").val()
                                    }
                            ).success(function(response){

                                $("#category-name").val("");
                                $('#createCategoryModal').modal("hide");
                                callback({id: response.id, category: response.category });

                            }).error(function(errors){

                                if(errors.status == 422)
                                {
                                    $("#createCategoryModal .validation-error").html(errors.responseJSON.category[0]);
                                    callback({id: '', category: '' });
                                }
                                else {
                                    ServerError(errors);
                                }
                            });
                        });
                    }
                });
                var categoryId = $categoryId[0].selectize;
                categoryId.setValue(plantCategory);
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
                        $("#sponsor-create").unbind();
                        $("#sponsor-name").val(input);
                        $('#sponsorModal').modal("show");
                        $("#sponsorModal .validation-error").html("");
                        $('#sponsor-create').click(function(){
                            ServerCall.request(
                                    'POST',
                                    'sponsors',
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
                            }).error(function (errors) {

                                if(errors.status == 422)
                                {
                                    showErrors(errors);
                                    callback({id: '', name: '' });
                                }
                                else {
                                    ServerError(errors);
                                }
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
                var moisture = $moisture[0].selectize;
                moisture.setValue(plantMoisture);
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
<h2 class="form-group-header">Main Image</h2>
<div class="row well">
    <!-- Image -->
    <div class="col-xs-3">
        <div class="form-group">
            <div class="">
                {{ Form::label('main_image', 'Image') }}
                <p class="btn btn-default btn-file">
                    Browse
                    {{ Form::file('main_image', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
                </p>
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
<h2 class="form-group-header">Other Images</h2>
<div class="row well">
    <!-- Image Group Wrapper -->
    <div class="other-images-input-group">
        <!-- Image input -->
        <div class="col-xs-3">
            <div class="form-group">
                <div class="">
                    {{ Form::label('main_image', 'Image') }}
                    <p class="btn btn-default btn-file">
                        Browse
                        {{ Form::file('main_image', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
                    </p>
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
<div>
    <h2 class="inline-block pull-left form-group-header">Associated Procedures</h2>
    {{ Form::button('Add New',array('class'=>'btn btn-success inline-block pull-right margin-topbottom-20-10','id'=>'add-procedure')) }}
    <div class="clearfix"></div>
</div>

<div class="row well white" id="proceduresTableContainer">
    <table class="table table-condensed table-hover table-striped">
        <thead>
        <tr>
            <th>Procedure Name</th>
            <th>Creation Date</th>
            <th>Frequency</th>
            <th>Urgency</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($plant->procedures as $procedure)
                <tr>
                    <td>{{ $procedure->name }}</td>
                    <td>{{ $procedure->created_at }}</td>
                    <td>{{ $procedure->frequency->frequency }}</td>
                    <td>{{ $procedure->urgency->urgency }}</td>
                    <td>
                        <input name="associatedProcedures[]" type="hidden" value="{{$procedure->id}}">
                        <a class="btn btn-sm btn-warning procedure-alert">Alert</a>
                        <a class="btn btn-sm btn-success edit-procedure">Edit</a>
                        <a class="btn btn-sm btn-danger remove-procedure">Remove</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Plant Associated Pests -->
<div>
    <h2 class="inline-block pull-left form-group-header">Associated Pests</h2>
    {{ Form::button('Add New',array('class'=>'btn btn-success inline-block pull-right margin-topbottom-20-10','id'=>'add-pest')) }}
    <div class="clearfix"></div>
</div>
<div class="row well white" id="pestsTableContainer">
    <table class="table table-condensed table-hover table-striped">
        <thead>
        <tr>
            <th>Pest Name</th>
            <th>Latin Name</th>
            <th>Creation Date</th>
            <th>Severity</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($plant->pests as $pest)
                <tr>
                    <td> {{ $pest->common_name }} </td>
                    <td> {{ $pest->latin_name }} </td>
                    <td> {{ $pest->created_at }} </td>
                    <td> {{ $pest->severity->severity }} </td>
                    <td>
                        <input name="associatedPests[]" type="hidden" value="{{$pest->id}}">
                        <a class="btn btn-sm btn-success edit-pest">Edit</a>
                        <a class="btn btn-sm btn-danger remove-pest">Remove</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Input, Plant Type Id -->
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::hidden('id', $plant->id) }}
        {{ Form::hidden('plant_type_id', 1) }}
        {{ Form::button('Update',array('class'=>'btn btn-success btn-lg','id'=>'update-plant')) }}
    </div>
</div>

{!! Form::close() !!}

@include('admin.modals.create-category-model')

@include('admin.modals.create-sponsor-modal')

@include('admin.modals.create-plant-add-procedure')

@include('admin.modals.create-plant-add-pest')