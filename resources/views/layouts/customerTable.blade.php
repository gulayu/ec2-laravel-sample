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
                        <th scope="col"></th>
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
                        <td>
                            <a class="btn btn-info text-white" href="{{route('userEditEntry', ['number' => $customer->number])}}" role="button">編集</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>    
</div>