<script id="procedure-row-template" type="text/x-handlebars-template">
    <tr>
        <td>
            {{ name }}
        </td>
        <td>
            {{ created_at }}
        </td>
        <td>
            {{ frequency }}
        </td>
        <td>
            {{ urgency }}
        </td>
        <td class="actions">
            <a class="btn btn-sm btn-danger remove-procedure">Remove</a>
            <input name="associatedProcedures[]" type="hidden" value="{{id}}">
        </td>
    </tr>
</script>