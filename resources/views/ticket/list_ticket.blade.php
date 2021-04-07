@extends('layouts.app2')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ticket <small><a href="{{ url('ticket/create') }}" class="btn btn-success btn-sm">Create
                            new</a></small>
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
                                Detail of ticket list
                            </p>
                            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                            <table id="datatable-keytable" class="table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Ticket From</th>
                                    <th scope="col" style="width: 30%">Div</th>
                                    <th scope="col" style="width: 20%">Status</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php
                                    $user_id    = Auth::user()->id;
                                @endphp
                                @foreach($ticket as $tiket)
                                    <tr>
                                        <td id="id{{ $tiket->id}}">{{ $tiket->id }}</td>
                                        <td id="user{{ $tiket->id}}">{{ $tiket->user->name }}</td>
                                        <td id="cat{{ $tiket->id}}">{{ $tiket->category->name }}</td>
                                        <td id="sts{{ $tiket->id}}"><span
                                                class="{{ $tiket->status->layout }}">{{ $tiket->status->name }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-success"
                                                   href="{{ url('ticket/detail')."/".$tiket->id }}"
                                                   style="color: #ffffff; font-size: 12px">Detail</a>
                                                <button type="button" class="btn btn-warning btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" style="color: #ffffff; font-size: 12px">
                                                    Default
                                                </button>
                                                <a href="#" id="status" data-type="select" data-pk="1" data-url="/post"
                                                   data-title="Select status"></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item doing" data-toggle="modal"
                                                       data-target="#doneModal{{ $tiket->id }}">Done</a>
                                                    <a class="dropdown-item doing" data-toggle="modal"
                                                       data-target="#doingModal{{ $tiket->id }}">Doing</a>
                                                    <a class="dropdown-item doing" data-toggle="modal"
                                                       data-target="#pendingModal{{ $tiket->id }}">Pending</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="doneModal{{ $tiket->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/ticket/update/{{ $tiket->id }}" method="post">
                                                    <div class="modal-body">

                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Type your
                                                                comment:</label>
                                                            <input type="hidden" class="form-control" name="sts_id"
                                                                   value="3"/>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                   value="{{ $user_id }}"/>
                                                            <input type="hidden" class="form-control" id="id"
                                                                   name="tic_id" value="{{ $tiket->id }}"/>
                                                            <textarea class="form-control" id="message-text"
                                                                      name="comment"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="doingModal{{ $tiket->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal doing</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/ticket/update/{{ $tiket->id }}" method="post">
                                                    <div class="modal-body">

                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Type your
                                                                comment:</label>
                                                            <input type="hidden" class="form-control" name="sts_id"
                                                                   value="2"/>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                   value="{{ $user_id }}"/>
                                                            <input type="hidden" class="form-control" id="id"
                                                                   name="tic_id" value="{{ $tiket->id }}"/>
                                                            <textarea class="form-control" id="message-text"
                                                                      name="comment"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="pendingModal{{ $tiket->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal doing</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/ticket/update/{{ $tiket->id }}" method="post">
                                                    <div class="modal-body">

                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Type your
                                                                comment:</label>
                                                            <input type="hidden" class="form-control" name="sts_id"
                                                                   value="4"/>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                   value="{{ $user_id }}"/>
                                                            <input type="hidden" class="form-control" id="id"
                                                                   name="tic_id" value="{{ $tiket->id }}"/>
                                                            <textarea class="form-control" id="message-text"
                                                                      name="comment"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end Modal -->
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            // $("#doneBtn").click(function(){
            $(".comment").hide();
            // });
            // $("#doneBtn").click(function(){
            //     $("#comment").show();
            // });
        });
    </script>
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}

    {{--            $('.body').on('click', '.saveEdit', function (e) {--}}
    {{--                e.preventDefault();--}}

    {{--                var comment = $("#comment").val();--}}
    {{--                console.log(comment);--}}

    {{--                // var ids = $(this).data('id');--}}
    {{--                // var id = ids.slice(5);--}}
    {{--                // var sts =  ids.split("-");--}}



    {{--                // $.ajax({--}}
    {{--                //     url: "/ticket/update/" + id,--}}
    {{--                //     type: "POST",--}}
    {{--                //     data: {--}}
    {{--                //         _token: $("#csrf").val(),--}}
    {{--                //         id: id,--}}
    {{--                //         user: $("#user").data('id'),--}}
    {{--                //         cat: $("#cat").data('id'),--}}
    {{--                //         com: 'shortcut',--}}
    {{--                //         sts: sts--}}
    {{--                //     },--}}
    {{--                //     cache: false,--}}
    {{--                //     success: function (dataResult) {--}}
    {{--                //         var dataResult = JSON.parse(dataResult);--}}
    {{--                //         if (dataResult.statusCode == 200) {--}}
    {{--                //             $("#sts").data(dataResult.rs);--}}
    {{--                //         } else if (dataResult.statusCode == 201) {--}}
    {{--                //             alert("Status already in your ticket, check detail ticket");--}}
    {{--                //         }--}}
    {{--                //--}}
    {{--                //     }--}}
    {{--                // });--}}

    {{--            });--}}

    {{--            $('.body').on('click', '.doing', function () {--}}
    {{--                event.preventDefault();--}}

    {{--                var ids = $(this).data('id');--}}
    {{--                var com = $('#comment');--}}
    {{--                var id = ids.slice(6);--}}
    {{--                var sts =  ids.split("-");--}}

    {{--                // $.ajax({--}}
    {{--                //     url: "/ticket/update/" + id,--}}
    {{--                //     type: "POST",--}}
    {{--                //     data: {--}}
    {{--                //         _token: $("#csrf").val(),--}}
    {{--                //         id: id,--}}
    {{--                //         user: $("#user").data('id'),--}}
    {{--                //         cat: $("#cat").data('id'),--}}
    {{--                //         com: 'asd',--}}
    {{--                //         sts: sts--}}
    {{--                //     },--}}
    {{--                //     cache: false,--}}
    {{--                //     success: function (dataResult) {--}}
    {{--                //         var dataResult = JSON.parse(dataResult);--}}
    {{--                //         if (dataResult.statusCode == 200) {--}}
    {{--                //             $("#sts").html(dataResult.rs);--}}
    {{--                //         } else if (dataResult.statusCode == 201) {--}}
    {{--                //             alert("Status already in your ticket, check detail ticket");--}}
    {{--                //         }--}}
    {{--                //--}}
    {{--                //     }--}}
    {{--                // });--}}

    {{--            });--}}

    {{--            $('.body').on('click', '.pending', function () {--}}
    {{--                event.preventDefault();--}}

    {{--                var ids = $(this).data('id');--}}
    {{--                var com = $('#comment');--}}
    {{--                var id = ids.slice(8);--}}
    {{--                var sts =  ids.split("-");--}}

    {{--            //     $.ajax({--}}
    {{--            //         url: "/ticket/update/"+id,--}}
    {{--            //         type: "POST",--}}
    {{--            //         data: {--}}
    {{--            //             _token: $("#csrf").val(),--}}
    {{--            //             id: id,--}}
    {{--            //             user: $("#user").data('id'),--}}
    {{--            //             cat: $("#cat").data('id'),--}}
    {{--            //             com: 'asd',--}}
    {{--            //             sts: sts--}}
    {{--            //         },--}}
    {{--            //         cache: false,--}}
    {{--            //         success: function(dataResult){--}}
    {{--            //             var dataResult = JSON.parse(dataResult);--}}
    {{--            //             if(dataResult.statusCode==200){--}}
    {{--            //                 $("#sts").html(dataResult.rs);--}}
    {{--            //             }--}}
    {{--            //             else if(dataResult.statusCode==201){--}}
    {{--            //                 alert("Status already in your ticket, check detail ticket");--}}
    {{--            //             }--}}
    {{--            //--}}
    {{--            //         }--}}
    {{--            //     });--}}
    {{--            });--}}

    {{--        });--}}
    {{--    </script>--}}

@endsection
