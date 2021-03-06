
<script>
    var searchableNamesList = {!! $searchable_names !!};
</script>

<h1 class="page-header"> Create Pest </h1>

{!! Form::open(array('id' => 'create-pest-form', 'class' => "panel", "files" => 'true')) !!}

    <div class="row well">

        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('common_name', 'Pest Common Name') }}
                {{ Form::text('common_name', null, array('class'=>'form-control')) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group">
                {{ Form::label('latin_name', 'Pest Latin Name') }}
                {{ Form::text('latin_name', null, array('class'=>'form-control')) }}
                <span class="validation-error"></span>
            </div>
            <div class="form-group">
                {{ Form::label('pest_searchable_names', 'Other Searchable Names') }}
                {{ Form::text(null, null, array('class' => 'form-control', 'id' => 'searchableNames')) }}
                <span class="validation-error"></span>
                <script>
                    var searchableNames = $('#searchableNames').magicSuggest({
                        data: searchableNamesList,
                        valueField: 'id',
                        displayField: 'name',
                        placeholder: 'Search for pest related names'
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
            <div class="form-group">
                {{ Form::label('severity_id', 'Severity') }}
                <select id="severityId" name="severity_id">
                    @foreach($severities as $severity)
                        <option value="{{ $severity['id'] }}">{{ $severity['severity'] }}</option>
                    @endforeach
                </select>
                <span class="validation-error"></span>
                <script>
                    var $severityId = $('#severityId').selectize({
                        allowEmptyOption: true,
                        create: true
                    });
                    var severityId = $severityId[0].selectize;
                </script>
            </div>
        </div>
        <!-- End Category, Subcategory -->
    </div>

    <div class="row well">
        <!-- Description of Pest -->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('pest_description', 'Description Of Pest') }}
                {{ Form::textarea('pest_description', null, array('class' => 'form-control')) }}
                <span class="validation-error"></span>
            </div>
        </div>
        <!-- Description of Damage -->
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('damage_description', 'Description Of Damage') }}
                {{ Form::textarea('damage_description', null, array('class' => 'form-control')) }}
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
                        {{ Form::label('main_image_', 'Image') }}
                        <p class="btn btn-default btn-file">
                            Browse
                            {{ Form::file('main_image_', array('class' => 'form-control upload', 'id' => 'uploadButton')) }}
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

    <!-- Plant Associated Procedures -->
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

            </tbody>
        </table>
    </div>

    <!-- Input, Plant Type Id -->
    <div class="row">
            <div class="form-group col-xs-4">
                {{ Form::button('Create',array('class'=>'btn btn-success btn-lg','id'=>'create-pest')) }}
            </div>
    </div>

{!! Form::close() !!}

@include('admin.modals.create-pest-add-plant')
@include('admin.modals.create-pest-add-procedure')