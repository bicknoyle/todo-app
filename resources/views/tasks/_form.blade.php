<div class="form-group">
	{!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('priority', 'Priority:') !!}
	{!! Form::select('priority', App\Task::getAllowedPriorities(), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('notes', 'Notes:') !!}
	{!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>