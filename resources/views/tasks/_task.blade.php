<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-3 pull-right text-right">
				<a class="btn btn-default" href="{{ route('tasks.edit', $task->id) }}" title="Edit Task">
					<span class="sr-only">Edit Task</span>
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>

				{!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put', 'style' => 'display:inline;']) !!}
					{!! Form::hidden('completed', 1) !!}
					<button class="btn btn-primary" type="submit" title="Task Complete">
						<span class="sr-only">Task Complete</span>
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					</button>
				{!! Form::close() !!}
			</div>

			<div class="col-sm-9">
				<span class="lead">
					@if($task->priority == App\Task::PRIORITY_NONE)
					<span class="text-muted"><span class="glyphicon glyphicon-star"></span></span>
					@elseif($task->priority == App\Task::PRIORITY_LOW)
					<span class="text-success"><span class="glyphicon glyphicon-star"></span></span>
					@elseif($task->priority == App\Task::PRIORITY_MEDIUM)
					<span class="text-warning"><span class="glyphicon glyphicon-star"></span></span>
					@elseif($task->priority == App\Task::PRIORITY_HIGH)
					<span class="text-danger"><span class="glyphicon glyphicon-star"></span></span>
					@endif

					<a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
				</span>
			</div>
		</div>
		@if(isset($moreInfo) and $moreInfo)
		<div class="row">
			<div class="col-sm-12">
				<br>
				@if($task->notes)
				<pre>{{ $task->notes }}</pre>
				@else
				<pre>(No notes)</pre>
				@endif

				<p>
					<small class="text-muted">
						@if($task->completed)
						Completed {{ $task->completed_at->diffForHumans() }}
						@else
						Created {{ $task->created_at->diffForHumans() }}
						@endif
					</small>
				</p>
			</div>
		</div>
		@endif
	</div>
</div>