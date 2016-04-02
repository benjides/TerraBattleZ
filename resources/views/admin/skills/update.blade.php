@extends('layouts.admin')

@section('title', 'Skill - Update')
@section('css')
<link href="{{ asset('/css/jasny-bootstrap.min.css')}}" rel="stylesheet">
<style media="screen">
  #selector{
    max-height: 250px;
    overflow-y: scroll;
  }
</style>
@endsection
@section('js')
<script src="{{ asset('/js/fileinput.js') }}"></script>
<script src="{{ asset('/js/holder.min.js') }}"></script>
<script type="text/javascript">
  $('.skillselector').click(function(event){
    event.preventDefault();
    $('.active').removeClass('active');
    $(this).addClass('active');
    var icon = $(this).attr('data-skill');
    $('#inputSkill').val(icon);
  });
  $('#selectorWraper').fadeOut();
  $('.toggle').click(function(){
    $('.wraper').fadeToggle();
  });
</script>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Skills <small>Update</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('admin/skills')}}">Items</a>
            </li>
            <li class="active">
                 Update
            </li>
        </ol>
    </div>
</div>

<form class="form-horizontal" action="{{url('admin/skills',$skill->id)}}" method="POST" enctype="multipart/form-data">
  <fieldset>

      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
      <input type="hidden" name="_method" value="PUT">

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="contents">Skill name</label>
        <div class="col-md-5">
          <input id="name" name="name" placeholder="Skill" class="form-control input-md" required="" type="text" value="{{old('name' , $skill->name)}}">
        </div>
      </div>

      <!-- Textarea input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="contents">Description</label>
        <div class="col-md-5">
          <textarea id="description" name="description" placeholder="Description" class="form-control input-md" required="">{{old('description' , $skill->description)}}</textarea>
        </div>
      </div>

      <!-- Multiple Radios -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="radios">Icon</label>
        <div class="col-md-4">
          <div class="radio">
            <label>
              <input type="radio" class="toggle" name="file" value="select">
              Select from existing one:
            </label>
            <div class="wraper" id="selectorWraper">
              <input type="hidden" name="skill" value="{{$skill->icon}}" id="inputSkill">
              <div class="panel panel-default" id="selector">
                <div class="panel-body">
                  @foreach (App\Skill::distinct()->select('icon')->get() as $skill)
                    <div class="col-xs-3">
                      <a href="#" class="thumbnail skillselector" data-skill="{{$skill->icon}}">
                        <img src="{{asset('assets/content/skills/'.$skill->icon)}}" alt="{{$skill->name}}">
                      </a>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
        	</div>

          <div class="radio">
            <label>
              <input type="radio" class="toggle" name="file" value="file" checked="checked">
              Upload file:
            </label>
            <div class="wraper fileinput fileinput-new col-xs-12" data-provides="fileinput" >
              <div class="fileinput-preview thumbnail" data-trigger="fileinput" >
                <img src="{{asset('assets/content/skills/'.$skill->icon)}}">
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
          </div>



        </div>


      </div>



      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-4">
          <button id="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>

  </fieldset>
</form>

@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
  @endforeach
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
  The skill <strong>{{Session::get('success')}}</strong> has been updated succesfully.
</div>
@endif

@endsection
