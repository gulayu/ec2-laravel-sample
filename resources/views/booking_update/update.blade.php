@extends('layouts.app_public')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card mb-5">
                <div class="card-header">現在の予約内容</div>
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <p>日付：{{$targetBooking->date}}</p>
                        <p>到着予定：{{$targetBooking->time}}</p>
                        <p>人数：{{$targetBooking->people}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-5">
                <div class="card-header">変更後の予約内容</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'booking_update_check']) !!}
                    <div class="col-12 mb-3">
                        {{ Form::label('date', '日付：', ['class' => 'd-inline']) }}
                        {{ Form::date('date', old('date') ? old('date') : $targetBooking->date, ['max' => $twoMonthsLater]) }}
                        @if($errors->has('date'))
                            <p class="text-danger">{{$errors->first('date')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('time', '到着予定：', ['class' => 'd-inline']) }}
                        {{ Form::time('time', old('time') ? old('time') : $targetBooking->time, ['step' => $step, 'min' => $minTime, 'max' => $maxTime]) }}
                        @if($errors->has('time'))
                            <p class="text-danger">{{$errors->first('time')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('people', '人数：', ['class' => 'd-inline']) }}
                        {{ Form::number('people', old('people') ? old('people') : $targetBooking->people, ['class' => '']) }}
                        @if($errors->has('people'))
                            <p class="text-danger">{{$errors->first('people')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::hidden('booking_number', $targetBooking->booking_number) }}
                        {{ Form::submit('上記内容に変更する', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'do_booking_update']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
