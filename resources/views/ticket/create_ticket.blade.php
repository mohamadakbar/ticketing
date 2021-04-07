@extends('layouts.app2')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Create <small>Ticket</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <!-- Tabs -->
                <form class="form-horizontal form-label-left" id="forms" action="store" method="POST">
                    @csrf
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="list-unstyled wizard_steps">
                            <li>
                                <a href="#step-11">
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                              Step 1<br />
                                              <small>Choose your category</small>
                                          </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-22">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                              Step 2<br />
                                              <small>Describe your report</small>
                                          </span>
                                </a>
                            </li>
                        </ul>
{{--                        <h6>Personal info</h6>--}}
                        <div id="step-11">
{{--                            <span class="section"></span>--}}
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="hidden" value="{{ $user->id }}">
                                    <input type="text" id="first-name2" required="required" class="form-control" disabled value="{{ $user->name }}" >
                                    <input type="hidden" id="first-name2" required="required" class="form-control" value="{{ $user->id }}" name="user_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="middle-name"
                                       class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text"  id="middle-name2" class="form-control " disabled value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Category of report <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-3 col-sm-3 ">
                                    <select class="form-control" name="category_id" required>
                                            <option>Choose ..</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="step-22">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Describe<small>your report</small></h2>
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
                                        <div id="alerts"></div>
                                        <div class="btn-toolbar editor" data-role="editor-toolbar"
                                             data-target="#editor-one">
                                            <div class="btn-group">
                                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i
                                                        class="fa fa-font"></i><b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                </ul>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                                                        class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a data-edit="fontSize 5">
                                                            <p style="font-size:17px">Huge</p>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-edit="fontSize 3">
                                                            <p style="font-size:14px">Normal</p>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-edit="fontSize 1">
                                                            <p style="font-size:11px">Small</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i
                                                        class="fa fa-bold"></i></a>
                                                <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i
                                                        class="fa fa-italic"></i></a>
                                                <a class="btn" data-edit="strikethrough" title="Strikethrough"><i
                                                        class="fa fa-strikethrough"></i></a>
                                                <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
                                                        class="fa fa-underline"></i></a>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i
                                                        class="fa fa-list-ul"></i></a>
                                                <a class="btn" data-edit="insertorderedlist" title="Number list"><i
                                                        class="fa fa-list-ol"></i></a>
                                                <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i
                                                        class="fa fa-dedent"></i></a>
                                                <a class="btn" data-edit="indent" title="Indent (Tab)"><i
                                                        class="fa fa-indent"></i></a>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn" data-edit="justifyleft"
                                                   title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                                <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                                                        class="fa fa-align-center"></i></a>
                                                <a class="btn" data-edit="justifyright"
                                                   title="Align Right (Ctrl/Cmd+R)"><i
                                                        class="fa fa-align-right"></i></a>
                                                <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                                                        class="fa fa-align-justify"></i></a>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i
                                                        class="fa fa-link"></i></a>
                                                <div class="dropdown-menu input-append">
                                                    <input class="span2" placeholder="URL" type="text"
                                                           data-edit="createLink"/>
                                                    <button class="btn" type="button">Add</button>
                                                </div>
                                                <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i
                                                        class="fa fa-cut"></i></a>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn" title="Insert picture (or just drag & drop)"
                                                   id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                                <input type="file" data-role="magic-overlay" data-target="#pictureBtn"
                                                       data-edit="insertImage"/>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i
                                                        class="fa fa-undo"></i></a>
                                                <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i
                                                        class="fa fa-repeat"></i></a>
                                            </div>
                                        </div>

{{--                                        <div id="editor-one" class="editor-wrapper"></div>--}}

                                        <textarea name="comment" style="width: 100%"></textarea>
                                        {{--                                        <textarea id="descr" style="display:none;" name="comment"></textarea>--}}

                                        <br/>

                                        {{--                                        <div class="ln_solid"></div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End SmartWizard Content -->
            </div>
        </div>
    </div>


@endsection
