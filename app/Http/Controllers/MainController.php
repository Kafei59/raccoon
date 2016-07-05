<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Work;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $work = new Work();
            $work->name = "Lead developer";
            $user->work = $work;
        }

        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('index', array('tasks' => $tasks, 'user' => $user));
    }
}