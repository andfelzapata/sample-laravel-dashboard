<h1> System Notifications </h1>
<div class="row well">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th class="col-xs-2"><u>Action</u></th>
                <th class="col-xs-2"><u>Condition</u></th>
                <th class="col-xs-2"><u>Content</u></th>
                <th class="col-xs-1"><u>Status</u></th>
                <th class="col-xs-2"><u>From</u></th>
            </tr>
        </thead>
            @foreach($notifications as $notification)
                <tr>
                    <td>{{ $notification->action }}</td>
                    <td>{{ $notification->condition }}</td>                   
                    <td>{{ $notification->content }}</td>
                    <td>
                        @if( $notification->status )
                            {{ Form::button('on',array('class'=>'btn btn-success')) }}
                        @else
                            {{ Form::button('off',array('class'=>'btn btn-danger')) }}
                        @endif
                    </td>
                    <td>{{ $notification->from }}</td>
                </tr>
            @endforeach
    </table>
    {{ $notification_links }}
</div>
<script type="text/javascript">
    $.fn.bootstrapSwitch.defaults.size = 'small';
    $('input[type="checkbox"]').bootstrapSwitch();
</script>
