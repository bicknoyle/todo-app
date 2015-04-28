@extends('app')

@section('content')
<h2>Open Tasks</h2>
@include('errors.list', ['errors' => $errors])
@if(count($tasks))
<ul class="list-unstyled">
@foreach($tasks as $task)
	<li>
		@include('tasks._task', ['task' => $task])
	</li>
@endforeach
</ul>
@else
<p class="lead">None! Are you sure you have nothing to do??</p>
@endif

<h2>Add Task</h2>
{!! Form::open(['route' => 'tasks.store']) !!}
	{!! Form::hidden('priority', 0) !!}
	<div class="form-group">
		<div class="input-group">
			{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Task title']) !!}
			<div class="input-group-btn">
				<button type="button" class="btn btn-default dropdown-toggle priorities" data-toggle="dropdown" aria-expanded="false"><span class="dropdown-label">Priority</span> <span class="caret"></span></button>
				<ul class="dropdown-menu priorities" role="menu">
					<li><a href="#" data-value="0"><span class="text-muted">None</span></a></li>
					<li><a href="#" data-value="1"><span class="text-success">Low</span></a></li>
					<li><a href="#" data-value="2"><span class="text-warning">Medium</span></a></li>
					<li><a href="#" data-value="3"><span class="text-danger">High</span></a></li>
				</ul>
				<button class="btn btn-primary" type="submit">Add Task</button>
			</div>
		</div>
	</div>
{!! Form::close() !!}

<div class="panel panel-default">
	<div class="panel-heading">Recently Completed</div>
	<div class="panel-body">
		@if(count($completedTasks))
		<ul>
		@foreach($completedTasks as $task)
			<li>
				{{ $task->title }}<br>
				<small class="text-muted">Completed {{ $task->completed_at->diffForHumans() }}</small>
			</li>
		@endforeach
		</ul>
		@else
		<p>You haven't completed any tasks. Add some tasks and complete them you lazy bum.</p>
		@endif
	</div>
</div>
@endsection
@section('js')
<script>
	$('.dropdown-menu.priorities a').on('click', function(e){
		var _self = $(this)
		  , label = $('.dropdown-toggle.priorities .dropdown-label')

		$('input[name="priority"]').val(_self.data('value'))
		label.html(_self.html())
	})
</script>
@endsection