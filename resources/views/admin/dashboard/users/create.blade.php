<h1> Create User </h1>
<form id="form" role="form">
{{ Form::open() }}
    @include('admin.partials.create_top')
    <div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('Create',array('class'=>'btn btn-success create')) }}</div></div>
    @include('admin.partials.create_middle')
    <div class="row m-t-10 m-b-10"><div class="col-md-4 col-md-offset-4">{{ Form::button('Create',array('class'=>'btn btn-success create')) }}</div></div>
{{ Form::close() }}
</form>
