@extends('layouts.app2')

@section('content')
    @php
        $user_id    = Auth::user()->id;
    @endphp

    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>New Partner Contracts Consultancy</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <div class="col-md-9 col-sm-9  ">
                    <div>

                        <h4>Recent Activity</h4>

                        <!-- end of user messages -->
                        <ul class="messages">
                            @foreach($show as $shw)
                                {{--                                {{ dd($shw) }}--}}
                                <li>
                                    <img src="images/img.jpg" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">{{ $shw->updated_at->day }}</h3>
                                        <p class="month">{{ $shw->updated_at->format('M') }}</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">{{ $shw->user->name }}</h4>
                                        <blockquote class="message">{{ $shw->comment }}</blockquote>
                                        <br/>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            @if(!isset($shw->status->name))

                                            @else
                                                <a><b style="color: {{ $shw->status->color }}">{{ ucfirst($shw->status->name) }} </b></a>
                                            @endif

                                        </p>
                                    </div>
                                </li>
                            @endforeach
                                <br>
                                <h4>Type your comment here</h4>
                            <li>
                                <form action="/ticket/update/{{ $shw->ticket_id }}" method="post">
                                    @csrf
                                    <textarea name="comment" id="ckeditor" rows="10" cols="80"></textarea><br><br>
{{--                                    <input type="checkbox" id="myCheck" onclick="myFunction()">Edit status--}}
{{--                                    <select name="comment" class="form-control" id="text" style="display:none">--}}
{{--                                        <option value="">ss</option>--}}
{{--                                        <option value="">as</option>--}}
{{--                                    </select>--}}
                                    <input type="hidden" name="ticket" value="{{$shw->ticket_id}}">
                                    <input type="hidden" name="user_id" value="{{$user_id}}"><br>
                                    <input type="submit" class="btn btn-sm btn-primary" value="Update">
                                </form>
                            </li>
                        </ul>
                        <!-- end of user messages -->


                    </div>


                </div>

                <!-- start project-detail sidebar -->
                <div class="col-md-3 col-sm-3  ">

                    <section class="panel">

                        <div class="x_title">
                            <h2>Description</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <h3 class="green"><i class="fa fa-paint-brush"></i> Gentelella</h3>

                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                                aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure
                                terr.</p>
                            <br/>

                            <div class="project_detail">

                                <p class="title">Client Company</p>
                                <p>Deveint Inc</p>
                                <p class="title">Project Leader</p>
                                <p>Tony Chicken</p>
                            </div>

                            <br/>
                            <h5>Project files</h5>
                            <ul class="list-unstyled project_files">
                                <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                                </li>
                                <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                                </li>
                                <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                                </li>
                                <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                                </li>
                                <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                                </li>

                            </ul>
                            <br/>

                            <div class="text-center mtop20">
                                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                            </div>
                        </div>

                    </section>

                </div>
                <!-- end project-detail sidebar -->

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        function myFunction() {
            var checkBox = document.getElementById("myCheck");
            var text = document.getElementById("text");
            if (checkBox.checked == true){
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('ckeditor');
    </script>



@endsection
