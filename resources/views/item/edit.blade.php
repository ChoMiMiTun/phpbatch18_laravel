@extends('backend')

@section('title', 'Create Item')

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


{{--     @if (isset($errors) && count($errors))
     
            There were {{count($errors->all())}} Error(s)
                        <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                        </ul>
                
        @endif --}}

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title my-3 py-3">Item Edit Form</h3>
          <form method="post" action="{{route('item.update',$item->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label class="control-label col-md-2">Item Name:</label>
              <div class="col-md-9">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$item->name}}">
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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#old" role="tab" aria-controls="home" aria-selected="true">Old</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#new" role="tab" aria-controls="profile" aria-selected="false">New</a>
                  </li>
                </ul>
                  <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="old" role="tabpanel" aria-labelledby="home-tab">
                      <img src="{{asset($item->photo)}}" class="img-fluid" alt="">
                      <input type="hidden" name="oldphoto" value="{{$item->photo}}">
                    </div>
                    <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="profile-tab">
                      <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                      @error('photo')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
            </div>

              <div class="form-group row">

                <div class="col-md-2">
                    <label for="price" class="col-form-label"> Price </label>
                </div>
                
                <div class="col-md-9">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price"> Price </a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" id="discount-tab" data-toggle="tab" href="#discount" role="tab"> Discount </a>
                      </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="price" role="tabpanel" aria-labelledby="price-tab">
                          <input type="text" name="price" class="form-control my-3 @error('price') is-invalid @enderror" value="{{$item->price}}">
                 @error('price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                 @enderror
                      </div>
                  
                 <div class="tab-pane fade" id="discount" role="tabpanel">
                    <input type="text"  id="discount" name="discount" class="form-control my-4 @error('discount') is-invalid @enderror" value="{{$item->discount}}">
                     @error('discount')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                      </div>
                  </div> 
                </div> 

              </div>

              <div class="form-group row">
                  <label for="brand" class="col-md-2 col-form-label"> Brand </label>
                  <div class="col-md-9">
                    <select class="form-control" id="brand" name="brand">
                        <option>Choose Brand</option>
                        @foreach($brands as $brand)
                          <option value="{{$brand->id}}" @if($brand->id == $item->brand_id) {{'selected'}} @endif>{{$brand->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="category" class="col-md-2 col-form-label"> Category </label>
                  <div class="col-md-9">
                    <select class="form-control" id="category" name="category">
                        <option>Choose Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="subcategory" class="col-md-2 col-form-label"> Subcategory </label>
                  <div class="col-md-9">
                    <select class="form-control" id="subcategory" name="subcategory">
                        <option>Choose subcategory</option>
                        @foreach($subcategories as $subcategory)
                          <option value="{{$subcategory->id}}" @if($subcategory->id == $item->subcategory_id) {{'selected'}} @endif>{{$subcategory->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="description" class="col-md-2 col-form-label"> Description </label>
                  <div class="col-md-9">
                    <textarea rows="4" class="form-control" id="description" name="description">
                      {{$item->description}}
                    </textarea>
                  </div>
              </div>

            <div class="form-group row">
              <div class="offset-2 col-md-9">
                <input type="submit" name="btnsubmit" value="Save" class="btn btn-primary">
                <a href="{{route('item.index')}}" class="btn btn-outline-primary ml-2">Back</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection