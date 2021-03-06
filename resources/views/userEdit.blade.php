@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 編集完了時のログ表示 -->
    @isset($info)
        @if($info->type === 'edit_done')
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">編集実行ログ</div>
                    <div class="card-body">
                        <p class="font-weight-bold">顧客情報の編集を実行しました</p>
                        <p>管理番号：{{ $info->number }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endisset
    <div class="row mb-3">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">入店退編集</div>
                <div class="card-body">
                {!! Form::open(['route' => 'userEdit']) !!}
                <div class="row mb-5">
                    <div class="col-12">
                        <p>管理番号：{{$targetCustomer->number}}</p>
                        {{Form::hidden('id', $targetCustomer->id)}}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('enter_time', '入店時間：', ['class' => '']) }}
                        {{ Form::text('enter_time', $targetCustomer->setTimeDisplay($targetCustomer->enter_time), ['class' => 'border-dark p-1']) }}
                        @if($errors->has('enter_time'))
                            <p class="text-danger">{{$errors->first('enter_time')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('exit_time', '退店時間：', ['class' => '']) }}
                        {{ Form::text('exit_time', $targetCustomer->setTimeDisplay($targetCustomer->exit_time), ['class' => 'border-dark p-1']) }}
                        @if($errors->has('exit_time'))
                            <p class="text-danger">{{$errors->first('exit_time')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('day_info-label', '属性情報(平日or休日)：', ['class' => '']) }}
                        <label>
                            {{ Form::radio('day_info', '1', $targetCustomer->isWeekday($targetCustomer->day_info)) }} 平日
                        </label>
                        <label>
                            {{ Form::radio('day_info', '2', $targetCustomer->isWeekend($targetCustomer->day_info), ['class' => 'ml-3']) }} 休日
                        </label>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('member_info-label', '属性情報(相席orグループ)：', ['class' => '']) }}
                        <label>
                            {{ Form::radio('member_info', '1', $targetCustomer->isSolo($targetCustomer->member_info)) }} 相席
                        </label>
                        <label>
                            {{ Form::radio('member_info', '2', $targetCustomer->isGroup($targetCustomer->member_info), ['class' => 'ml-3']) }} グループ
                        </label>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('add_info', '追加情報：', ['class' => '']) }}
                        <label>
                            {{ Form::checkbox('use_drinkbar', '1', $targetCustomer->hasDrinkbar($targetCustomer->use_drinkbar)) }} ドリンクバー利用
                        </label>
                        <label>
                            {{ Form::checkbox('under_jrhigh', '1', $targetCustomer->isUnderJrhigh($targetCustomer->under_jrhigh), ['class' => 'ml-3']) }} 小学生以下
                        </label>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('fee', '料金：', ['class' => '']) }}
                        {{ Form::number('fee', $targetCustomer->fee, ['class' => 'border-dark p-1']) }}
                        @if($errors->has('fee'))
                            <p class="text-danger">{{$errors->first('fee')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        {{ Form::label('memo', 'メモ：', ['class' => '']) }}
                        {{ Form::text('memo', $targetCustomer->memo, ['class' => 'border-dark p-1']) }}
                        @if($errors->has('memo'))
                            <p class="text-danger">{{$errors->first('memo')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('edit_customer', '顧客情報を確定 => ', ['class' => '']) }}
                            {{ Form::submit('編集実行', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'edit_customer']) }}
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            @include('layouts/customerTable')
        </div>
    </div>
</div>
@endsection
