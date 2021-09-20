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
        if (\Auth::check()) {

        $user = \Auth::user();
        $allTasks = $user->modelTasks()->orderBy('created_at', 'desc')->paginate(10);
        return view('index', ['viewTasks' => $allTasks,]);
        }
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (\Auth::check()) {

        $addTaskInstance = new Task;
        
        return view('create', ['createTask' => $addTaskInstance,]);
        }
        return view('welcome');
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
        
        /*
        $taskInsertInstance = new Task;
        $taskInsertInstance->status = $request->status;
        $taskInsertInstance->content = $request->content;
        $taskInsertInstance->save();
        */
        $request->user()->modelTasks()->create([
            'status' => $request->status,
            'content' => $request->content,
        ]);
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\Auth::check()) {
        $selectTask = Task::findOrFail($id);

        return view('show', ['targetTask' => $selectTask,]);
        }
        return view('welcome');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::check()) {
        $editTaskInstance = Task::findOrFail($id);

        return view('edit', ['editTargetTask' => $editTaskInstance,]);
        }
        return view('welcome');
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
