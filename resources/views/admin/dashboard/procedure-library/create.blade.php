
<script>
    var searchableNamesList = {!! $searchable_names !!};
</script>

<h1 class="page-header"> Create Procedure </h1>

{!! Form::open(array('id' => 'create-procedure-form', 'class' => "panel", "files" => 'true')) !!}

    <div class="row well">

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('name', 'Procedure Name') }}
                {{ Form::text('name', null, array('class'=>'form-control')) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group">
                {{ Form::label('procedure_searchable_names', 'Other Searchable Names') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'searchableNames')) }}
                <span class="validation-error"></span>
                <script>
                    var searchableNames = $('#searchableNames').magicSuggest({
                        data: searchableNamesList,
                        valueField: 'id',
                        displayField: 'name',
                        placeholder: 'Search for procedure related names'
                    });
                </script>
            </div>

        </div>

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
                    var $categoryId = $('#categoryId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var categoryId = $categoryId[0].selectize;
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

    <div class="row well">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('urgency_id', 'Urgency') }}
                <select id="urgencyId" name="urgency_id">
                    @foreach($urgencies as $urgency)
                        <option value="{{ $urgency['id'] }}">{{ $urgency['urgency'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    var $urgencyId = $('#urgencyId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var urgencyId = $urgencyId[0].selectize;
                </script>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('frequency_id', 'Frequency') }}
                <select id="frequencyId" name="frequency_id">
                    @foreach($frequencies as $frequency)
                        <option value="{{ $frequency['id'] }}">{{ $frequency['frequency'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    var $frequencyId = $('#frequencyId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var frequencyId = $frequencyId[0].selectize;
                </script>
            </div>
        </div>

    </div>

    <div class="row well">
        <!-- Procedure How -->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('how', 'Open Text') }}
                {{ Form::textarea('how', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Procedure Why -->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('why', 'Open Text') }}
                {{ Form::textarea('why', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
    </div>

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
                            {{ Form::file('_main_image', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
                        </p>
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

    <!-- Procedure Associated Plants -->
<div>
    <h2 class="inline-block pull-left form-group-header">Associated Plants</h2>
    {{ Form::button('Add New',array('class'=>'btn btn-success inline-block pull-right margin-topbottom-20-10','id'=>'add-plant')) }}
    <div class="clearfix"></div>
</div>

<div class="row well white" id="plantsTableContainer">
    <table class="table table-condensed table-hover table-striped">
        <thead>
        <tr>
            <th>Plant Name</th>
            <th>Latin Name</th>
            <th>Creation Date</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

    <!-- Procedure Associated Pests -->
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

            </tbody>
        </table>
    </div>

    <!-- Input, Plant Type Id -->
    <div class="row">
            <div class="form-group col-xs-4">
                {{ Form::button('Create',array('class'=>'btn btn-success btn-lg','id'=>'create-procedure')) }}
            </div>
    </div>

{!! Form::close() !!}

@include('admin.modals.create-procedure-add-plant')
@include('admin.modals.create-procedure-add-pest')