@extends('backend_template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
           <a href="{{route('staff.index')}}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>
   </div>
   <form>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <img src="{{$staff->profile}}" alt="Supplier Photo" class="img-fluid w-50">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 ">
                <h3>Name: {{$staff->user->name}}</h3>
                <h3>Email:{{$staff->user->email}}</h3>
                <h3>Phone No.: {{$staff->phoneno}}</h3>
                <h3>Address: {{$staff->address}}</h3>
            </div>
        </div>
    </div>
</form>

</div>
@endsection