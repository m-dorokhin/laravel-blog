@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($posts as $post)
                        <div style="border-width: 1px; border-style: solid; border-color: gray; border-radius: 5px; margin: 10px;">
                            <div style="margin: 10px;"><a href="{{ route('post', ['id' => $post->id]) }}"><p>{{$post->title}}</p></a>{{$post->created_at}} <i>{{$post->user->name}}</i></div>
                        </div>
                    @empty
                        <p>Нет ниодного поста!</p>
                    @endforelse

                    @if ($page > 1)
                        <a href="{{ route('home', ['page' => 1]) }}"><<</a>
                        <a href="{{ route('home', ['page' => $page - 1]) }}"><</a>
                    @endif
                    {{$page}}/{{$count}}
                    @if ($page < $count)
                        <a href="{{ route('home', ['page' => $page + 1]) }}">></a>
                        <a href="{{ route('home', ['page' => $count]) }}">>></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
