@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row" >
        <div class="col-md-12" style="height:500px;">
            <div class="card">
                <div class="card-header text-center"> Welcome Buddy! </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <router-view></router-view>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
