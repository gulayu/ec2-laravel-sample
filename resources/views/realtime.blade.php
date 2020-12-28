@extends('layouts.app_public')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header">現在の店内状況</div>
                <div class="card-body">
                    <p>相席：{{$soloPlayersCount}}</p>
                    <p>グループ：{{$groupPlayersCount}}</p>
                    <br>
                    <p>当店の詳しい情報については<a href="https://bgshop-flyer.com/" target="_blank">ホームページ</a>をご確認下さい。</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card mb-5">
                        <a class="twitter-timeline" href="https://twitter.com/bg_flyer?ref_src=twsrc%5Etfw">Tweets by bg_flyer</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>
@endsection
