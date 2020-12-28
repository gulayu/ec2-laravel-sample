@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header">管理画面使い方メモ</div>
                <div class="card-body">
                    <p>画面右上のユーザ名の部分をクリックするとメニューが表示されます。</p>
                    <p>ホーム　　　　　　・・・この画面です</br>
                        入退店管理　　　　・・・入店時処理、退店時処理を実行する画面です</br>
                        料金システム編集　・・・各プランの料金を変更できる画面です</br>
                    </p>
                </div>
            </div>
            
            @include('layouts/customerTable')
        </div>
    </div>
</div>
@endsection
