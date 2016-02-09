<h1 class="form-group-header-h1">Transactions</h1>
<div class="row well">
    <div class="col-xs-12">
        <table class="table table-condensed">
            <tr>
                <td>#</td>
                <td>date</td>
                <td>amount</td>
                <td>status</td>
                <td>method</td>
            </tr>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ $transaction->method }}</td>
                <tr>
            @endforeach
        </table>
    </div>
</div>
