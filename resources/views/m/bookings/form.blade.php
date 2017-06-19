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
                    <div class="form-group checkbox-wrapper" style="background-color: {{config('areas.main.color')}}" data-for="main">
                        <label for="main" class="checkbox-label">
                            Main {{ Form::checkbox('main', true, $booking->main, ['id'=>'main']) }}
                        </label>
                    </div>

                    <div class="form-group checkbox-wrapper" style="background-color: {{config('areas.flat.color')}}" data-for="flat">
                        <label for="flat" class="checkbox-label">
                            Flat {{ Form::checkbox('flat', true, $booking->flat, ['id'=>'flat']) }}
                        </label>
                    </div>

                    <div class="form-group checkbox-wrapper" style="background-color: {{config('areas.studio.color')}}" data-for="studio">
                        <label for="studio" class="checkbox-label">
                            Studio {{ Form::checkbox('studio', true, $booking->studio, ['id'=>'studio']) }}
                        </label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="conflict-message" id="conflict-message">

                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> There's a conflict with the dates you've selected: </p>
                        <span id="conflict-info"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right">
                    <a href="/m/calendar" class="btn btn-danger">Cancel</a>
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                </div>
            </div>

{{ Form::close() }}
