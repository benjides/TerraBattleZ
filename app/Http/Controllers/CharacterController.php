<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Character;
use App\CharClass;

use Illuminate\Http\Request;



class CharacterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$classes = CharClass::orderBy('order_key','desc')->get();
		foreach ($classes as $class) {
			$characters[$class->class] = Character::where('class','=',$class->class)
																							->where('adventurer','=',true)
																							->orderBy('name','asc')
																							->get();
		}
		return view('rooster' , ['classes' => $characters ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($name)
	{
	  $character = Character::where('name', $name)->first();
		$jobs = $character->jobs()->orderBy('number','asc')->get();
		foreach ($jobs as $job) {
			$skills = $job->skills()->orderBy('lvl','asc')->get();
			$items = $job->items()->orderBY('quantity','asc')->get();
			$job['skills'] = $skills;
			$job['items'] = $items;
			$jobarray[] = $job;
		}
		$character['jobs'] = $jobarray;
		$iterations = $character->iterations()->get();
		$character['iterations'] = $iterations;
		//return $character;
		return view('character')->with('character', $character);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
