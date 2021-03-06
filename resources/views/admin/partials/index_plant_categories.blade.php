<div class="row well plant-categories">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Plant Categories</h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-3">
                    <col class="col-xs-6">
                </colgroup>
                <tr>
                    <th><u>Category Name</u></th>
                    <th><u>Type</u></th>
                    <th><u>Methods</u></th>
                </tr>
                @foreach ($plants as $plant)
                    <tr>
                        <td>{{ $plant->category }}</td>
                        <td>{{ $plant->category_type }}</td>
                        <td>
                            <a href="/admin/dashboard/#categories/{{ $plant->id }}/edit" class="btn btn-sm btn-primary edit-category">Edit</a>
                            <a href="/admin/dashboard/#categories/{{ $plant->id }}/delete" data-category-id="{{ $plant->id }}" class="btn btn-sm btn-danger delete-category">Delete</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="/admin/dashboard/#categories/create" class="btn btn-sm btn-success create-category">Create New</a>
                    </td>
                </tr>
            </table>
            {{ $plant_links }}
        </div>
    </div>
</div>
