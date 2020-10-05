@extends('backend_template')
@section('content')

<!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stock List</h6>
      <a href="{{route('stock.create')}}" class="btn btn-outline-success btn-sm float-right"><i class="fas fa-plus"></i>Add Item</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Code No.</th>
              <th>Item Name</th>
              <th>Price (per)</th>
              <th>Quantity</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Code No.</th>
              <th>Item Name</th>
              <th>Price (per)</th>
              <th>Quantity</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @php $i=1; @endphp
            @foreach($stocks as $row)
            <tr>
              <td>{{$i++}}.</td>
              <td>{{$row->item->codeno}}</td>
              <td>{{$row->item->name}}</td>
              <td>{{$row->perprice}}</td>
              <td>{{$row->quantity}}</td>
              <td>{{$row->in_date}}</td>
              <td>
                <a href="{{route('stock.show',$row->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i>Detail</a>
                <a href="{{route('stock.edit',$row->id)}}" class="btn btn-warning">
                  <i class="fas fa-tools">Edit</i>
                </a>
                {{-- <form action="{{route('row.destroy',$row->id)}}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-outline-danger">
                    <i class="fas fa-times"></i>Delete
                  </button>
                </form> --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection