@extends('layouts.admin')

@section('title', 'Items - List')
<style media="screen">
  .table tbody>tr>td{
    vertical-align: middle;
  }
</style>
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Items <small  class="hidden-xs">Complete List</small>
            <a href="{{url('/admin/items/create')}}" class="btn btn-default pull-right">
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
  The Item <strong>{{Session::get('success')}}</strong> has been deleted succesfully.
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
      @foreach ($items as $item)
        <tr>
          <td>
            <img src="{{ $item->icon }}" alt="{{ $item->name }}" class="img-responsive" />
          </td>
          <td>
            {{ $item->name }}
          </td>
          <td>
            {{ $item->description }}
          </td>
          <td>
            <a href="{{url('/admin/items/'.$item->id.'/edit')}}" class="btn btn-warning">
              <i class="fa fa-pencil"></i><span class="hidden-xs"> Edit</span>
            </a>
          </td>
          <td>
            <form action="{{url('admin/items',$item->id)}}" method="POST">
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
  <a href="{{url('/admin/items/create')}}" class="btn btn-default">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
  </a>
@endsection
