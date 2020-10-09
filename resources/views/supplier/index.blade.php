@extends('backend_template')
@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Category List</h6>
		<a href="{{route('supplier.create')}}" class="btn btn-outline-success btn-sm float-right"><i class="fas fa-plus">Add Supplier</i></a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Logo</th>
						<th>Name</th>
						<th>Phone No</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>No.</th>
						<th>Logo</th>
						<th>Name</th>
						<th>Phone No</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					@php $i=1; @endphp
					@foreach($suppliers as $supplier)
					<tr>
						<td>{{$i++}}.</td>
						<td>
							<img src="{{asset($supplier->logo)}}" class="img-fluid" style="width: 70px;">
						</td>
						<td>{{$supplier->name}}</td>
						<td>{{$supplier->phoneno}}</td>
						<td>{{$supplier->address}}</td>
						<td>
							<a href="{{route('supplier.show',$supplier->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
							<a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-warning">
								<i class="fas fa-wrench"></i>
							</a>
							<form action="{{route('supplier.destroy',$supplier->id)}}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
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