@extends('layouts.admin')

@section('title', 'Classes - List')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Classes <small>Complete List</small>
            <a href="{{url('/admin/classes/create')}}" class="btn btn-default pull-right">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                 Classes
            </li>
        </ol>
    </div>
</div>

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
  The Class <strong>{{Session::get('success')}}</strong> has been deleted succesfully.
</div>
@endif

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Order</th>
        <th>Class</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($classes as $class)
        <tr>
          <td>
            {{ $class->order_key }}
          </td>
          <td>
            {{ $class->class }}
          </td>
          <td>
            <a href="{{url('/admin/classes/'.$class->id.'/edit')}}" class="btn btn-warning">
              <i class="fa fa-pencil"></i><span class="hidden-xs"> Edit</span>
            </a>
          </td>
          <td>
            <form action="{{url('admin/classes',$class->id)}}" method="POST">
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
  <a href="{{url('/admin/classes/create')}}" class="btn btn-default">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
  </a>
@endsection
