@extends('layouts.app')

@section('content')
<div class="container">
    <!-- ログ表示用 -->
    @isset($info)
        @if($info->res == 'ok')
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">料金変更ログ</div>
                    <div class="card-body">
                        <p class="font-weight-bold">料金システムを変更しました</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endisset
    <!-- バリデーションエラー表示用 -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">現在の料金システム</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">種別</th>
                                    <th scope="col">最初の2時間</th>
                                    <th scope="col">延長1時間</th>
                                    <th scope="col">最大料金</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($feePlans as $feePlan)
                                <tr>
                                    <td>{{ $feePlan->setTypeDisplay($feePlan->type) }}</td>
                                    <td>{{ $feePlan->first_2h_fee }}</td>
                                    <td>{{ $feePlan->extension_1h_fee }}</td>
                                    <td>{{ $feePlan->max_fee }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">料金システムの編集</div>
                <div class="card-body">
                    <p class="text-danger">（注意!!）各料金の値は精算時の計算に使用されるものなので間違いが起きないように注意してください。</p>
                    {!! Form::open(['route' => 'feeSystem_update']) !!}
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">種別</th>
                                    <th scope="col">最初の2時間</th>
                                    <th scope="col">延長1時間</th>
                                    <th scope="col">最大料金</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($feePlans as $feePlan)
                                <tr>
                                    <td>{{ $feePlan->setTypeDisplay($feePlan->type) }}</td>
                                    <td>{{ Form::number($feePlan->setFirst2hFeeFormDisplay($feePlan->type), $feePlan->first_2h_fee) }}</td>
                                    <td>{{ Form::number($feePlan->setExtension1hFeeFormDisplay($feePlan->type), $feePlan->extension_1h_fee) }}</td>
                                    <td>{{ Form::number($feePlan->setMaxFeeFormDisplay($feePlan->type), $feePlan->max_fee) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mb-4">
                        {{ Form::submit('料金を変更', ['class' => 'btn btn-primary pl-4 pr-4']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
