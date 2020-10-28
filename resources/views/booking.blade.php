@extends('layouts.app_public')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header">かんたん予約</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'booking_check']) !!}
                    <div class="col-12 mb-3">
                        {{ Form::label('date', '日付：', ['class' => 'd-inline']) }}
                        {{ Form::date('date', $today, ['max' => $twoMonthsLater]) }}
                        @if($errors->has('date'))
                            <p class="text-danger">{{$errors->first('date')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('time', '到着予定：', ['class' => 'd-inline']) }}
                        {{ Form::time('time', old('time'), ['step' => $step, 'min' => $minTime, 'max' => $maxTime]) }}
                        @if($errors->has('time'))
                            <p class="text-danger">{{$errors->first('time')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('people', '人数：', ['class' => 'd-inline']) }}
                        {{ Form::number('people', old('people'), ['class' => '']) }}
                        @if($errors->has('people'))
                            <p class="text-danger">{{$errors->first('people')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('nickname', 'ニックネーム：', ['class' => 'd-inline']) }}
                        {{ Form::text('nickname', old('nickname'), ['class' => '']) }}
                        @if($errors->has('nickname'))
                            <p class="text-danger">{{$errors->first('nickname')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::label('mail', 'メールアドレス：', ['class' => 'd-inline']) }}
                        {{ Form::text('mail', old('mail'), ['class' => '']) }}
                        @if($errors->has('mail'))
                            <p class="text-danger">{{$errors->first('mail')}}</p>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        {{ Form::submit('確認画面へ', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'do_booking']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
