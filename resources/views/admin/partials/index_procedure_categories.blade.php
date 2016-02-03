<div class="row well procedure-categories">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Procedure Categories</h3>
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
                <tr>
                    <td></td>
                    <td></td>
                    @foreach ( $procedures as $procedure )
                     <tr>
                        <td>{{ $procedure->category }}</td>
                        <td>{{ $procedure->category_type }}</td>
                        <td>
                            <a href="/admin/dashboard/#categories/{{ $procedure->id }}/edit" class="btn btn-sm btn-primary edit-category">Edit</a>
                            <a href="/admin/dashboard/#categories/{{ $procedure->id }}/delete" data-category-id="{{ $procedure->id }}" class="btn btn-sm btn-danger delete-category">Delete</a>
                        </td>
                    </tr>
                    @endforeach 
                    <td></td>
                    <td></td>
                    <td><a href="/admin/dashboard/#categories/create" class="btn btn-sm btn-success create-category">Create New</a></td>
                </tr>
            </table>
            {{ $links }}
        </div>
    </div>
</div>
