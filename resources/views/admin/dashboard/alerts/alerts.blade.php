<h1> Alerts </h1>

<div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <a href="#alerts/create" class="btn btn-success create-alert">Add New</a>
    <input class="form-control table-filter" id="filter" placeholder="Search:" type="text">
    <script> TableFilter.init('#filter'); </script>
    <table id="alert-table" class="table table-condensed table-hover table-striped">

        <thead>
        <tr>
            <th>Alert Name</th>
            <th>Procedure Name</th>
            <th>Plant Name</th>
            <th>Zone</th>
            <th>Urgency</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        </thead>

        <tbody>

        @foreach($alerts as $alert)
            <tr>
                <td><a href="#alerts/{{$alert->id}}/edit"> {{ $alert->name }} </a></td>
                <td>{{ $alert->procedure->name }}</td>
                <td>{{ $alert->plant->common_name }}</td>
                <td>{{ $alert->zone->zone }}</td>
                <td>{{ $alert->urgency->urgency }}</td>
                <td>{{ $alert->start_date }}</td>
                <td>{{ $alert->end_date }}</td>
                <td>
                    <input id="alertId" type="hidden" data-alert-id="{{$alert->id}}">
                    <a href="#alerts/{{$alert->id}}/edit" class="btn btn-sm btn-primary edit-alert">Edit</a>
                    <a href="#alerts/{{$alert->id}}/delete" class="btn btn-sm btn-danger delete-alert">Delete</a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    <input id ="token" type="hidden" value="{{ csrf_token() }}">
</div>

{!! $alerts->render() !!}

<script type="text/javascript">

    $("#alert-table").tablesorter({
        headers: {6: {sorter: false}}
    });

</script>