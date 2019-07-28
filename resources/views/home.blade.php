@extends('layouts.app')

@section('content')
<div class="dashboard col-xs-9">
    <div class="dashboard__box col-xs-3 green">
        <div class="dashboard__header">USERS</div>
        <div class="dashboard__main">
           
        </div>
        <div class="dashboard__footer"><a href="{{ url('admin/users') }}">View users</a></div>
    </div>


</div>
@endsection
