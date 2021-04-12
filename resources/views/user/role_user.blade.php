@extends('layouts.app2')

@section('content')


    <!-- role table-->
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Role <small>user</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <br/>
                <div class="checkbox">
                    <label>
                        <form action="/user/update_role/" method="POST">
                            @csrf
                            @foreach($user_role as $id_akses)
                                <input type="hidden" name="id_akses" value="{{ $id_akses->id_akses }}"/>
                            @endforeach
                            @foreach($menu as $menus)
                                @if($menus->parent == 1)
                                    <li>
                                        <input type="checkbox" name="checklist[]" value="{{ $menus->id }}"
                                        @foreach($user_role as $ak)
                                            @if($ak->id_menu == $menus->id)
                                                {{ "checked" }}
                                                @endif
                                            @endforeach>
                                        {{ $menus->nama_menu }}
                                        <ul>
                                            @foreach($menu as $cld)
                                                @if($cld->child == $menus->id )
                                                    <li>
                                                        <input type="checkbox" name="checklist[]" value="{{ $cld->id }}"
                                                        @foreach($user_role as $aks)
                                                            @if($aks->id_menu == $cld->id)
                                                                {{ "checked" }}
                                                                @endif
                                                            @endforeach>
                                                        {{ $cld->nama_menu }}<br>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                            <button type="submit" onclick="return confirm('Are you sure to update this user role?')" class="btn btn-warning btn-sm">Update</button>
                            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a
                        </form>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- end of role table-->

    <!-- detail user -->
    <div class="col-md-6 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Detail information <small>user</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name" disabled value="{{ $name[0] }}">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="text" class="form-control" id="inputSuccess3" disabled placeholder="Last Name"
                           @if(isset($name[1]))
                            value="{{ $name[1] }}"
                        @else
                            value=""
                        @endif
                        >
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="email" class="form-control has-feedback-left" disabled id="inputSuccess4" placeholder="Email" value="{{ $detail->email }}">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="tel" class="form-control" id="inputSuccess5" disabled placeholder="Phone">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Access ID</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" disabled="disabled" value="{{ $id_akses->id }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Status </label>
                        <div class="col-md-9 col-sm-9 ">
                            @if($detail->status == 1)
                                <input type="text" class="form-control" disabled placeholder="Status" value="Active">
                            @else
                                <input type="text" class="form-control" disabled placeholder="Status" value="In active">
                            @endif
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Edit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                    </div>
                </form>
            </div>
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

                <form action="/user/update/{{ $detail->id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nameasd:</label>
                            <input type="text" class="form-control" value="{{ $detail->name }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" value="{{ $detail->email }}" name="email">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Status:</label>
                            <select class="form-control" name="status" id="status">
                                <option></option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" value="Update" >Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edit -->
@endsection
