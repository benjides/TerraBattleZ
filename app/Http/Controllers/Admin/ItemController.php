<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;
use Illuminate\Support\Facades\File;

class ItemController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::orderBy('name','asc')->get();
		return view('admin.items.list' , ['items' => $items ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.items.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'name'=>'required|unique:items',
			'description'=>'required',
			'icon'=>'required|image',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/items/create')
			->withInput()
			->withErrors($validator);
		}
		$icon = Input::file('icon');
		$extension = $icon->getClientOriginalExtension();
		$name = strtolower(str_replace(' ', '_', Input::get('name'))).'.'.$extension;
		$icon->move( public_path().'/assets/content/items', $name);
		Item::create([
			'name' => Input::get('name'),
			'description' => Input::get('description'),
			'icon' => $name
		]);
		return redirect('admin/items/create')->with('success',Input::get('name'));
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
		$item = Item::findorFail($id);
		return view('admin.items.update')->with('item',$item);
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
			'name'=>'required|unique:items,name,'.$id,
			'description'=>'required',
		);
		if (Input::hasFile('icon')) {
			$rules['icon'] = 'required|image';
		}
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/items/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}
		$item = Item::findorFail($id);
		$item->name = Input::get('name');
		$item->description = Input::get('description');
		if (Input::hasFile('icon')) {
			File::delete(public_path().'/assets/content/items/'.$item->icon);
			$icon = Input::file('icon');
			$extension = $icon->getClientOriginalExtension();
			$name = strtolower(str_replace(' ', '_', Input::get('name'))).'.'.$extension;
			$icon->move( public_path().'/assets/content/items', $name);
			$item->icon = $name;
		}else{
			$array = explode('.', $item->icon);
			$extension = end($array);
			$name = strtolower(str_replace(' ', '_', Input::get('name'))).'.'.$extension;
			File::move( public_path().'/assets/content/items/'.$item->icon, public_path().'/assets/content/items/'.$name );
			$item->icon = $name;
		}
		$item->save();
		return redirect('admin/items/'.$id.'/edit')->with('success',Input::get('name'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		File::delete(public_path().'/assets/content/items/'.$item->icon);
		$item = Item::findorFail($id);
		$item->delete();
		return redirect('admin/items')->with('success', $item->name);
	}

}
