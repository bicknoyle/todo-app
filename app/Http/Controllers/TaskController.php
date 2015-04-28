<?php namespace App\Http\Controllers;

use Auth;
use Redirect;
use View;

use App\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Auth::user()->tasks()->notCompleted()->importantFirst()->get();
		$completedTasks = Auth::user()->tasks()->where('completed', true)->orderBy('completed_at', 'DESC')->limit(3)->get();

		return View::make('tasks.index', compact('tasks', 'completedTasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TaskRequest $request)
	{
		$task = new Task($request->all());

		Auth::user()->tasks()->save($task);

		return Redirect::route('tasks.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $task
	 * @return Response
	 */
	public function show(TaskRequest $request, Task $task)
	{
		return View::make('tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $task
	 * @return Response
	 */
	public function edit(TaskRequest $request, Task $task)
	{
		return View::make('tasks.edit', compact('task'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $task
	 * @return Response
	 */
	public function update(TaskRequest $request, Task $task)
	{
		// add completed_at timestamp
		if(!$task->completed and $request->get('completed')) {
			$task->completed_at = Carbon::now();
		}

		$task->update($request->all());

		return Redirect::route('tasks.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $task
	 * @return Response
	 */
	public function destroy(TaskRequest $request, Task $task)
	{
		$task->delete();

		return Redirect::route('tasks.index');
	}
}
