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
        <td>
            <input name="selectedProcedures[]" type="hidden" value="{{id}}">
            <a class="btn btn-sm btn-danger add-procedure">Remove</a>
        </td>
    </tr>
</script>