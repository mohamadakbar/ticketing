@extends('layouts/app2')

@section('content')

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Divison <small><a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-success btn-sm">Create new</a></small>
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
                                Detail of divison list
                            </p>
                            <table id="datatable-keytable" class="table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($category as  $cat)
                                    <tr>
                                        <td class="name_list{{ $cat->id }}">{{ $cat->name }}</td>
                                        <td>
                                            <a href="#" data-id="{{ $cat->id }}" value="{{ $cat->id }}" class="editForm" data-toggle="modal" data-target="#editModal" style="color: #ffac17">Edit</a>
                                            <a href="{{ url('category/destroy/') }}/{{ $cat->id }}" onclick="return confirm('Are you sure delete this data?')" style="color: red">Delete</a>
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

    <!--Modal create-->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Division</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('category/store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Division Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Create"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal create-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Division</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Division Name:</label>
                            <input type="text" class="form-control names" name="name" id="name">
                            <input type="hidden" class="form-control ids" name="id" id="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary update"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).on("click", ".editForm", function () {
            var id = $(this).data('id');

            $.ajax({
                type:"POST",
                url: "category/edit/"+id,
                data:{
                    "_token": "{{ csrf_token() }}"
                },
                dataType:'json',
                success:function (data) {
                    var dt = data.cat;
                    $('.names').val(dt.name);
                    $('.ids').val(dt.id);
                }
            });
        });

        $(document).on("click", ".update", function () {

            $.ajax({
                type:"POST",
                url: "category/update/",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: $("#name").val(),
                    id: $("#id").val()
                },
                dataType:'json',
                success:function (data) {
                    $("#editModal").modal('hide');
                    $('.name_list'+(data.id)).html(data.name);
                }
            });
        });
    </script>

@endsection
