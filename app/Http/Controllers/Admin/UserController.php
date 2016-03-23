<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;


class UserController extends Controller {

	public function __construct()
	 {
			$this->middleware('admin',['only'=>['edit','update','destroy']]);
	 }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('admin','desc')->get();
		return view('admin.users.list' , ['users' => $users ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'username'=>'required|unique:users',
			'password'=>'required|min:6',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/users/create')
			->withInput(Input::except('password'))
			->withErrors($validator);
		}
		User::create([
    	'username' => Input::get('username'),
			'admin'    => false,
    	'password' => bcrypt(Input::get('password')),
    ]);
		return redirect('admin/users/create')->with('success',Input::get('username'));
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
		$user = User::findorFail($id);
		$user->delete();
		return redirect('admin/users')->with('success', $user->username);
	}

}
