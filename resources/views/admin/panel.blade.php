@extends('layouts.admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Admin Dashboard</h1>

                @php
                    $dailyFun = [
                        "The first computer mouse was made of wood.",
                        "The first domain name ever registered was Symbolics.com.",
                        "Did you know? A single Google query uses 1,000 computers in 0.2 seconds to retrieve an answer.",
                        "The first game ever developed was Pong in 1972.",
                        "Time for a coffee? The first webcam was created to check the status of a coffee pot at Cambridge University.",
                    ];
                    $randomFun = $dailyFun[array_rand($dailyFun)];
                @endphp

                <div class="alert alert-secondary mt-4">
                    <h5>Did You Know?</h5>
                    <p>{{ $randomFun }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
