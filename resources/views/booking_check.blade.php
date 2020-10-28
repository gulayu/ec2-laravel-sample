@extends('layouts.app_public')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header">予約情報の確認</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'booking_exec']) !!}
                    <div class="col-12 mb-3">
                        {{ Form::label('date', '日付：', ['class' => 'd-inline']) }}
                        <p class="d-inline">{{ $bookingInfo->date }}</p>
                        {{ Form::hidden('date', $bookingInfo->date) }}
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('time', '到着予定：', ['class' => 'd-inline']) }}
                        <p class="d-inline">{{ $bookingInfo->time }}</p>
                        {{ Form::hidden('time', $bookingInfo->time) }}
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('people', '人数：', ['class' => 'd-inline']) }}
                        <p class="d-inline">{{ $bookingInfo->people }}</p>
                        {{ Form::hidden('people', $bookingInfo->people) }}
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('nickname', 'ニックネーム：', ['class' => 'd-inline']) }}
                        <p class="d-inline">{{ $bookingInfo->nickname }}</p>
                        {{ Form::hidden('nickname', $bookingInfo->nickname) }}
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('mail', 'メールアドレス：', ['class' => 'd-inline']) }}
                        <p class="d-inline">{{ $bookingInfo->mail }}</p>
                        {{ Form::hidden('mail', $bookingInfo->mail) }}
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::submit('修正する', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'back']) }}
                        {{ Form::submit('予約する！', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'do_booking']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
