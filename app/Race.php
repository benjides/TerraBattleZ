<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model {
	protected $table = "races";
	protected $fillable = [
		'race',
	];
	protected $hidden = ['id'];
	public $timestamps = false;
	public function characters()
  {
    return $this->belongsToMany('App\Character');
  }
}
