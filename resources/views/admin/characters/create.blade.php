@extends('layouts.admin')

@section('title', 'Character - Create')

@section('css')
<link href="{{ asset('/css/jasny-bootstrap.min.css')}}" rel="stylesheet">
<style>
  .thumbnail img {
    width: 100%;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }
  input[type='number'] {
    -moz-appearance:textfield;
  }
  #job1{
    visibility: hidden;
  }

</style>
@endsection

@section('js')
<script src="{{ asset('/js/fileinput.js') }}"></script>
<script src="{{ asset('/js/holder.min.js') }}"></script>
<script type="text/javascript">
  $('.job-disabler').click(function(event){
    event.preventDefault();
    var id = $(this).attr( "data" );
    toggler(id)
  });
  $( document ).ready(function() {
    for (var i = 1; i < 4; i++) {
      var id = $("#jobInput"+i).val();
      if (id == 0) {
        updater(i);
      }
    }
  });
  function toggler(id){
    if ($("#jobInput"+id).val() == 1) {
      $(".job"+id).prop("required",false);
      $("#job"+id).text( "Enable" );
      $("#jobInput"+id).val( 0 );
    }else{
      $(".job"+id).prop("required",true);
      $("#job"+id).text( "Disable" );
      $("#jobInput"+id).val( 1 );
    }
    $("#jobWraper"+id).toggleClass("hidden");
  }
  function updater(id){
    $(".job"+id).prop("required",false);
    $("#job"+id).text( "Enable" );
    $("#jobWraper"+id).toggleClass("hidden");
  }


</script>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Character <small>Form Creation</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('admin/characters')}}">Characters</a>
            </li>
            <li class="active">
                 Create
            </li>
        </ol>
    </div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
  <p>
    There are some errors with your input.
    Check the fields marked with red before submitting again;
  </p>
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
  The character <strong>{{Session::get('success')}}</strong> has been registered succesfully.
</div>
@endif
<form class="form-horizontal" action="{{url('admin/characters')}}" method="POST" enctype="multipart/form-data">
  <fieldset>
      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

      <!-- Character Info -->
      <div class="row">

          <div class="col-md-2">
            <div class="fileinput fileinput-new" data-provides="fileinput" style="min-height:100px;">
              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; min-height:100px;">
                <img data-src="holder.js/100x100">
              </div>
              <div>
                <span class="btn btn-default btn-file">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="icon">
                </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
            @if($errors->has('icon'))
            <div class="alert alert-danger" role="alert">
              @foreach($errors->get('icon') as $error)
              <p>{{$error}}</p>
              @endforeach
            </div>
            @endif
          </div>

          <div class="col-md-5">
            <div class="form-group">
              <label class="col-md-3 control-label" for="title">Name :</label>
              <div class="col-md-9">
              <input id="name" name='name' type="text" placeholder="Name" class="form-control input-md" required="" value="{{old('name')}}">

              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label" for="class">Class :</label>
              <div class="col-md-9">
                <select id="class" name="class" class="form-control"  >
                  <optgroup label="Class">
                    @foreach ($data['classes'] as $class)
                      <option value="{{ $class->order_key }}">{{ $class->class }}</option>
                    @endforeach
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label" for="race">Race :</label>
              <div class="col-md-9">
                <select id="race" name="race" class="form-control"  >
                  <optgroup label="Race">
                    @foreach ($data['races'] as $race)
                      <option value="{{ $race->race }}">{{ $race->race }}</option>
                    @endforeach
                  </optgroup>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-5">
            <!-- Multiple Radios (inline) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="radios">Pact of Truth</label>
              <div class="col-md-8">
                <label class="radio-inline" >
                  <input type="radio" name="pot" value="1" checked="checked">
                  Yes
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="pot"  value="0">
                  No
                </label>
              </div>
            </div>

            <!-- Multiple Radios (inline) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="radios">Pact of Fellowship</label>
              <div class="col-md-8">
                <label class="radio-inline" >
                  <input type="radio" name="pof"  value="1" >
                  Yes
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="pof"  value="0" checked="checked">
                  No
                </label>
              </div>
            </div>

            <!-- Multiple Radios (inline) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="radios">Type</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="adventurer"  value="1" checked="checked">
                  Adventurer
                </label>
                <label class="radio-inline">
                  <input type="radio" name="adventurer"  value="0" >
                  Monster
                </label>
              </div>
            </div>

            <!-- Multiple Radios (inline) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="radios">Gender</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="gender"  value="Male" checked="checked">
                  Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender"  value="Female" >
                  Female
                </label>
              </div>
            </div>
          </div>


        </div>
        <hr>

      <!-- Character Jobs -->
      <div class='row'>
        <h2 class="col-xs-12">Jobs</h2>
        @for($i = 1; $i < 4 ; $i++ )
        <div class="col-md-4">
          <a id="job{{$i}}" data="{{$i}}" href="#" class='job-disabler center-block text-center'>Disable</a>
          <div class="wraper" id="jobWraper{{$i}}">
            <h3>Job {{$i}}</h3>
            <input id="jobInput{{$i}}" type="hidden" name="jobInput{{$i}}" value="{{old('jobInput'.$i,1)}}">

            <!-- Name -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="title">Name</label>
              <div class="col-md-9">
                <input id="name{{$i}}" required="" name='name{{$i}}' type="text" placeholder="Name" class="form-control input-md job{{$i}}" value="{{old('name'.$i)}}">
              </div>
            </div>

            <!-- Weapon -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="radios">Weapon</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="weapon{{$i}}"  value="Sword" checked="checked">Sword
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="weapon{{$i}}"  value="Bow">Bow
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="weapon{{$i}}"  value="Spear" >Spear
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="weapon{{$i}}"  value="Staff">Staff
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="weapon{{$i}}"  value="">None
                </label>
              </div>
            </div>

            <!-- Element -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="radios">Element</label>
              <div class="col-md-9">
                <label class="radio-inline" >
                  <input type="radio" name="element{{$i}}"  value="Fire" checked="checked">Fire
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="element{{$i}}"  value="Ice" >Ice
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="element{{$i}}"  value="Lighting">Lighting
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="element{{$i}}"  value="Darkness">Darkness
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="element{{$i}}"  value="Heal">Heal
                </label>
                <label class="radio-inline" >
                  <input type="radio" name="element{{$i}}"  value="Remedy">Remedy
                </label>
                <label class="radio-inline">
                  <input type="radio" name="element{{$i}}"  value="">None
                </label>
              </div>


            </div>

            <!-- Job Art -->
            <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%; min-height:100px;">
              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; min-height:400px;">

              </div>
              <div>
                <span class="btn btn-default btn-file">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="artj{{$i}}" class="job{{$i}}"></span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
            @if($errors->has('artj'.$i))
            <div class="alert alert-danger" role="alert">
              @foreach($errors->get('artj'.$i) as $error)
              <p>{{$error}}</p>
              @endforeach
            </div>
            @endif

            <!-- Stats -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <strong>
                    <th>Stats</th>
                    <th>Min</th>
                    <th>Max</th>
                  </strong>
                <tr>
              </thead>
              <tbody>
                <tr>
                  <td>Level</td>
                  <td>1</td>
                  <td>90</td>
                </tr>
                <tr>
                  <td>HP</td>
                  <td>
                    <input id="minHP{{$i}}" required="" name="minHP{{$i}}" type="number" placeholder="Min HP" class="form-control input-sm job{{$i}}" value="{{old('minHP'.$i)}}">
                  </td>
                  <td>
                    <input id="maxHP{{$i}}" required="" name="maxHP{{$i}}" type="number" placeholder="Max HP" class="form-control input-sm job{{$i}}" value="{{old('maxHP'.$i)}}">
                  </td>
                </tr>
                <tr>
                  <td>ATK</td>
                  <td>
                    <input id="minATK{{$i}}" required="" name="minATK{{$i}}" type="number" placeholder="Min ATK" class="form-control input-sm job{{$i}}" value="{{old('minATK'.$i)}}">
                  </td>
                  <td>
                    <input id="maxATK{{$i}}" required="" name="maxATK{{$i}}" type="number" placeholder="Max ATK" class="form-control input-sm job{{$i}}" value="{{old('maxATK'.$i)}}">
                  </td>
                </tr>
                <tr>
                  <td>DEF</td>
                  <td>
                    <input id="minDEF{{$i}}" required="" name="minDEF{{$i}}" type="number" placeholder="Min DEF" class="form-control input-sm job{{$i}}" value="{{old('minDEF'.$i)}}">
                  </td>
                  <td>
                    <input id="maxDEF{{$i}}" required="" name="maxDEF{{$i}}" type="number" placeholder="Max DEF" class="form-control input-sm job{{$i}}" value="{{old('maxDEF'.$i)}}">
                  </td>
                </tr>
                <tr>
                  <td>MATK</td>
                  <td>
                    <input id="minMATK{{$i}}" required="" name="minMATK{{$i}}" type="number" placeholder="Min MATK" class="form-control input-sm job{{$i}}" value="{{old('minMATK'.$i)}}">
                  </td>
                  <td>
                    <input id="maxMATK{{$i}}" required="" name="maxMATK{{$i}}" type="number" placeholder="Max MATK" class="form-control input-sm job{{$i}}" value="{{old('maxMATK'.$i)}}">
                  </td>
                </tr>
                <tr>
                  <td>MDEF</td>
                  <td>
                    <input id="minMDEF{{$i}}" required="" name="minMDEF{{$i}}" type="number" placeholder="Min MDEF" class="form-control input-sm job{{$i}}" value="{{old('minMDEF'.$i)}}">
                  </td>
                  <td>
                    <input id="maxMDEF{{$i}}" required="" name="maxMDEF{{$i}}" type="number" placeholder="Max MDEF" class="form-control input-sm job{{$i}}" value="{{old('maxMDEF'.$i)}}">
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Skills -->
            <h4>Skills</h4>
            <table class="table table-striped skill-rooster">
              <thead>
                <tr>
                  <strong>
                    <th class="col-xs-2">LVL</th>
                    <th class="col-xs-4">Skill Name</th>
                    <th class="col-xs-4">Affection</th>
                    <th class="col-xs-2">Freq</th>
                  </strong>
                <tr>
              </thead>
              <tbody>
              @for($j = 1; $j < 5 ; $j++ )
                <tr>
                  <td>
                    <input name="j{{$i}}lvl{{$j}}" type="number" class="form-control job{{$i}}" value="{{old('j'.$i.'lvl'.$j)}}">
                  </td>
                  <td>
                    <select class="form-control job{{$i}}" name="j{{$i}}skill{{$j}}">
                      @foreach ($data['skills'] as $skill)
                        <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <select class="form-control job{{$i}}" name="j{{$i}}affection{{$j}}">
                      @foreach ($data['affections'] as $affection)
                        <option value="{{ $affection->affection }}">{{ $affection->affection }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input name="j{{$i}}freq{{$j}}" type="number" class="form-control job{{$i}}" value="{{old('j'.$i.'freq'.$j)}}">
                  </td>
                </tr>
              @endfor
              </tbody>
            </table>

            @if($i != 1)
            <!-- Items -->
            <h4>Items</h4>
            <table class="table table-striped item-rooster">
              <thead>
                <tr>
                  <strong>
                    <th class="col-md-8">Item</th>
                    <th class="col-md-4">Quantity</th>
                  </strong>
                <tr>
              </thead>
              <tbody>
                @for($j = 1; $j < 4 ; $j++ )
                <tr>
                  <td>
                    <select id="j{{$i}}item{{$j}}" required="" name="j{{$i}}item{{$j}}" class="form-control job{{$i}}">
                      @foreach ($data['items'] as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input id="j{{$i}}quantity{{$j}}" required="" name="j{{$i}}quantity{{$j}}" type="number" class="form-control job{{$i}}" value="{{old('j'.$i.'quantity'.$j)}}">
                  </td>
                </tr>
                @endfor
              </tbody>
            </table>
            <div class="input-group">
              <input id="coins{{$i}}" required="" name="coins{{$i}}" type="number" class="form-control job{{$i}}" step="1000" value="{{old('coins'.$i)}}">
              <div class="input-group-addon">Coins</div>
            </div>
            @endif
            <hr>
          </div>
        </div>
        @endfor
      </div>


      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="send"></label>
        <div class="col-md-4">
          <button id="send"  type='submit' name="send" class="btn btn-primary" >Submit</button>
        </div>
      </div>






  </fieldset>
</form>


@endsection
