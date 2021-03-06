@extends('layout.layout')

@section('content')

    <h1>タスク一覧</h1>
    
    @if (count($viewTasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                    <th>状態</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewTasks as $eachTask)
             
                <tr>
                    <td>{!! link_to_route('tasks.show', $eachTask->id, ['task' => $eachTask->id]) !!}</td>
                    <td>{{ $eachTask->content }}</td>
                    <td>{{ $eachTask->status }}</td>
                </tr>
                
                @endforeach
                
            </tbody>
        </table>
    @endif
    {{ $viewTasks->links() }}
    {{-- 作成ページへのリンク --}}
    {!! link_to_route('tasks.create', '新規タスクの登録', [], ['class' => 'btn btn-primary']) !!}

@endsection