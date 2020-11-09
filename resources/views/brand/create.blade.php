@extends('backend')

@section('title', 'Create')

@section('content')
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Blank Page</h1>
        <p>Start a beautiful journey here</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title my-3">Brand Create Form</h3>
          <form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data" class="my-3">
             @csrf
            <div class="form-group row">
              <label class="control-label col-md-2">Name:</label>
              <div class="col-md-9">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                 @error('name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-2">Photo: (<small class="text-danger">* jpeg|bmp|png</small>)</label>
              <div class="col-md-9">
                <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                 @error('photo')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                 @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-2 col-md-9">
                <input type="submit" name="btnsubmit" value="Save" class="btn btn-primary">
                <a href="{{route('brand.index')}}" class="btn btn-outline-primary ml-2">Back</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection