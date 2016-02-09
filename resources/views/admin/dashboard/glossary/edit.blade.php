<h1>Edit Glossary Term</h1>
<div class="row well">
    <div class="row">
        <div class="col-md-3 form-group">
            {{ Form::label('name','Name') }}
            {{ Form::text('name',$term->name,array('maxlength'=>32,'class'=>'form-control glossary-field')) }}
             <span class="validation-error"></span>
        </div>
        <div class="col-md-9 form-group">
            {{ Form::label('meaning','Meaning') }}
            {{ Form::textarea('meaning',$term->meaning,array('maxlength'=>140,'class'=>'form-control glossary-field','rows'=>5)) }}
             <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            {{ Form::label('category','Category') }}
            {{ Form::select('category_type',$types,$term->category_typ,array('maxlength'=>32,'class'=>'form-control glossary-field')) }}
             <span class="validation-error"></span>
        </div>
        <div class="col-md-9 form-group">
            {{ Form::label('description','Description') }}
            {{ Form::textarea('description',$term->description,array('maxlength'=>140,'class'=>'form-control glossary-field','rows'=>5)) }}
             <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 form-group">
            {{ Form::label('pronunciation','Pronunciation') }}
            {{ Form::text('pronunciation',$term->pronunciation,array('maxlength'=>32,'class'=>'form-control glossary-field')) }}
             <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div id="file-upload" class="col-md-3 form-group dropzone">
        </div>
        <div class="col-md-3 form-group">
            {{ Form::label('alt','Alt Image Tag') }}
            {{ Form::text('alt_tag',$term->image->alt,array('maxlength'=>16,'class'=>'form-control glossary-field')) }}
             <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        {{ Form::button('update',array('class'=>'btn btn-success','id'=>'updateGlossary')) }}
        {{ Form::hidden('_token',csrf_token(),array('class'=>'glossary-field')) }}
        {{ Form::hidden('id',$term->id,array('class'=>'glossary-field')) }}
    <div>
</div>
