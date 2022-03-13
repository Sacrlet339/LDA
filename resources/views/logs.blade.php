@extends('layouts.app')

@section('content')

<div class="mainContent">
    <div class="container-fluid">
        <div class="container-fluid px-4 py-4 d-flex justify-content-end">

        </div>
         <div class="container-fluid fixed-card">
            <div class="card  py-4 px-4">
                <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Model</th>
                            <th scope="col">Action</th>
                            <th scope="col">Completed By</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)<tr>
                                <th >{{ $log->id }}</th>
                                <td>{{ $log->model }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->firstname }} {{ $log->lastname }}</td>
                                <td>{{ $log->created_at }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

