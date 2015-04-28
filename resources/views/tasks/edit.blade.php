@extends('app')

@section('content')
	<h2>Edit Task</h2>

	@include('errors.list', ['errors' => $errors])

	{!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}
		@include('tasks._form', ['submitButton' => 'Save Task'])
	{!! Form::close() !!}

	{!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
		<div class="form-group">
			<button class="btn btn-danger" type="submit">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				Delete Task
			</button>
		</div>
	{!! Form::close() !!}
@endsection