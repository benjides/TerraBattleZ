@extends('layouts.master')

@section('title', 'Terra Battle Z')


@section('content')
  <div class="container">
    <div class="row top-index">
      <div class="col-md-12">
        <div class="banner-wraper col-xs-12 col-md-8 col-md-offset-2 ">
          <img alt="Terra Battle Z" src="{{url('assets/content/header.png')}}" class="img-responsive">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="wraper metal-zone">
          <h1>Metal Zone schedule</h1>
        </div>
      </div>

      <div class="col-xs-12 col-md-6">
        <div class="wraper hunt-zone">
          <h1>Hunting Zone schedule</h1>
        </div>

        <div class="wraper news">
          <h2>Terra Battle Z news</h2>
          <ul>

          </ul>
        </div>

        <div class="wraper timeline">
          <h2>Terra Battle news</h2>
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
