<h1> Categories </h1>
@if( count($plants) > 0 )
    @include('admin.partials.index_plant_categories')
@endif

@if( count($procedures) > 0 )
    @include('admin.partials.index_procedure_categories')
@endif 

@if( count($pests) > 0 )
    @include('admin.partials.index_pest_categories')
@endif

