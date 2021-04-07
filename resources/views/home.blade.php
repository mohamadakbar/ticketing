@extends('layouts.app2')

@section('content')

    <div class="tile_count">
        <div class="col-md-2 col-sm-4  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> New Ticket</span>
            <div class="count red"><a href="ticket" style="color: red">{{ $new }}</a></div>
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Pending</span>
            <div class="count">{{ $pending }}</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> On Progress</span>
            <div class="count green">{{ $on }}</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Done</span>
            <div class="count">{{ $done }}</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">7,325</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <!-- /top tiles -->



@endsection
