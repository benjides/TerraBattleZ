@extends('layouts.admin')

@section('title', 'Skills - List')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Skills <small>Complete List</small>
            <a href="{{url('/admin/skills/create')}}" class="btn btn-default pull-right">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                 Items
            </li>
        </ol>
    </div>
</div>

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
  The skill <strong>{{Session::get('success')}}</strong> has been deleted succesfully.
</div>
@endif

  <table class="table table-hover">
    <thead>
      <tr>
        <th class="col-xs-1">Icon</th>
        <th>Name</th>
        <th>Description</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($skills as $skill)
        <tr>
          <td>
            <img src="{{ $skill->icon }}" alt="{{ $skill->name }}" class="img-responsive" />
          </td>
          <td>
            {{ $skill->name }}
          </td>
          <td>
            {{ $skill->description }}
          </td>
          <td>
            <a href="{{url('/admin/skills/'.$skill->id.'/edit')}}" class="btn btn-warning">
              <i class="fa fa-pencil"></i><span class="hidden-xs"> Edit</span>
            </a>
          </td>
          <td>
            <form action="{{url('admin/skills',$skill->id)}}" method="POST">
              <input name="_method" type="hidden" value="DELETE">
              <input name="_token" type="hidden" value="{{csrf_token()}}">
              <button id="submit" name="submit" class="btn btn-danger">
                <i class="fa fa-times"></i><span class="hidden-xs"> Delete</span>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <a href="{{url('/admin/skills/create')}}" class="btn btn-default">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
  </a>
@endsection
