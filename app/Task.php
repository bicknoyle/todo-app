<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	const PRIORITY_NONE    = 0;
	const PRIORITY_LOW     = 1;
	const PRIORITY_MEDIUM  = 2;
	const PRIORITY_HIGH    = 3;

	protected $fillable = ['title', 'priority', 'notes', 'completed'];

	public function getDates()
	{
		return ['completed_at', 'created_at', 'updated_at'];
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function scopeImportantFirst($query)
	{
		return $query->orderBy('priority', 'DESC')->orderBy('created_at');
	}

	public function scopeNotCompleted($query)
	{
		return $query->where('completed', 0);
	}

	public static function getAllowedPriorities()
	{
		return [
			self::PRIORITY_NONE    => 'None',
			self::PRIORITY_LOW     => 'Low',
			self::PRIORITY_MEDIUM  => 'Medium',
			self::PRIORITY_HIGH    => 'High',
		];
	}

}
