<h1>Edit Category</h1>
{{ Form::hidden('_token',csrf_token(),array('class'=>'category-field')) }}
{{ Form::hidden('id',$category->id,array('class'=>'category-field')) }}
<div class="row well">
    <div class="row">
        <div class="col-xs-2 form-group">
            {{ Form::label('name','Name') }}
            {{ Form::text('category',$category->category,array('class'=>'form-control category-field','maxlength'=>'16')) }}
             <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 form-group">
            {{ Form::label('type','Type') }}
            {{ Form::select('category_type',$types,$category->category_type,array('class'=>'form-control category-field')) }}
            <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 form-group">
            {{ Form::button('update',array('class'=>'btn btn-success','id'=>'updateCategory')) }}
        </div>
    </div>
</div>
