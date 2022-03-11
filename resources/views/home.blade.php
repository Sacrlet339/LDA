@extends('layouts.app')

@section('content')
<div class="mainContent">
    <div class="container-fluid">
        <div class="container-fluid px-4 py-4 d-flex justify-content-end">
        </div>
         <div class="container-fluid fixed-card">
         <h2>Welcome, {{Auth::user()->firstname}} {{Auth::user()->lastname}} </h2>
        </div>
    </div>
</div>
@endsection

