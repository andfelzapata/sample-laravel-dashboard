<script id="plant-row-template" type="text/x-handlebars-template">
    <tr>
        <td>
            {{ name }}
        </td>
        <td>
            {{ botanical_name }}
        </td>
        <td>
            {{ created_at }}
        </td>
        <td>
            {{ category }}
        </td>
        <td class="actions">
            <a class="btn btn-sm btn-danger remove-plant">Remove</a>
            <input name="associatedPlants[]" type="hidden" value="{{id}}">
        </td>
    </tr>
</script>