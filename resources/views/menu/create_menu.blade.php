@extends('layouts.app2')

@section('content')

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Menu</h4>
                <form class="form-sample" name="addMenu" id="addMenu">
                    @csrf
                    <p class="card-description"> Personal info </p>
                    <div class="row" id="ajaxModel">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Menu Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_menu" value="{{ old('nama_menu') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Slug</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Make As Parent</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="parent" id="parent">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Child</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="child"  id="child">
                                        <option value="0" >-- choose --</option>
                                    @foreach($pattern as $ptn)
                                        <option value="{{ $ptn->id }}" >{{ $ptn->nama_menu }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Function</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="func">
                                        <option></option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Icon</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="icon" value="{{ old('icon') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary mr-2" id="saveBtn">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#parent").on('change', function() {
                $("#child").slideToggle();
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#saveBtn').click(function (e) {
           console.log('sini');
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#addMenu').serialize(),
                url: "{{ route('menu.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
    console.log('sukses');
                    $('#addMenu').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function (data) {
    console.log('sukses');
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
    </script>

@endsection
