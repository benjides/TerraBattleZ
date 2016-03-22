@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <!-- Page Heading -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              Dashboard <small>Statistics Overview</small>
          </h1>
          <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-dashboard"></i> Dashboard
              </li>
          </ol>
      </div>
  </div>

  <div class="row">
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="zmdi zmdi-account zmdi-hc-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{ App\Character::all()->count() }}</div>
                          <div>Characters</div>
                      </div>
                  </div>
              </div>
              <a href="url('admin/characters')">
                  <div class="panel-footer">
                      <span class="pull-left">Overview</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="zmdi zmdi-fire zmdi-hc-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{ App\Skill::all()->count() }}</div>
                          <div>Skills</div>
                      </div>
                  </div>
              </div>
              <a href="url('admin/skills')">
                  <div class="panel-footer">
                      <span class="pull-left">Overview</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="zmdi zmdi-wrench zmdi-hc-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{ App\Item::all()->count() }}</div>
                          <div>Items</div>
                      </div>
                  </div>
              </div>
              <a href="url('admin/items')">
                  <div class="panel-footer">
                      <span class="pull-left">Overview</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="zmdi zmdi-flare zmdi-hc-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{ App\Item::all()->count() }}</div>
                          <div>Companions</div>
                      </div>
                  </div>
              </div>
              <a href="url('admin/companions')">
                  <div class="panel-footer">
                      <span class="pull-left">Overview</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>



  </div>
  <!-- /.row -->


@endsection
