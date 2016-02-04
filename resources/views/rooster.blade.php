@extends('layouts.master')

@section('title', 'Characters')

<?php
  use Faker\Factory as Faker;
  $faker = Faker::create();

?>

@section('content')
  <div class="container">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <h1>Characters</h1>
      <p>
        These are the Characters that you can get in Terra Battle.
        Characters can have a class of SS, S, A, or B. SS is the strongest character class and B is the weakest character class.
      </p>
    </div>
    <div class="col-xs-12 col-md-12 col-lg-12 char-wraper">
      @foreach ($characters as $character)
        <div class="col-xs-4 col-sm-3 col-md-2 char-elem text-center">
          <a href="{{ url('characters' , $character->name ) }}" class="float-link">
            <img src="{{ $faker->imageUrl(100, 100, 'abstract', true) }}" alt={{ $character->name }} />
            <p>{{ $character->name }}</p>
          </a>
        </div>
      @endforeach
    </div>
  </div>
@endsection
