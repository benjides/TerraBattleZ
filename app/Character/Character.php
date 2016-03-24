<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {
	protected $table='characters';
  protected $fillable = [
    'name',
		'savename',
    'class',
    'race',
    'pot',
    'pof',
    'adventurer'
  ];
  protected $hidden = ['id','created_at','updated_at','recode_id'];

  public function jobs()
  {
    return $this->hasMany('App\Job');
  }
	public function iterations()
	{
		return $this->hasMany('App\Iteration');
	}
	public function recode()
	{
		//return $this->hasOne('App\Character');
	}
}
