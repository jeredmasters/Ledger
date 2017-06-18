@if ($booking->id == null)
    {{ Form::open(array('url' => '/m/bookings', 'class' => 'booking-form')) }}
@else
    {{ Form::model($booking, array('route' => array('bookings.update', $booking->id), 'method' => 'PUT', 'class'=>'booking-form')) }}
@endif


            <div class="row">
                <div class="form-group col-sm-6">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', $booking->name, array('class' => 'form-control')) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('type', 'Type') }}
                    {{ Form::select('type', array('1' => 'Tentative', '2' => 'Locked In'), $booking->type, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    {{ Form::label('from', 'From') }}
                    {{ Form::date('from', $booking->from, array('class' => 'form-control')) }}
                </div>

                <div class="form-group col-sm-6">
                    {{ Form::label('to', 'To') }}
                    {{ Form::date('to', $booking->to, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group area-checkbox" style="background-color: {{config('areas.main.color')}}" for="main">
                        {{ Form::label('main', 'Main', ['class' => 'checkbox-label']) }}
                        {{ Form::checkbox('main', true, $booking->main) }}
                    </div>

                    <div class="form-group area-checkbox" style="background-color: {{config('areas.flat.color')}}">
                        {{ Form::label('flat', 'Flat', ['class' => 'checkbox-label']) }}
                        {{ Form::checkbox('flat', true, $booking->flat) }}
                    </div>

                    <div class="form-group area-checkbox" style="background-color: {{config('areas.studio.color')}}">
                        {{ Form::label('studio', 'Studio', ['class' => 'checkbox-label']) }}
                        {{ Form::checkbox('studio', true, $booking->studio) }}
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="conflict-message" id="conflict-message">

                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> There's a conflit with the dates you've selected: </p>
                        <span id="conflict-info"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                </div>
            </div>

{{ Form::close() }}
