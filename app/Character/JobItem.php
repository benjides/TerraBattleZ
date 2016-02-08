<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class JobItem extends Model {
	protected $table='job_items';
	protected $fillable = [
		'quantity',
		'item_name',
		'job_id',
	];
	protected $hidden = ['id','job_id','created_at','updated_at'];
	public function job()
	{
		return $this->belongsTo('App/Job');
	}
	public function item()
	{
		return $this->belongTo('App/Item');
	}
}
