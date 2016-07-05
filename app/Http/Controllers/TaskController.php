<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', array('tasks' => $tasks, 'user' => $user));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'name' => "required|max:255"
        ));

        if ($validator->fails()) {
            return redirect('/')->withInput()->withErrors($validator);
        }

        // TODO: put this into services or manager
        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    }

    public function delete($id)
    {
        Task::findOrFail($id)->delete();

        return redirect('/');
    }
}