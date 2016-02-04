@extends('layouts.master')

@section('title', $character->name)

@section('css')
  <link href="{{ asset('/css/zoom.css') }}" rel="stylesheet">
@endsection
@section('js')
  <script src="{{ asset('js/zoom.js')}}"></script>
@endsection


@section('content')
  <?php
    use Faker\Factory as Faker;
    $faker = Faker::create();
  ?>
  <div class="container">

    <ol class="breadcrumb">
      <li><a href="{{url('/characters')}}">All Characters</a></li>
      <li><a href="{{url('/class' , $character['class'])}}">{{$character['class']}}</a></li>
      <li class="active">{{$character['name']}}</li>
    </ol>

    <div class="col-xs-12 base-info">
      <div class="col-xs-4 col-md-2">
        <img class="icon-img" src="{{ $faker->imageUrl(100, 100, 'abstract', true) }}" alt="{{$character->name}}" >
      </div>
      <div class="col-xs-8 col-md-10">
        <h1>{{$character->name}}</h1>
        <p>
          Class : {{$character->class}}
          <br>
          Race :{{$character->race}}
        </p>
        <p>
          Pact of Truth : {{$character->pot}}<?php //echo $pot == 1 ? "Yes" : "No"; ?>
          <br>
          Pact of Fellowship : <?php //echo $pof == 1 ? "Yes" : "No"; ?>
        </p>
      </div>
    </div>
    <div class="col-xs-12 jobs wraper">
      <h4>Jobs:</h4>
    @foreach($character->jobs as $job)
      <div class="col-xs-12 col-md-4 job-element">
        <h4>
          <img class="weapon-img" src="assets/icons/weapon/'.$Weapon.'.png"/>
          {{$job->name}}
          <img class="elem-img" src="assets/icons/element/'.$Element.'.png"  />
        </h4>
        <div class="job-img-wraper">
          <img class="job-img"
          data-action="zoom"
          src="{{$faker->imageUrl(350,400, 'abstract', true)}}"
          alt="{{$job->name}}" />
        </div>
        <p class="text-center">
          <a href="{{url('compare',$job->name)}}">Compare</a>
        </p>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Stats</th><th>Lvl 1</th><th>Lvl 90</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>HP</td>
              <td>{{$job['minHP']}}</td>
              <td><strong>{{$job['maxHP']}}</strong></td>
            </tr>
            <tr>
              <td>ATK</td>
              <td>{{$job['minATK']}}</td>
              <td><strong>{{$job['maxATK']}}</strong></td>
            </tr>
            <tr>
              <td>DEF</td>
              <td>{{$job['minDEF']}}</td>
              <td><strong>{{$job->maxDEF}}</strong></td>
            </tr>
            <tr>
              <td>MATK</td>
              <td>{{$job->minMATK}}</td>
              <td><strong>{{$job->maxMATK}}</strong></td>
            </tr>
            <tr>
              <td>MDEF</td>
              <td>{{$job->minMDEF}}</td>
              <td><strong>{{$job->maxMDEF}}</strong></td>
            </tr>
          </tbody>
        </table>
        <h4>Skills</h4>
        <table class="table table-striped table-bordered table-hover ">
          <thead>
            <tr>
              <th>Level</th><th>Skill</th><th>Afection</th><th>Frequency</th>
            </tr>
          </thead>
          <tbody>
          @foreach($job->skills as $skill)
          <tr>
            <td>
              {{$skill->lvl}}+
            </td>
            <td>
              <a href="{{url('skills',$skill->skill_name)}}">{{$skill->skill_name}}</a>
            </td>
            <td>
              <span class="label label-success">{{$skill->affection}}</span>
            </td>
            <td>
              {{$skill->frequency}}%
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
        @if(!empty($job->items[0]))
        <h4>Items</h4>
        <ul>
          @foreach($job->items as $item)
          <li>
            <img src="{{url($item->icon)}}" alt="{{$item->item_name}}" />
            <a href="{{url('items',$item->item_name)}}">{{$item->item_name}}</a>
            X{{$item->quantity}}
          </li>
          @endforeach
          <li><img src="url('assets/icons/coins.png')" alt="Coins" /> {{$job->coins}} Coins</li>
        </ul>
        @endif
      </div>
    @endforeach
    </div>
    <h4>Profile :</h4>
    <div class="col-xs-12 iteractions-wraper">
      <ul class="nav nav-tabs" role="tablist">
        <?php $i = 0 ?>
        @foreach($character->iterations as $iteration)
        <li <?php echo $i == 0 ? 'class="active"' : ''; $i++  ?>>
          <a href="#{{$iteration->trigger}}" aria-controls="home" role="tab" data-toggle="tab">{{$iteration->trigger}}</a>
        </li>
        @endforeach
      </ul>
      <div class="tab-content">
        <?php $i = 0 ?>
        @foreach($character->iterations as $iteration)
        <div role="tabpanel" class="tab-pane <?php echo $i == 0 ? ' active' : ''; $i++  ?>" id="{{$iteration->trigger}}">
           {{$iteration->content}}
        </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
