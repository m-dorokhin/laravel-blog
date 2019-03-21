@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактор постов') }}</div>

                    <div class="card-body">
        <!-- Отображене ошибок проверки ввода -- >
        @ include('common.errors')-->

        <!-- Форма редактора постов -->
        <form action="{{ route('post_save') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="post" class="col-sm-3 control-label">Название</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="post-title" class="form-controll">
                </div>
            </div>

            <div class="form-group">
                <lable for="post" class="col-sm-3 control-label">Содержание</lable>

                <div class="col-sm-6">
                    <textarea type="text" name="text" id="post-text" class="form-control">
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <lable for="post" class="col-sm-3 control-label">Теги (Одна строчка один тег)</lable>

                <div class="col-sm-6">
                    <textarea type="text" name="tags" id="post-tags" class="form-control">
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Сохранить
                    </button>
                </div>
            </div>
        </form>
    </div>
                </div>
            </div>
        </div>
    </div>

@endsection