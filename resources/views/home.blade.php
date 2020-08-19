@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">入退店状況</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
