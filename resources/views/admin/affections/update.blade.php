@extends('layouts.admin')

@section('title', 'Affections - Update')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Affections <small>Update</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('admin/affections')}}">Affections</a>
            </li>
            <li class="active">
                 Update
            </li>
        </ol>
    </div>
</div>

<form class="form-horizontal" action="{{url('admin/affections',$affection->id)}}" method="POST">
  <fieldset>

      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
      <input type="hidden" name="_method" value="PUT">

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="contents">Name</label>
        <div class="col-md-5">
          <input id="affection" name="affection" placeholder="Affection" class="form-control input-md" required="" type="text" value="{{$affection->affection}}">
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
  The affection <strong>{{Session::get('success')}}</strong> has been updated succesfully.
</div>
@endif

@endsection
