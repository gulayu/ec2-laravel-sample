@extends('layouts.app_public')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header">かんたん予約 予約内容の変更</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'booking_number_check']) !!}
                    <div class="col-12 mb-3">
                        {{ Form::label('booking_number', '予約番号：', ['class' => 'd-inline']) }}
                        {{ Form::text('booking_number', old('booking_number'), ['class' => '']) }}
                        @if($errors->has('booking_number'))
                            <p class="text-danger">{{$errors->first('booking_number')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::submit('予約内容変更画面へ', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'booking_number_check']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
