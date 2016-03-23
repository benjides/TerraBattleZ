<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Affection;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;

class AffectionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$affections = Affection::orderBy('affection','asc')->get();
		return view('admin.affections.list' , ['affections' => $affections ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.affections.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'affection'=>'required|unique:affections',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/affections/create')
			->withInput()
			->withErrors($validator);
		}
		Affection::create([
    	'affection' => Input::get('affection')
    ]);
		return redirect('admin/affections/create')->with('success',Input::get('affection'));
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
		$affection = Affection::findorFail($id);
		return view('admin.affections.update')->with('affection',$affection);
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
			'affection'=>'required|unique:affections',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/affections/'.$id.'/edit')
			->withInput()
			->withErrors($validator);
		}
		$affection = Affection::findorFail($id);
		$affection->affection = Input::get('affection');
		$affection->save();
		return redirect('admin/affections/'.$id.'/edit')->with('success',Input::get('affection'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$affection = Affection::findorFail($id);
		$affection->delete();
		return redirect('admin/affections')->with('success', $affection->affection);
	}

}
