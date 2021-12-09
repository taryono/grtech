@extends('layouts.app')

@section('content')
<div class="title-table">
    <h3>{{$title}}</h3>
    <button class="expand expand-full" type="button" data-full="false">
        <i class="fa fa-expand" aria-hidden="true"></i>
    </button>
</div>  

<div id="container">
    @include('Employee::list')
</div>
@endsection