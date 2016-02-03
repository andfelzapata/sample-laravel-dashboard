<script>
    var alertProcedure = {!! $alert->procedure_id !!}
    var alertPlant = {!! $alert->plant_id !!}
    var alertZone = {!! $alert->zone_id !!}
    var alertUrgency = {!! $alert->alert_urgency_id !!}
</script>

<h1 class="page-header"> Edit Alert </h1>

{!! Form::open(array('id' => 'update-alert-form', 'class' => "panel")) !!}

<div class="row well">

    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('name', 'Alert Name') }}
            {{ Form::text('name', $alert->name , array('class'=>'form-control')) }}
            <span class="validation-error"></span>
        </div>
    </div>

</div>

<div class="row well">

    <div class="col-xs-6">

        <div class="form-group">
            {{ Form::label('procedure_id', 'Procedure') }}
            <select id="procedureId" name="procedure_id">
                @foreach($procedures as $procedure)
                    <option value="{{ $procedure['id'] }}">{{ $procedure['name'] }}</option>
                @endforeach
            </select>
            <span class="validation-error"></span>
            <script>
                /**
                 * Setup plant growth rates select.
                 */
                var $procedureId = $('#procedureId').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var procedureId = $procedureId[0].selectize;
                procedureId.setValue(alertProcedure);
            </script>
        </div>

    </div>

    <div class="col-xs-6">

        <div class="form-group">
            {{ Form::label('plant_id', 'Plant') }}
            <select id="plantId" name="plant_id">
                @foreach($plants as $plant)
                    <option value="{{ $plant['id'] }}">{{ $plant['common_name'] }}</option>
                @endforeach
            </select>
            <span class="validation-error"></span>
            <script>
                /**
                 * Setup plant growth rates select.
                 */
                var $plantId = $('#plantId').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var plantId = $plantId[0].selectize;
                plantId.setValue(alertPlant);
            </script>
        </div>

    </div>

</div>


<div class="row well">

    <div class="col-xs-6">

        <div class="form-group">
            {{ Form::label('zone_id', 'Zone') }}
            <select id="zoneId" name="zone_id">
                @foreach($zones as $zone)
                    <option value="{{ $zone['id'] }}">{{ $zone['zone'] }}</option>
                @endforeach
            </select>
            <span class="validation-error"></span>
            <script>
                /**
                 * Setup plant growth rates select.
                 */
                var $zoneId = $('#zoneId').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var zoneId = $zoneId[0].selectize;
                zoneId.setValue(alertZone);
            </script>
        </div>

    </div>

    <div class="col-xs-6">

        <div class="form-group">
            {{ Form::label('alert_urgency_id', 'Urgency') }}
            <select id="urgencyId" name="alert_urgency_id">
                @foreach($urgencies as $urgency)
                    <option value="{{ $urgency['id'] }}">{{ $urgency['urgency'] }}</option>
                @endforeach
            </select>
            <span class="validation-error"></span>
            <script>
                /**
                 * Setup urgency growth rates select.
                 */
                var $urgencyId = $('#urgencyId').selectize({
                    allowEmptyOption: true,
                    create: true
                });
                var urgencyId = $urgencyId[0].selectize;
                urgencyId.setValue(alertUrgency);
            </script>
        </div>

    </div>

</div>

<div class="row well">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('start_date', 'Start Date') }}
            {{ Form::date(null, null, array('class' => 'form-control', 'id' => 'startDate')) }}
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('end_date', 'End Date') }}
            {{ Form::date(null, null, array('class' => 'form-control', 'id' => 'endDate')) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-xs-4">
        {{ Form::hidden('id', $alert->id) }}
        {{ Form::button('Update',array('class'=>'btn btn-success','id'=>'update-alert')) }}
    </div>
</div>

{!! Form::close() !!}