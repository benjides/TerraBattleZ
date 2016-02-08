<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Affection extends Model {
	protected $table = "affections";
	protected $fillable = [
		'affection',
	];
	protected $hidden = ['id'];
	public $timestamps = false;
	public function skills()
  {
    return $this->belongsToMany('App\JobSkill');
  }
}
