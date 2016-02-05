
<script>
    var searchableNamesList = {!! $searchable_names !!};
    var procedureSearchableNames =  {!! $procedure->searchablenames->lists('id') !!};
    var procedureCategory = {!! $procedure->category->id !!};
    var procedureSubcategory = {!!  $procedure->subcategory->id !!};
    var procedureSeverity = {!!  $procedure->urgency->id !!};
    var procedureSponsor = {!! $procedure->sponsor->id !!};
</script>

<p>
<h1 class="page-header"> {{ $procedure->name  }} </h1>
</p>

{!! Form::open(array('id' => 'update-procedure-form', 'class' => "panel", "files" => 'true')) !!}

<div class="row well">

    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('name', 'Procedure Name') }}
            {{ Form::text('name', $procedure->name , array('class'=>'form-control')) }}
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
                searchableNames.setValue(procedureSearchableNames);
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
                categoryId.setValue(procedureCategory);
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
                var $subcategoryId = $('#subcategoryId').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var subcategoryId = $subcategoryId[0].selectize;
                subcategoryId.setValue(procedureSubcategory);
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
                var sponsors = $sponsors[0].selectize;
                sponsors.setValue(procedureSponsor);
            </script>
        </div>
    </div>
    <!-- End Category, Subcategory -->
</div>

<div class="row well">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('urgency_id', 'Severity') }}
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
                urgencyId.setValue(procedureSeverity);
            </script>
        </div>

    </div>

</div>

<div class="row well">
    <!-- Description of Procedure -->
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('how', 'How') }}
            {{ Form::textarea('how', $procedure->how, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
        </div>
    </div>
    <!-- Description of Damage -->
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('why', 'Why') }}
            {{ Form::textarea('why', $procedure->why, array('class' => 'form-control')) }}
            <span class="validation-error"></span>
        </div>
    </div>
</div>

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

<!-- Procedure Associated Plants -->
<h2>Associated Plants</h2>
<div class="row well">
</div>

<!-- Procedure Associated Pests -->
<h2>Associated Pests</h2>
<div class="row well">
</div>

<!-- Input, Plant Type Id -->
<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::hidden('id', $procedure->id) }}
        {{ Form::button('Update',array('class'=>'btn btn-success','id'=>'update-procedure')) }}
    </div>
</div>

{!! Form::close() !!}