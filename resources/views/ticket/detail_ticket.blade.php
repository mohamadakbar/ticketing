@extends('layouts.app2')

@section('content')
    @php
        $user_id    = Auth::user()->id;
    @endphp
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="row">
                <div class="col-md-4 col-sm-4 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recent <small>Activities</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="dashboard-widget-content">
                                <ul class="list-unstyled timeline widget">
{{--                                    {{ dd($show) }}--}}
                                    @foreach($show as $shw)
                                    <li>
{{--                                        {{dd($shw)}}--}}
                                        <div class="block">
                                            <div class="block_content">
                                                <h2 class="title">
                                                    @if(!isset($shw->status->name))
                                                        <a>{{ $shw->user->name }} add a comment</a>
                                                    @else
                                                        <a><b style="color: {{ $shw->status->color }}">{{ ucfirst($shw->status->name) }} </b></a>
                                                    @endif
                                                </h2>
                                                <div class="byline">
                                                    <span>{{ $shw->updated_at }}</span> by <a>{{ $shw->user->name }}</a>
                                                </div>
                                                <p class="excerpt">{{ $shw->comment }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-8 col-sm-8 ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Comment <small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form action="/ticket/update/{{$shw->ticket_id}}" method="post">
                                        @csrf
                                        <textarea name="comment" id="ckeditor" rows="10" cols="80"></textarea>
                                        <input type="hidden" name="ticket" value="{{$shw->ticket_id}}">
                                        <input type="hidden" name="user_id" value="{{$user_id}}"><br>
                                        <input type="submit" class="btn btn-sm btn-primary" value="update">
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'ckeditor' );
    </script>



@endsection
