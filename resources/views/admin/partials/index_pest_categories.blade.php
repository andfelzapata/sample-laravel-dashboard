<div class="row well pest-categories">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Pest Categories</h3>
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
                </tr>
                @foreach ( $pests as $pest )
                    <tr>
                        <td>{{ $pest->category }}</td>
                        <td>{{ $pest->category_type }}</td>
                        <td>
                            <a href="/admin/dashboard/#categories/{{ $pest->id }}/edit" class="btn btn-sm btn-primary edit-category">Edit</a>
                            <a href="/admin/dashboard/#categories/{{ $pest->id }}/delete" data-category-id="{{ $pest->id }}" class="btn btn-sm btn-danger delete-category">Delete</a>
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
            {{ $links }}
        </div>
    </div>
</div>
