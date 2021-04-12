@extends('layouts.app2')

@section('content')

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ ucfirst(Request::segment(1)) }} <small><a href="{{ url('menu/create') }}" class="btn btn-success btn-sm">Create new</a></small>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <p class="text-muted font-13 m-b-30">
                                Detail of menu list
                            </p>
                            <table id="datatable-keytable" class="table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width: 30%">Slug</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($menu as  $menus)
                                    <tr>
                                        <td>{{ $menus->nama_menu }}</td>
                                        <td>{{ $menus->slug }}</td>
                                        <td>
                                            <a href="{{ url('menu/show/'.$menus->id) }}" style="color: #0b97c4">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
