<h1> Plant Library </h1>

<div>

<a href="#plants/create" class="btn btn-success create-plant">Add New</a>
<input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
<script> TableFilter.init('#filter'); </script>
<table id="plant-table" class="table table-condensed table-hover table-striped">

<thead>
<tr>
	<th>Plant</th>
	<th>Botanical Name</th>
	<th>Category</th>
	<th>Sub Category</th>
	<th>Maintenance</th>
    <th>Creation Date</th>
	<th>Manage</th>
</tr>
</thead>

<tbody>

@foreach($plants as $plant)
    <tr>
        <td><a href="#plants/{{$plant->id}}"> {{ $plant->common_name }} </a></td>
        <td>{{ $plant->botanical_name }}</td>
        <td>{{ $plant->category->category }}</td>
        <td>{{ $plant->subcategory->subcategory }}</td>
        <td>{{ $plant->maintenance->maintenance }}</td>
        <td>{{ $plant->created_at }}</td>
        <td>
            <input type="hidden" data-plant-id="{{$plant->id}}">
            <a href="/admin/dashboard/#plants/{{$plant->id}}/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
            <a href="/admin/dashboard/#plants/{{$plant->id}}/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
        </td>
    </tr>
@endforeach

</tbody>

</table>

</div>

{!! $plants->render() !!}

<script type="text/javascript">

	$("#plant-table").tablesorter({
		headers: {6: {sorter: false}}
	});

</script>