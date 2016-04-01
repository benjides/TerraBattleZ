@extends('layouts.admin')

@section('title', 'Characeters - List')

@section('css')
<style media="screen">
.table tbody>tr>td{
  vertical-align: middle;
}
</style>
@endsection
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Characters <small>Complete List</small>
            <a href="{{url('/admin/characters/create')}}" class="btn btn-default pull-right">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
            </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                 Characters
            </li>
        </ol>
    </div>
</div>

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
  The Character <strong>{{Session::get('success')}}</strong> has been deleted succesfully.
</div>
@endif

  <table class="table table-hover">
    <thead>
      <tr>
        <th class="col-xs-1">Icon</th>
        <th>Name</th>
        <th>Class</th>
        <th>Race</th>
        <th>PoT</th>
        <th>PoF</th>
        <th>Adventurer</th>
        <!-- <th>Edit</th> -->
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($characters as $character)
        <tr>
          <td>
            <img src="{{ asset('assets/characters/'.$character->savename.'/'.$character->icon) }}" alt="{{ $character->name }}" class="img-responsive" />
          </td>
          <td>
            <a href="{{ url('characters/'.$character->name) }}" target="_blank">{{$character->name}}</a>
          </td>
          <td>
            {{ $character->class }}
          </td>
          <td>
            {{ $character->race }}
          </td>
          <td>
            <?php echo $character->pot ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '-' ?>
          </td>
          <td>
            <?php echo $character->pof ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '-' ?>
          </td>
          <td>
            <?php echo $character->adventurer ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '-' ?>
          </td>
          <!-- <td>
            <a href="{{url('/admin/characters/'.$character->id.'/edit')}}" class="btn btn-warning">
              <i class="fa fa-pencil"></i><span class="hidden-xs"> Edit</span>
            </a>
          </td> -->
          <td>
            <form action="{{url('admin/characters',$character->id)}}" method="POST">
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
  <a href="{{url('/admin/characters/create')}}" class="btn btn-default">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
  </a>
@endsection
