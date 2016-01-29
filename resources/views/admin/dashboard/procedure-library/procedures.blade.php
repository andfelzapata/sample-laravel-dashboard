<<<<<<< HEAD
<h1> Pest Library </h1>
=======
<h1> Procedure Library </h1>
>>>>>>> 9fbcab3726bf0075cfcf5811f074b4474a5c5daa

<div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

<<<<<<< HEAD
    <a href="#pests/create" class="btn btn-success create-pest">Add New</a>
    <input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
    <script> TableFilter.init('#filter'); </script>
    <table id="pest-table" class="table table-condensed table-hover table-striped">
=======
    <a href="#procedures/create" class="btn btn-success create-procedure">Add New</a>
    <input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
    <script> TableFilter.init('#filter'); </script>
    <table id="procedure-table" class="table table-condensed table-hover table-striped">
>>>>>>> 9fbcab3726bf0075cfcf5811f074b4474a5c5daa

        <thead>
        <tr>
            <th>Procedure Name</th>
            <th>Category</th>
            <th>Sub Category</th>
<<<<<<< HEAD
            <th>Severity</th>
            <th>Creation Date</th>
=======
            <th>Why</th>
            <th>Urgency</th>
            <th>Creation Date</th>
            <th>Start Date</th>
            <th>End Date</th>
>>>>>>> 9fbcab3726bf0075cfcf5811f074b4474a5c5daa
            <th>Manage</th>
        </tr>
        </thead>

        <tbody>

<<<<<<< HEAD
        @foreach($pests as $pest)
            <tr>
                <td><a href="#pests/{{$pest->id}}/edit"> {{ $pest->common_name }} </a></td>
                <td>{{ $pest->latin_name }}</td>
                <td>{{ $pest->category->category }}</td>
                <td>{{ $pest->subcategory->subcategory }}</td>
                <td>{{ $pest->severity->severity }}</td>
                <td>{{ $pest->created_at }}</td>
                <td>
                    <input id="pestId" type="hidden" data-pest-id="{{$pest->id}}">
                    <a href="#pests/{{$pest->id}}/edit" class="btn btn-sm btn-primary edit-pest">Edit</a>
                    <a href="#pests/{{$pest->id}}/delete" class="btn btn-sm btn-danger delete-pest">Delete</a>
=======
        @foreach($procedures as $procedure)
            <tr>
                <td><a href="#procedures/{{$procedure->id}}/edit"> {{ $procedure->name }} </a></td>
                <td>{{ $procedure->category->category }}</td>
                <td>{{ $procedure->subcategory->subcategory }}</td>
                <td>{{ $procedure->why }}</td>
                <td>{{ $procedure->urgency->urgency }}</td>
                <td>{{ $procedure->created_at }}</td>
                <td>{{ $procedure->created_at }}</td>
                <td>{{ $procedure->created_at }}</td>
                <td>
                    <input id="procedureId" type="hidden" data-procedure-id="{{$procedure->id}}">
                    <a href="#procedures/{{$procedure->id}}/edit" class="btn btn-sm btn-primary edit-procedure">Edit</a>
                    <a href="#procedures/{{$procedure->id}}/delete" class="btn btn-sm btn-danger delete-procedure">Delete</a>
>>>>>>> 9fbcab3726bf0075cfcf5811f074b4474a5c5daa
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    <input id ="token" type="hidden" value="{{ csrf_token() }}">
</div>
<<<<<<< HEAD
{!! $pests->render() !!}

<script type="text/javascript">

    $("#pest-table").tablesorter({
=======
{!! $procedures->render() !!}

<script type="text/javascript">

    $("#procedure-table").tablesorter({
>>>>>>> 9fbcab3726bf0075cfcf5811f074b4474a5c5daa
        headers: {6: {sorter: false}}
    });

</script>