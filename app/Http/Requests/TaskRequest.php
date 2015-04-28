<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaskRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$task = $this->route('tasks');

		// if task is bound to route, require owner
		if($task) {
			return $task->user_id == $this->user()->id;
		}
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$method = $this->method();
		if('PUT' == $method) {
			return [
				'title' => 'min:5|max:255',
				'completed' => 'boolean'
			];
		}
		elseif('POST' == $method) {
			return [
				'title' => 'required|min:5|max:255',
				'completed' => 'boolean'
			];
		}

		return [];
	}

}
