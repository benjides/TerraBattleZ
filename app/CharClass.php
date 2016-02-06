<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CharClass extends Model {
	protected $table = "char_classes";
	protected $fillable = [
		'class',
		'order_key',
	];
	protected $hidden = ['id','order_key'];
	public $timestamps = false;

	public function characters()
  {
    return $this->belongsToMany('App\Character');
  }
}
