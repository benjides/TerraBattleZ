<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Skill;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;
use Illuminate\Support\Facades\File;

class SkillController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$skills = Skill::orderBy('name','asc')->get();
		return view('admin.skills.list' , ['skills' => $skills ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.skills.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'name'=>'required|unique:skills',
			'description'=>'required',
		);
		if (Input::hasFile('icon')) {
			$rules['icon'] = 'required|image';
		}
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/skills/create')
			->withInput()
			->withErrors($validator);
		}

		$skill = new Skill();
		$skill->name = Input::get('name');
		$skill->description = Input::get('description');
		if (Input::hasFile('icon')) {
			$icon = Input::file('icon');
			$extension = $icon->getClientOriginalExtension();
			$name = strtolower(str_replace(' ', '_', Input::get('name'))).'.'.$extension;
			$icon->move( public_path().'/assets/content/skills', $name);
			$skill->icon = $name;
		}
		else{
			$skill->icon = Input::get('skill');
		}
		$skill->save();
		return redirect('admin/skills/create')->with('success',Input::get('name'));
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
		$skill = Skill::findorFail($id);
		return view('admin.skills.update')->with('skill',$skill);
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
			'name' => 'required|unique:skills,name,'.$id,
			'description'=>'required',
		);
		if (Input::hasFile('icon')) {
			$rules['icon'] = 'required|image';
		}
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/skills/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}
		$skill = Skill::findorFail($id);
		$skill->name = Input::get('name');
		$skill->description = Input::get('description');
		if (Input::hasFile('icon'))
		{
			$count = Skill::where('icon','=',$skill->icon)->count();
			if ($count == 1) {
				File::delete(public_path().'/assets/content/skills/'.$skill->icon);
			}
			$icon = Input::file('icon');
			$extension = $icon->getClientOriginalExtension();
			$name = strtolower(str_replace(' ', '_', Input::get('name'))).'.'.$extension;
			$icon->move( public_path().'/assets/content/skills', $name);
			$skill->icon = $name;
		}
		else
		{
			$skill->icon = Input::get('skill');
		}

		$skill->save();
		return redirect('admin/skills/'.$id.'/edit')->with('success',Input::get('name'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$skill = Skill::findorFail($id);
		$skill->delete();
		$count = Skill::where('icon','=',$skill->icon)->count();
		if($count == 0) {
			File::delete(public_path().'/assets/content/skills/'.$skill->icon);
		}
		return redirect('admin/skills')->with('success', $skill->name);
	}

}
