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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
