@extends('layout.layout')

@section('content')

    <h1>作成ページ</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($createTask, ['route' => 'tasks.store']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'メッセージ:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('タスク登録', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection