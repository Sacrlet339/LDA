@extends('layouts.app')

@section('content')
<div class="mainContent">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    <div class="container">
        <div class="container px-4 py-4 d-flex justify-content-end">
        <button class="btn btn-primary" onclick="displayCreateCompany()" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-plus"></i> Create company</button>
        </div>
        <div class="card fixed-card">
            <div class="card-body table-wrapper-scroll-y">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tel</th>
                        <th scope="col">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <th scope="row">{{ $company->id }}</th>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->tel }}</td>
                            <td>{{ $company->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ route('post company') }}" method="POST">
    @csrf
      <div class="modal-header">
        <h5 class="modal-title">Create Company</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Name</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autofocus>
              @error('name')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Email</label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" >
              @error('email')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Tel</label>
              <input type="tel" name="tel" id="tel" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" >
              @error('tel')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
@endsection

<script>
    function displayCreateCompany(){
        console.log("here");
    }
</script>
