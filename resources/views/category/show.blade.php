@extends('backend')

@section('title', 'Category Show')

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
          <h3 class="my-3">Category Detail</h3>
          <h3>{{$category->name}}</h3>
          <p><img src="{{asset($category->photo)}}" class="img-fluid" alt=""></p>

          <a href="{{route('category.index')}}" class="btn btn-outline-primary ml-2">Back</a>
          
        </div>
      </div>
    </div>
  </main>

@endsection