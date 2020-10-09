@extends('backend_template')
@section('content')

<!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Brand List</h6>
      <a href="{{route('brand.create')}}" class="btn btn-outline-success btn-sm float-right"><i class="fas fa-plus"></i>Add Brand</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @php $i=1; @endphp
            @foreach($brands as $brand)
            @php 
                $id=$brand->id;
                $name=$brand->name;
                $photo=$brand->photo;
            @endphp
            <tr>
              <td>{{$i++}}.</td>
              <td>
                <img src="{{asset($photo)}}" class="img-fluid" style="width: 70px;">
                {{$name}}
              </td>
              <td>
                <a href="{{route('brand.show',$brand->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-warning">
                  <i class="fas fa-wrench"></i>
                </a>
                <form action="{{route('brand.destroy',$brand->id)}}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-outline-danger">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection