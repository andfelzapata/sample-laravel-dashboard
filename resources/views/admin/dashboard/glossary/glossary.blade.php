<h1> Glossary </h1>
<div class="row well">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th class="col-xs-2"><u>Name</u></th>
                <th class="col-xs-2"><u>Category</u></th>
                <th class="col-xs-8"><u>Methods</u></th>
            </tr>
        </thead>
            @foreach($terms as $term)
                <tr>
                    <td>{{ $term->name }}</td>
                    <td>{{ $term->category_type }}</td>
                    <td>
                        <a href="/admin/dashboard/#glossary/{{ $term->id }}/edit" class="btn btn-sm btn-primary edit-term">Edit</a>
                        <a href="/admin/dashboard/#glossary/{{ $term->id }}/delete" data-term-id="{{ $term->id }}" class="btn btn-sm btn-danger delete-term">Delete</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td><td></td><td><a href="#glossary/create" class="btn btn-success create-glossary">Add New</a></td>
            </tr>
    </table>
    {{ $terms_links }}
</div>
