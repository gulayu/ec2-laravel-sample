@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card" style="position: sticky; top: 60px">
                <div class="card-header">sidebar</div>
                <div class="card-body">
                    サイドバー
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" style="padding-bottom: 500px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" style="padding-bottom: 500px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
