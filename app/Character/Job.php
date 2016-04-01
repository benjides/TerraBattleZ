<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

	protected $fillable = [
		'number',
    'name',
		'art',
		'element',
		'weapon',
		'minHP',
		'maxHP',
		'minATK',
		'maxATK',
		'minDEF',
		'maxDEF',
		'minMATK',
		'maxMATK',
		'minMDEF',
		'maxMDEF',
		'coins',
  ];
  protected $hidden = ['id','number','created_at','updated_at','character_id'];

	public function character()
  {
    return $this->belongsTo('App\Character');
  }

	public function skills()
	{
		return $this->hasMany('App\JobSkill');
	}

	public function items()
	{
		return $this->hasMany('App\JobItem');
	}

}
