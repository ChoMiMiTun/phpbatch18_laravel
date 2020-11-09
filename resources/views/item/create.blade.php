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

    @if (isset($errors) && count($errors))
     
            There were {{count($errors->all())}} Error(s)
                        <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                        </ul>
                
        @endif

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title my-3 py-3">Item Create Form</h3>
          <form method="POST" action="{{route('item.store')}}" enctype="multipart/form-data" class="my-3">
             @csrf
            <div class="form-group row">
              <label class="control-label col-md-2">Item Name:</label>
              <div class="col-md-9">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Item Name..." value="{{old('name')}}">
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

              <div class="col-md-2">
                  <label for="price" class="col-form-label"> Price </label>
              </div>
              
              <div class="col-md-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price"> Current </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="discount-tab" data-toggle="tab" href="#discount" role="tab"> Discount </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="price" role="tabpanel" aria-labelledby="price-tab">
                        <input type="text" name="price" class="form-control my-3" placeholder="Current Price ..." value="{{old('price')}}">
                    </div>
                
                    <div class="tab-pane fade" id="discount" role="tabpanel">
                        <input type="text"  id="discount" name="discount" class="form-control my-3" value="0" placeholder="Discount Price..." value="{{old('discount')}}">
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
                          <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

            <div class="form-group row">
              <label for="category" class="col-md-2 col-form-label">Categories:</label>
              <div class="col-md-9">
                <select name="category" class="form-control category">
                <option label="Choose Category">
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </option>
              </select>
              </div>
            </div>

              <div class="form-group row">
                  <label for="subcategory" class="col-md-2 col-form-label"> Subcategory </label>
                  <div class="col-md-9">
                    <select class="form-control" id="subcategory" name="subcategory">
                        <option>Choose subcategory</option>
                        @foreach($subcategories as $subcategory)
                          <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="description" class="col-md-2 col-form-label"> Description </label>
                  <div class="col-md-9">
                    <textarea rows="4" class="form-control" id="description" name="description" placeholder="Item Detail Description...">{{old('description')}}</textarea>
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

@section('script')
  <script type="text/javascript">
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('.category').change(function () {
        let categoryid = $(this).val();
        // alert(categoryid);
        $.post("{{route('filterCategory')}}",{cid:categoryid},function (response) {
          // console.log(response);
          var html = "";
          for(let row of response){
            html+=`<option value="${row.id}">${row.name}</option>`;
          }
          $('.subcategory').prop('disabled',false);
          $('.subcategory_option').html(html);
        })
      })
    })
  </script>
@endsection