@extends('backend')

@section('title', 'Items')

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
          <h2 class="d-inline-block">Item List</h2>
          <a href="{{route('item.create')}}" class="btn btn-info float-right">Add New</a>
          <table class="table mt-3 table-bordered dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php 
                $i=1;
              @endphp
              @foreach($items as $item)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$item->name}}</td>
                  <td><img src="{{$item->photo}}" class="img-fluid" width="100px"></td>
                  <td>
                    @if($item->discount > 0)
                    {{number_format($item->discount)}}
                    @else
                      {{number_format($item->price)}}
                    @endif
                  </td>
                <td>
                  <a href="{{route('item.edit',$item->id)}}" class="btn btn-warning">Edit</a>
                  <a href="{{route('item.show',$item->id)}}" class="btn btn-info">Show</a>
                  <form method="post" action="{{route('item.destroy',$item->id)}}" class="d-inline-block" onsubmit="return confirm('Are you Sure to Delete?')">
                    @csrf
                    @method('DELETE')
                    <input type="submit" name="btnsubmit" value="Delete" class="btn btn-danger">
                  </form>
                  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

@endsection

@section('script')
  <script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    $('.dataTable').DataTable();
  </script>
@endsection