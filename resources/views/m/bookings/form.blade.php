{{ Form::open(array('url' => '/m/bookings')) }}

    <div class="row">
        <div class="form-group col-sm-12">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', old('name', $userName), array('class' => 'form-control')) }}
        </div>

        <div class="form-group col-sm-12">
            {{ Form::label('from', 'From') }}
            {{ Form::date('from', old('from'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group col-sm-12">
            {{ Form::label('to', 'To') }}
            {{ Form::date('to', old('to'), array('class' => 'form-control')) }}
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('main', 'Main', ['class' => 'checkbox-label']) }}
                {{ Form::checkbox('main', true, old('main', true)) }}
            </div>

            <div class="form-group">
                {{ Form::label('flat', 'Flat', ['class' => 'checkbox-label']) }}
                {{ Form::checkbox('flat', true, old('flat', false)) }}
            </div>

            <div class="form-group">
                {{ Form::label('studio', 'Studio', ['class' => 'checkbox-label']) }}
                {{ Form::checkbox('studio', true, old('studio', false)) }}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="conflict-message" id="conflict-message">

                <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> There's a conflit with the dates you've selected</p>
                <span id="conflict-info"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{ Form::submit('Create the Booking!', array('class' => 'btn btn-primary')) }}
        </div>
    </div>



{{ Form::close() }}
