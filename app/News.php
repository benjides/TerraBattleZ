<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {
	protected $table = "news";
	protected $fillable = [
		'date','content',
	];
	protected $hidden = ['id'];
	protected $dates = ['date'];
	public $timestamps = false;
}
