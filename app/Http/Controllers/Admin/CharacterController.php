<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Character;
use App\CharClass;
use App\Race;
use App\Skill;
use App\Item;
use App\Affection;

use Auth;

use Illuminate\Http\Request;

use Validator;
use Input;
use App\JobSkill;
use App\JobItem;
use App\Job;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class CharacterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$characters = Character::orderBy('class','desc')->get();
		foreach ($characters as $character) {
			$character->class = $character->className()->first()->class;
		}
		return view('admin.characters.list' , ['characters' => $characters ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$data['classes'] = CharClass::orderBy('order_key','desc')->get();
		$data['races'] = Race::orderBy('race','asc')->get();
		$data['items'] = Item::orderBy('name','asc')->get();
		$data['skills'] = Skill::orderBy('name','asc')->get();
		$data['affections'] = Affection::orderBy('affection','asc')->get();
		$data = new Collection( $data );
		return view('admin.characters.create')->with('data',$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'=>'required|unique:characters',
			'icon' => 'required|image'
		);
		$validator=Validator::make(Input::all(),$rules);
		if ($validator->fails())
		{
			return redirect('admin/characters/create')
							->withInput()
							->withErrors($validator);
		}

		$character = new Character();
		$character->name = Input::get('name');
		$character->savename = strtolower( preg_replace("/[^a-zA-Z]+/", "", Input::get('name')) );
		$character->class = Input::get('class');
		$character->class = Input::get('class');
		$character->race = Input::get('race');
		$character->gender = Input::get('gender');
		$character->pot = Input::get('pot');
		$character->pof = Input::get('pof');
		$character->adventurer = Input::get('adventurer');

		$icon = Input::file('icon');
		$extension = $icon->getClientOriginalExtension();
		$icon->move( public_path().'/assets/characters/'.$character->savename , 'icon.'.$extension);

		$character->icon = 'icon.'.$extension;

		$character->save();

		// Jobs
		for ($i=1; $i < 4 ; $i++) {
			if (Input::get('jobInput'.$i) == 1) {
				$rules = array(
					'name'.$i => 'required',
					'artj'.$i => 'required|image',
					'minHP'.$i => 'required|numeric',
					'maxHP'.$i => 'required|numeric',
					'minATK'.$i => 'required|numeric',
					'maxATK'.$i => 'required|numeric',
					'minDEF'.$i => 'required|numeric',
					'maxDEF'.$i => 'required|numeric',
					'minMATK'.$i => 'required|numeric',
					'maxMATK'.$i => 'required|numeric',
					'minMDEF'.$i => 'required|numeric',
					'maxMDEF'.$i => 'required|numeric',
				);
				$validator=Validator::make(Input::all(),$rules);
				if ($validator->fails())
				{
					$character->delete();
					File::deleteDirectory(public_path().'/assets/characters/'.$character->savename);
					return redirect('admin/characters/create')
									->withInput()
									->withErrors($validator);
				}
				$job = new Job();
				$job->number = $i;
				$job->name = Input::get('name'.$i);
				$job->element = Input::get('element'.$i);
				$job->weapon = Input::get('weapon'.$i);
				$job->minHP = Input::get('minHP'.$i);
				$job->maxHP = Input::get('maxHP'.$i);
				$job->minATK = Input::get('minATK'.$i);
				$job->maxATK = Input::get('maxATK'.$i);
				$job->minDEF = Input::get('minDEF'.$i);
				$job->maxDEF = Input::get('maxDEF'.$i);
				$job->minMATK = Input::get('minMATK'.$i);
				$job->maxMATK = Input::get('maxMATK'.$i);
				$job->minMDEF = Input::get('minMDEF'.$i);
				$job->maxMDEF = Input::get('maxMDEF'.$i);
				$job->coins = Input::get('coins'.$i);

				$jobart = Input::file('artj'.$i);
				$extension = $jobart->getClientOriginalExtension();
				$jobart->move( public_path().'/assets/characters/'.$character->savename , 'job'.$i.'.'.$extension);
				$job->art = 'job'.$i.'.'.$extension;

				$character->jobs()->save($job);
				// Skills
				for ($j=1; $j < 5 ; $j++) {
					if (Input::get('j'.$i.'lvl'.$j) != null) {
						$rules = array(
							'j'.$i.'lvl'.$j => 'required|numeric',
							'j'.$i.'skill'.$j => 'required',
							'j'.$i.'affection'.$j => 'required',
							'j'.$i.'freq'.$j => 'numeric'
						);
						$validator=Validator::make(Input::all(),$rules);
						if ($validator->fails())
						{
							$character->delete();
							File::deleteDirectory(public_path().'/assets/characters/'.$character->savename);
							return redirect('admin/characters/create')
											->withInput()
											->withErrors($validator);
						}
						$skill = new JobSkill();
						$skill->lvl = Input::get('j'.$i.'lvl'.$j);
						$skill->skill_name = Input::get('j'.$i.'skill'.$j);
						$skill->affection = Input::get('j'.$i.'affection'.$j);
						$skill->frequency = Input::get('j'.$i.'freq'.$j);
						$job->skills()->save($skill);
					}
				}
				// Items
				for ($j=1; $j < 4 ; $j++) {
					if ($i != 1) {
						$rules = array(
							'j'.$i.'item'.$j => 'required',
							'j'.$i.'quantity'.$j => 'required|numeric'
						);
						$validator=Validator::make(Input::all(),$rules);
						if ($validator->fails())
						{
							$character->delete();
							File::deleteDirectory(public_path().'/assets/characters/'.$character->savename);
							return redirect('admin/characters/create')
											->withInput()
											->withErrors($validator);
						}
						$item = new JobItem();
						$item->item_name = Input::get('j'.$i.'item'.$j);
						$item->quantity = Input::get('j'.$i.'quantity'.$j);
						$job->items()->save($item);
					}
				}

			}
		}

		return redirect('admin/characters/create')->with('success',Input::get('name'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($name)
	{

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
		$character= Character::findorFail($id);
		File::deleteDirectory(public_path().'/assets/characters/'.$character->savename);
		$character->delete();
		return redirect('admin/characters')->with('success', $character->name);
	}

}
