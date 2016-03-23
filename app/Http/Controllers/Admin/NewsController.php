<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;

class NewsController extends Controller {

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
		$news = News::orderBy('date','desc')->get();
		return view('admin.news.list' , ['news' => $news ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.news.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'contents'=>'required|min:10',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/news/create')
			->withInput()
			->withErrors($validator);
		}
		News::create([
			'date' => date('Y-m-d H:i:s'),
			'contents' => Input::get('contents')
		]);
		return redirect('admin/news/create')->with('success','News created');
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
		$news = News::findorFail($id);
		return view('admin.news.update')->with('news',$news);
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
			'contents'=>'required|min:10',
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/news/'.$id.'/edit')
			->withInput()
			->withErrors($validator);
		}
		$news = News::findorFail($id);
		$news->contents = Input::get('contents');
		if (Input::get('date')) {
			$news->date = date('Y-m-d H:i:s');
		}
		$news->save();
		return redirect('admin/news/'.$id.'/edit')->with('success',$id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$news = News::findorFail($id);
		$news->delete();
		return redirect('admin/news')->with('success', $news->id);
	}

}
