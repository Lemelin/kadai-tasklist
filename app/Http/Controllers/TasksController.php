<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Model追加
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTasks = Task::all();

        return view('index', ['viewTasks' => $allTasks,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $addTaskInstance = new Task;

        return view('create', ['createTask' => $addTaskInstance,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'status' =>'required|max:10',
        ]);
        
        $taskInsertInstance = new Task;
        $taskInsertInstance->status = $request->status;
        $taskInsertInstance->content = $request->content;
        $taskInsertInstance->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selectTask = Task::findOrFail($id);

        return view('show', ['targetTask' => $selectTask,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editTaskInstance = Task::findOrFail($id);

        return view('edit', ['editTargetTask' => $editTaskInstance,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'status' =>'required|max:10',
        ]);
        
        $taskUpdateInstance = Task::findOrFail($id);
        $taskUpdateInstance->status = $request->status;
        $taskUpdateInstance->content = $request->content;
        $taskUpdateInstance->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taskDeleteInstance = Task::findOrFail($id);

        $taskDeleteInstance->delete();


        return redirect('/');
    }
}
