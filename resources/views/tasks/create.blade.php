@extends('app')

@section('content')
	<h1>Create Task</h1>

	@include('errors.list', ['errors' => $errors])

	{!! Form::open(['route' => 'tasks.store']) !!}
		@include('tasks._form', ['submitButton' => 'Add Task'])
	{!! Form::close() !!}
@endsection