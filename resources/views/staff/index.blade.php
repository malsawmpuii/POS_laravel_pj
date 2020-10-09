@extends('backend_template')
@section('content')
<!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Staff List</h6>
      <a href="{{route('staff.create')}}" class="btn btn-outline-success btn-sm float-right"><i class="fas fa-plus"></i>Add Staff</a>
    </div>
   <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No.</th>
            <th>Profile</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          @php $i=1; @endphp
          @foreach($staff as $row)
          <tr>
            <td>{{$i++}}.</td>
            <td>{{$row->user->name}}</td>
            <td>{{$row->user->email}}</td>
            <td>{{$row->phoneno}}</td>
            <td>{{$row->address}}</td>
            <td>
              <a href="{{route('staff.show',$row->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
              <a href="{{route('staff.edit',$row->id)}}" class="btn btn-warning">
                <i class="fas fa-wrench"></i>
              </a>
              <form action="{{route('staff.destroy',$row->id)}}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
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