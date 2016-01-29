<h1> Pest Library </h1>

<div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <a href="#pests/create" class="btn btn-success create-pest">Add New</a>
    <input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
    <script> TableFilter.init('#filter'); </script>
    <table id="pest-table" class="table table-condensed table-hover table-striped">

        <thead>
        <tr>
            <th>Procedure Name</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Severity</th>
            <th>Creation Date</th>
            <th>Manage</th>
        </tr>
        </thead>

        <tbody>

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
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    <input id ="token" type="hidden" value="{{ csrf_token() }}">
</div>
{!! $pests->render() !!}

<script type="text/javascript">

    $("#pest-table").tablesorter({
        headers: {6: {sorter: false}}
    });

</script>