@extends('layout.layout')

@section('content')

    <h1>id = {{ $targetTask->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $targetTask->id }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $targetTask->content }}</td>
        </tr>
    </table>

    {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $targetTask->id], ['class' => 'btn btn-light']) !!}

    {!! Form::model($targetTask, ['route' => ['tasks.destroy', $targetTask->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection