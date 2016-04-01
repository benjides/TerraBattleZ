@extends('layouts.admin')

@section('title', 'Skill - Create')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Skills <small>Form Creation</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('admin/skills')}}">Items</a>
            </li>
            <li class="active">
                 Create
            </li>
        </ol>
    </div>
</div>

<form class="form-horizontal" action="{{url('admin/skills')}}" method="POST">
  <fieldset>

      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="contents">Skill name</label>
        <div class="col-md-5">
          <input id="name" name="name" placeholder="Skill" class="form-control input-md" required="" type="text" value="{{old('name')}}">
        </div>
      </div>

      <!-- Textarea input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="contents">Description</label>
        <div class="col-md-5">
          <textarea id="description" name="description" placeholder="Description" class="form-control input-md" required="">{{old('description')}}</textarea>
        </div>
      </div>

      <!-- File input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="contents">Icon</label>
        <div class="col-md-5">
          <input id="icon" name="icon" type="file" class=" input-md" required="">
        </div>
        <div class="col-md-5">
            @foreach (App\Skill::distinct()->select('icon')->get() as $skill)
              <div class="col-xs-4">
                <img src="{{$skill->icon}}" />
              </div>
            @endforeach
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
  The class <strong>{{Session::get('success')}}</strong> has been registered succesfully.
</div>
@endif

@endsection
