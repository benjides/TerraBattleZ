<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model {
	protected $table='skills';
	protected $fillable = [
		'name',
		'description',
		'icon',
	];
	protected $hidden = ['id','created_at','updated_at'];

	public function characters()
  {
    return $this->hasManyThrough('App\Character', 'App\JobSkill' ,'skill_name');
  }
	public function jobs()
	{
		return $this->hasMany('App\JobSkill','skill_name','name');
	}
}
