@extends('layouts.topics')


@section('content')

<h3>Topics</h3>


@if(empty($res) == false)

        @foreach($res as $k => $v)

        @if( $v < 8 )

        <a target="_blank" style="font-size: {{ $v * 4 }}px; color:black;" href="<?php echo url('topics-tosearch/'.$k); ?>" data-toggle="tooltip" title="{{ $k }} {{ $v }} mentions found.">{{ $k }}</a>
        @else
        <?php
        if($v > 100){
            $v = 50;
        }
        ?>
        <a target="_blank" style="font-size: {{ $v }}px; color:black;" href="<?php echo url('topics-tosearch/'.$k); ?>" data-toggle="tooltip" title="{{ $k }} {{ $v }} mentions found.">{{ $k }}</a>
        @endif


        @endforeach

@endif


@endsection
