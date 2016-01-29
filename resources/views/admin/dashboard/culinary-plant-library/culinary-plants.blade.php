<h1> Culinary Plant Library </h1>

<div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<a href="#culinary-plants/create" class="btn btn-success create-plant">Add New</a>
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

@foreach($culinary_plants as $plant)
    <tr>
        <td><a href="#culinary-plants/{{$plant->id}}/edit"> {{ $plant->common_name }} </a></td>
        <td>{{ $plant->botanical_name }}</td>
        <td>{{ $plant->category->category }}</td>
        <td>{{ $plant->subcategory->subcategory }}</td>
        <td>{{ $plant->maintenance->maintenance }}</td>
        <td>{{ $plant->created_at }}</td>
        <td>
            <input id="plantId" type="hidden" data-plant-id="{{$plant->id}}">
            <a href="#culinary-plants/{{$plant->id}}/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
            <a href="#culinary-plants/{{$plant->id}}/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
        </td>
    </tr>
@endforeach

</tbody>

</table>
<input id ="token" type="hidden" value="{{ csrf_token() }}">
</div>
{!! $culinary_plants->render() !!}

<script type="text/javascript">

	$("#plant-table").tablesorter({
		headers: {6: {sorter: false}}
	});

</script>