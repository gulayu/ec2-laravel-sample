@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 入店・退店処理のログ表示用 -->
    @isset($info)
        @if($info->type == 'enter_time')
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">処理実行ログ</div>
                    <div class="card-body">
                        <p class="font-weight-bold">入店処理を実行しました（<a href="{{route('home')}}">顧客一覧画面に戻る</a>）</p>
                        <p>管理番号：{{ $info->number }}</p>
                        <p>区分：{{ App\Model\Customer::setDayInfoDisplay($info->day_info) }}</p>
                        <p>顧客属性：{{ App\Model\Customer::setMemberInfoDisplay($info->member_info) }}</p>
                        <p>ドリンクバー利用：{{ App\Model\Customer::setUseDrinkbarDisplay($info->use_drinkbar) }}</p>
                        <p>中学生以下：{{ App\Model\Customer::setUnderJrhighDisplay($info->under_jrhigh) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($info->type == 'exit_time')
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">処理実行ログ</div>
                    <div class="card-body">
                        <p>退店処理を実行しました（<a href="{{route('home')}}">顧客一覧画面に戻る</a>）</p>
                        <p>管理番号：{{ $info->number }}</p>
                        <p>料金：<span class="font-weight-bold h4">{{ $info->fee }}円</span></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endisset
    <!-- エラーのフラッシュ表示用 -->
    @if(session('enter_time_error'))
        <div class="alert alert-danger">
            {{ session('enter_time_error') }}
        </div>
    @endif
    @if(session('exit_time_error'))
        <div class="alert alert-danger">
            {{ session('exit_time_error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-header">入店管理</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'userManagement']) !!}
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('number', '管理番号(半角で入力)：', ['class' => 'd-block']) }}
                            {{ Form::number('number', 'value', ['class' => 'border-dark p-1']) }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('day_info-label', '属性情報(平日or休日)：', ['class' => 'd-block']) }}
                            <label>
                                {{ Form::radio('day_info', '1') }} 平日
                            </label>
                            <label>
                                {{ Form::radio('day_info', '2', true, ['class' => 'ml-3']) }} 休日
                            </label>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('member_info-label', '属性情報(相席orグループ)：', ['class' => 'd-block']) }}
                            <label>
                                {{ Form::radio('member_info', '1', true ) }} 相席
                            </label>
                            <label>
                                {{ Form::radio('member_info', '2', false, ['class' => 'ml-3']) }} グループ
                            </label>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('add_info', '追加情報：', ['class' => 'd-block']) }}
                            <label>
                                {{ Form::checkbox('use_drinkbar', '1', false ) }} ドリンクバー利用
                            </label>
                            <label>
                                {{ Form::checkbox('under_jrhigh', '1', false, ['class' => 'ml-3']) }} 中学生以下
                            </label>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('enter_time', '入店情報を確定 => ', ['class' => '']) }}
                            {{ Form::submit('入店処理実行', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'enter_time']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-header">退店管理</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'userManagement']) !!}
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('number', '管理番号(半角で入力)：', ['class' => 'd-block']) }}
                            {{ Form::number('number', 'value', ['class' => 'border-dark p-1']) }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            {{ Form::label('exit_time', '退店情報を確定 => ', ['class' => '']) }}
                            {{ Form::submit('退店処理実行', ['class' => 'btn btn-primary pl-4 pr-4', 'name' => 'exit_time']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">入店退店状況</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">番号</th>
                                    <th scope="col">入店時間</th>
                                    <th scope="col">退店時間</th>
                                    <th scope="col">顧客属性</th>
                                    <th scope="col">区分</th>
                                    <th scope="col">ドリンクバー</th>
                                    <th scope="col">中学生以下</th>
                                    <th scope="col">料金</th>
                                    <th scope="col">メモ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->number }}</td>
                                    <td>{{ $customer->enter_time }}</td>
                                    <td>{{ $customer->exit_time }}</td>
                                    <td>{{ $customer->setMemberInfoDisplay($customer->member_info) }}</td>
                                    <td>{{ $customer->setDayInfoDisplay($customer->day_info) }}</td>
                                    <td>{{ $customer->setUseDrinkbarDisplay($customer->use_drinkbar) }}</td>
                                    <td>{{ $customer->setUnderJrhighDisplay($customer->under_jrhigh) }}</td>
                                    <td>{{ $customer->fee }}</td>
                                    <td>{{ $customer->memo }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
