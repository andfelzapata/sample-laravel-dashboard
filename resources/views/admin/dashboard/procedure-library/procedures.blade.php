<h1> Procedure Library </h1>

<div>
    <a href="#procedures/create" class="btn btn-success create-procedure">Add New</a>
    <input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
    <script> TableFilter.init('#filter'); </script>
    <table id="procedure-table" class="table table-condensed table-hover table-striped">

        <thead>
        <tr>
            <th>Procedure Name</th>
            <th>Category</th>
            <th>Why</th>
            <th>Urgency</th>
            <th>Creation Date</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Manage</th>
        </tr>
        </thead>

        <tbody>

        @foreach($procedures as $procedure)
            <tr>
                <td><a href="#procedures/{{$procedure->id}}/edit"> {{ $procedure->name }} </a></td>
                <td>{{ $procedure->category->category }}</td>
                <td>{{ $procedure->why }}</td>
                <td>{{ $procedure->urgency->urgency }}</td>
                <td>{{ $procedure->created_at }}</td>
                <td>{{ $procedure->created_at }}</td>
                <td>{{ $procedure->created_at }}</td>
                <td>
                    <input id="procedureId" type="hidden" data-procedure-id="{{$procedure->id}}">
                    <a href="#procedures/{{$procedure->id}}/edit" class="btn btn-sm btn-primary edit-procedure">Edit</a>
                    <a href="#procedures/{{$procedure->id}}/delete" class="btn btn-sm btn-danger delete-procedure">Delete</a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>

{!! $procedures->render() !!}

<script type="text/javascript">

    $("#procedure-table").tablesorter({
        headers: {6: {sorter: false}}
    });

</script>
