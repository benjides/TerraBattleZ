<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model {
	protected $table='job_skills';
	protected $fillable = [
		'lvl',
		'skill_name',
		'affection',
		'frequency',
		'job_id',
	];
	protected $hidden = ['id','job_id','created_at','updated_at'];
	public function job()
	{
		return $this->belongsTo('App/Job');
	}
	public function skill()
	{
		return $this->belongsTo('App/Skill');
	}
}
