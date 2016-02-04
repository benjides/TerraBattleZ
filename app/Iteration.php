<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Iteration extends Model {
	protected $table='iterations';
  protected $fillable = [
    'trigger',
		'content',
    'character_id',
		'trigger_id',
  ];
  protected $hidden = ['id','created_at','updated_at','character_id','trigger_id'];

  public function character()
  {
    return $this->hasBelongsTo('App\Character');
  }
}
