@extends('layouts.master')

@section('title', 'Terra Battle Z')


@section('content')
  <div class="container">
    <div class="row top-index">
      <div class="col-xs-12">
        <div class="banner-wraper col-xs-12 col-md-8 col-md-offset-2 ">
          <img alt="Terra Battle Z" src="{{url('assets/content/header.png')}}" class="img-responsive">
        </div>
      </div>
      <p class="row text-center">
        Terra Battle Z is a comprehensive website about <a href="http://www.terra-battle.com/en/">Terra Battle</a> game
        where you can find reliable data to help you through the game.
      </p>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="wraper metal-zone">
          <h2>Metal Zone schedule</h2>
        </div>
      </div>

      <div class="col-xs-12 col-md-6">
        <div class="wraper hunt-zone">
          <h2>Hunting Zone schedule</h2>
        </div>

        <div class="wraper news">
          <h3>Terra Battle Z news</h3>
          <ul>
            @foreach($news as $news_elem)
              <li>({{$news_elem->date->format('m/d/Y')}}) {{$news_elem->contents}}</li>
            @endforeach
          </ul>
        </div>

        <div class="wraper timeline">
          <h3>Terra Battle news</h3>
            <a class="twitter-timeline"
               href="https://twitter.com/terra_battle_en"
               data-widget-id="603095940103348224"
               height="400">
              Tweets by @terra_battle_en.
            </a>
        </div>

      </div>

    </div>
  </div>
@endsection
