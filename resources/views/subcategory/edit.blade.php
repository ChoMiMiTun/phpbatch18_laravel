@extends('backend')

@section('title', 'Subcategory Edit')

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
          <h3 class="tile-title my-3">Subcategory Create Form</h3>
          <form method="post" action="{{route('subcategory.update', $subcategory->id)}}" class="my-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label class="control-label col-md-2">Name:</label>
              <div class="col-md-9">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$subcategory->name}}">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-2">Category:</label>
              <div class="col-md-9">
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                  @error('category_id')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                  <option>Select Category</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}" {{$category->id == $subcategory->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
              </select>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-2 col-md-9">
                <input type="submit" name="btnsubmit" value="Update" class="btn btn-primary">
                <a href="{{route('subcategory.index')}}" class="btn btn-outline-primary ml-2">Back</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection