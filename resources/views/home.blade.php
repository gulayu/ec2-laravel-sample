@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">入退店状況</div>

                <div class="card-body" style="padding-bottom: 500px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    入退店状況
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
