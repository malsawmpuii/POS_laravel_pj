@extends('backend_template')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> 
           Create New Staff 
           {{-- Error --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
           <a href="{{ route('staff.index') }}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward">Back</i> </a>
       </h6>

   </div>
   <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">  
    @csrf

    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="photo"> Profile </label>
                <input type="file" class="form-control-file" id="photo" name="profile">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="name"> Name </label>
                <input type="text" class="form-control" id="name" placeholder="Staff Name" name="name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="name"> Email </label>
                <input type="email" class="form-control" id="email" placeholder="Your Email" name="email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="phoneno"> Phone No. </label>
                <input type="text" id="phoneno" name="phoneno" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="address"> Address </label>
                <input type="text" id="address" name="address" class="form-control">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="reset" class="btn btn-secondary text-uppercase mr-2"> 
            <i class="fas fa-times mr-2"></i> Cancel 
        </button>
        <button type="submit" class="btn btn-primary text-uppercase"> 
            <i class="fas fa-save mr-2"></i> Save 
        </button>
    </div>
</form>

</div>
@endsection