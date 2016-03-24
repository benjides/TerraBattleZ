<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Race;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;

class RaceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$races = Race::orderBy('race','asc')->get();
		return view('admin.races.list' , ['races' => $races ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.races.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'race'=>'required|unique:races',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/races/create')
			->withInput()
			->withErrors($validator);
		}
		Race::create([
    	'race' => Input::get('race')
    ]);
		return redirect('admin/races/create')->with('success',Input::get('race'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$race = Race::findorFail($id);
		return view('admin.races.update')->with('race',$race);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules=array(
			'race'=>'required|unique:races',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/races/'.$id.'/edit')
			->withInput()
			->withErrors($validator);
		}
		$race = Race::findorFail($id);
		$race->race = Input::get('race');
		$race->save();
		return redirect('admin/races/'.$id.'/edit')->with('success',Input::get('race'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$race = Race::findorFail($id);
		$race->delete();
		return redirect('admin/races')->with('success', $race->race);
	}

}
