<h1> Plant Library </h1>

<div> 

<a href="#plants/create" class="btn btn-success create-plant">Add New</a>
<input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
<script> TableFilter.init('#filter'); </script>
<table id="plant-table" class="table table-condensed table-hover table-striped"> 

<thead> 
<tr> 
	<th>Plant</th> 
	<th>Creation Date</th> 
	<th>Botanical Name</th>
	<th>Category</th>
	<th>Sub Category</th>
	<th>Maintenance</th>
	<th>Manage</th>
</tr> 
</thead> 

<tbody> 

<tr> 
<td><a href="#plants/1" class="primary-name"> Yellow Hosta</a></td> 
<td>5/09/15</td> 
<td>botanicalname1</td>
<td>Annuals</td>
<td>Ferns</td>
<td>Low</td>
<td>
	<input type="hidden" data-plant-id="1">
	<a href="#plants/1/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
	<a href="#plants/1/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
</td>
</tr> 

<tr> 
<td><a href="#plants/2" class="primary-name"> Red Hosta</a></td>
<td>5/10/15</td> 
<td>botanicalname2</td>
<td>Annuals</td>
<td>Ferns</td>
<td>Medium</td>
<td>
	<input type="hidden" data-plant-id="2">
	<a href="#plants/2/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
	<a href="#plants/2/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
</td>
</tr> 

<tr> 
<td><a href="#plants/3" class="primary-name"> White Hosta</a></td>
<td>5/07/15</td> 
<td>botanicalname3</td>
<td>Annuals</td>
<td>Ferns</td>
<td>High</td>
<td>
	<input type="hidden" data-plant-id="3">
	<a href="#plants/3/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
	<a href="#plants/3/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
</td>
</tr> 

<tr> 
<td><a href="#plants/4" class="primary-name"> Blue Hosta</a></td>
<td>5/02/15</td> 
<td>botanicalname4</td>
<td>Annuals</td>
<td>Ferns</td>
<td>Low</td>
<td>
	<input type="hidden" data-plant-id="4">
	<a href="#plants/4/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
	<a href="#plants/4/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
</td>
</tr> 

<tr> 
<td><a href="#plants/5" class="primary-name"> Green Hosta</a></td>
<td>5/02/15</td>
<td>botanicalname5</td>
<td>Annuals</td>
<td>Ferns</td>
<td>High</td>
<td>
	<input type="hidden" data-plant-id="5">
	<a href="#plants/5/edit" class="btn btn-sm btn-primary edit-plant">Edit</a>
	<a href="#plants/5/delete" class="btn btn-sm btn-danger delete-plant">Delete</a>
</td>
</tr> 

</tbody> 

</table> 

</div>

<script type="text/javascript">

	$("#plant-table").tablesorter({
		headers: {6: {sorter: false}}
	});

</script>