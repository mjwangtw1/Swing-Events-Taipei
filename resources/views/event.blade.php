
<?php

use Carbon\Carbon;

$dt = Carbon::now();
//$dt->timezone = new DateTimeZone($data['timezone']);

//$dt->setTimezone($data['timezone']);

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$data['calendar_name']}} </div>
                <div class="panel-body">
                 <!--    <h3>{{$data['timezone']}}</h3> -->
                    
                    @foreach($data['events'] as $single_event)

                    <!-- Use Panel Instead-->
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <h3 class="panel-title">
                        <span>
                            {{ $single_event['summary'] }}
                        </span>
                        <span class="label label-success" style="float:right">
                            {{ $dt->parse($single_event['start']['dateTime'])->format('Y / m / d l') }} 
                            {{ $dt->parse($single_event['start']['dateTime'])->format('h A') }} ~ 
                            {{ $dt->parse($single_event['end']['dateTime'])->format('h A') }} 
                        </span>

                        </h3>
                      </div>
                      <div class="panel-body">
                        {{ isset($single_event['description']) ? $single_event['description'] : '' }}
                      </div>
                      <div class="panel-footer">

                       <a href="https://maps.google.com/maps?hl=zh-TW&amp;q={{ isset($single_event['location']) ? $single_event['location'] : '' }}" class="menu-link" target="_blank">
                       {{ isset($single_event['location']) ? $single_event['location'] : '' }}
                       </a>                     

                      </div>
                    </div>


                    @endforeach

                    @foreach($data['course'] as $single_event)
<!-- 
                    <div class="card">
                      <div class="card-block">
                        <h4 class="card-title">{{ $single_event['summary'] }}</h4>
                        <h6 class="card-subtitle text-muted">{{ $dt->parse($single_event['start']['dateTime'])->month }} / {{ $dt->parse($single_event['start']['dateTime'])->day }}</h6>
                      </div>
                      <img data-src="..." alt="Card image">
                      <div class="card-block">
                        <p class="card-text">
                        {{{ isset($single_event['description']) ? $single_event['description'] : '' }}}
                        </p>
                        <a href="#" class="card-link">Location Detail</a>
                        <a href="#" class="card-link">Another link</a>
                      </div>
                    </div>
 -->
                    @endforeach




                </div>
            </div>
        </div>
    </div>
</div>
@endsection