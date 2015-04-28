@extends('app')

@section('content')
	@include('tasks._task', ['task' => $task, 'moreInfo' => true])
@endsection