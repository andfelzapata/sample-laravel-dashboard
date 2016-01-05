<h1> Users </h1>

<div> 

<a href="#users/create" class="btn btn-success create-user">Add New</a>
<input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
<script> TableFilter.init('#filter'); </script>
<table id="user-table" class="table table-condensed table-hover table-striped"> 

<thead> 
<tr> 
	<th>Username</th> 
	<th>Email</th>
	<th>Last Login</th>
</tr> 
</thead> 
<tbody>
@foreach($users as $user)
<tr>
    <td><a href="#users/{{$user->id}}" class="primary-name">{{$user->username}}</a></td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->last_login or 'Never' }}</td>
</tr>
@endforeach
</tbody>
</table> 

</div>

<script type="text/javascript">

	$("#user-table").tablesorter({
		headers: {6: {sorter: false}}
	});

</script>
