<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CharClass;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;

class ClassController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$classes = CharClass::orderBy('order_key','desc')->get();
		return view('admin.classes.list' , ['classes' => $classes ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.classes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'class'=>'required|unique:char_classes',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/classes/create')
			->withInput()
			->withErrors($validator);
		}
		$max = CharClass::max('order_key') + 1;
		CharClass::create([
    	'class' => Input::get('class'),
			'order_key' => $max
    ]);
		return redirect('admin/classes/create')->with('success',Input::get('class'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string $class
	 * @return Response
	 */
	public function show($class)
	{
		$characters[$class] = Character::where('class','=',$class)
						 											  ->where('adventurer','=',true)
						 												->orderBy('name','asc')
						 												->get();
		return view('rooster' , ['classes' => $characters ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$class = CharClass::findorFail($id);
		return view('admin.classes.update')->with('class',$class);
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
			'class'=>'required|unique:char_classes',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/classes/'.$id.'/edit')
			->withInput()
			->withErrors($validator);
		}
		$class = CharClass::findorFail($id);
		$class->class = Input::get('class');
		$class->save();
		return redirect('admin/classes/'.$id.'/edit')->with('success',Input::get('class'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$class = CharClass::findorFail($id);
		$class->delete();
		return redirect('admin/classes')->with('success', $class->class);
	}

}
