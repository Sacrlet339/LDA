@extends('layouts.app')

@section('content')
<div class="mainContent">
    <div class="container">
        <div class="container px-4 py-4 d-flex justify-content-end">
        <a href="{{ route('create company') }}" class="btn btn-primary"><i class="fa-regular fa-plus"></i> Create company</a>
        </div>
        <div class="card fixed-card">
            <div class="card-body table-wrapper-scroll-y">
                body
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function displayCreateCompany(){
        console.log("here");
    }
</script>
