@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ $post->title }}</h1></div>
                    <div class="card-body">
                        <p>{{ $post->created_at }} <i>{{ $post->user->name }}</i></p>
                        <p>{{ $post->text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection