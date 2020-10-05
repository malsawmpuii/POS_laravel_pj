@extends('backend_template')
@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
           <a href="{{route('brand.index')}}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>
   </div>
   <form>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <img src="{{$brand->photo}}" alt="Brand Photo" class="w-50">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 ">
                <h3>Name: {{$brand->name}}</h3>
            </div>
        </div>
    </div>
</form>

</div>
@endsection