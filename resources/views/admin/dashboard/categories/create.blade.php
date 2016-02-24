<h1>Create Category</h1>
<div class="row well">
    <div class="row">
        <div class="col-xs-2 form-group">
            {{ Form::label('name','Name') }}
            {{ Form::text('category',null,array('class'=>'form-control category-field','maxlength'=>'16')) }}
             <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 form-group">
            {{ Form::label('type','Type') }}
            {{ Form::select('category_type',$types,null,array('class'=>'form-control category-field')) }}
            <span class="validation-error"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 form-group">
            {{ Form::button('create',array('class'=>'btn btn-success','id'=>'createCategory')) }}
        </div>
    </div>
</div>
