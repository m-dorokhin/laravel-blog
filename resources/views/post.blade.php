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

            @if (Auth::check())
                <div class="col-md-8" style="margin: 8px;">
                    <div class="card">
                        <div class="card-header">{{ __('Коментировать')  }}</div>
                        <div class="card-body">
                            <!-- Форма редактора постов -->
                            <form action="{{ route('comment') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="post_id" id="post-id" value="{{ $post->id }}"/>

                                <div class="form-group">
                                    <lable for="task" class="col-sm-3 control-label">{{ __('Коментарий') }}</lable>

                                    <div class="col-sm-6">
                                        <textarea type="text" name="text" id="task-text" class="form-control">
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-plus"></i> {{ __('Добавить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-md-8" style="margin: 8px;">
                <div class="card">
                    <div class="card-header">{{ __('Коментарии') }}</div>
                    <div class="card-body">
                        @foreach($post->comments as $comment)
                            <div style="border-width: 1px; border-style: solid; border-color: gray; border-radius: 5px; margin: 10px; padding: 5px;">
                                <p>{{ $comment->text }}</p>
                                {{ $comment->created_at }}<i>{{ $comment->user->name }}</i>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection