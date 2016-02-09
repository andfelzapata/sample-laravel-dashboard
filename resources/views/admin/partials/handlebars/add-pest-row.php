<script id="pest-row-template" type="text/x-handlebars-template">
    <tr>
        <td>
            {{ name }}
        </td>

        <td>
            {{ latin_name }}
        </td>

        <td>
            {{ created_at }}
        </td>
        <td>
            {{ severity }}
        </td>
        <td class="actions">
            <a class="btn btn-sm btn-danger remove-pest">Remove</a>
            <input name="associatedPests[]" type="hidden" value="{{id}}">
        </td>
    </tr>
</script>