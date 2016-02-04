<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	protected $table = "items";
	protected $fillable = [
		'name',
		'description',
		'icon',
	];
	protected $hidden = ['id','created_at','updated_at'];

	public function characters()
  {
    return $this->hasManyThrough('App\Character', 'App\JobItem');
  }
}
