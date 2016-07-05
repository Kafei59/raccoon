@extends('layouts.app')

@section('content')
    <div class="panel-body">
        @if ($user)
            <h1>Welcome {{ $user->name }}</h1>
            <h3>Job: {{ $user->work->name }}</h3>
            <h3>Task: {{ $user->tasks{0}->name }}</h3>
        @else
            <h1>Welcome stranger</h1>
            <h3>You can log in <a href="{{ url('/auth/login') }}">here</a> or register <a href="{{ url('/auth/register') }}">here</a></h3>
        @endif

        @role('admin')
            <h4>And you are an admin !</h4>
        @endrole

        @include('forms.task')

        @if (count($tasks) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td>
                                    <form action="/task/{{ $task->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete Task</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection