<h1> Categories </h1>
@include('admin.partials.index_plant_categories')
@include('admin.partials.index_procedure_categories')
@include('admin.partials.index_pest_categories')
{{ Form::hidden('_token',csrf_token(),array('id'=>'_token')) }}

