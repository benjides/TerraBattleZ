<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {
	protected $table='characters';
  protected $fillable = [
    'name',
		'savename',
		'icon',
    'class',
    'race',
		'gender',
    'pot',
    'pof',
    'adventurer'
  ];
  protected $hidden = ['id','savename','created_at','updated_at','recode_id'];
	protected $casts = [
		'pot' => 'boolean',
		'pof' => 'boolean',
		'adventurer' => 'boolean'
	];

  public function jobs()
  {
    return $this->hasMany('App\Job');
  }
	public function interactions()
	{
		return $this->hasMany('App\Interaction');
	}
	public function className()
	{
		return $this->hasOne('App\CharClass' , 'order_key','class');
	}
	public function recode()
	{
		//return $this->hasOne('App\Character');
	}
}
