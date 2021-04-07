@extends('layouts.app2')

@section('content')

    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Basic Elements <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">User Name </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control" disabled="disabled" value="{{ $show->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Email</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control" readonly="readonly" value="{{ $show->email }}">
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Cancel</a>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#exampleModal">Edit
                        </button>
                        <a href="{{ url('menu/delete/') }}/{{ $show->id }}" class="btn btn-danger btn-sm">Delete</a>
                    </div>

                </div>
                <!-- Modal edit -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/menu/update/{{ $show->id }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Menu Name:</label>
                                        <input type="hidden" value="{{ $show->id }}" name="id">
                                        <input type="text" class="form-control" value="{{ $show->nama_menu }}"
                                               name="nama_menu">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Slug:</label>
                                        <input type="text" class="form-control" value="{{ $show->slug }}" name="slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">As a Parent:</label>
                                        <select class="form-control" name="parent" id="parent">
                                            @if($show->parent == 1)
                                                <option value="1">Yes</option>
                                            @else
                                                <option value="0">No</option>
                                            @endif
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Icon:</label>
                                        <input type="text" class="form-control" value="{{ $show->icon }}" name="icon">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Update"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal edit -->
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#parent").on('change', function () {
                $("#child").slideToggle();
            });
        });
    </script>

@endsection
