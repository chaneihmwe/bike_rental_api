@extends('backend.backend_template')
@section('content')
<div class="container">
     <div class="row">
        <div class="col">
            <h1>Edit Brand</h1>
        </div>
        <div class="col col-lg-2">
            <a class="btn btn-primary" href="{{URL::previous()}}">
                <i class="fas fa-backward">  Back</i>
            </a>
        </div>
     </div>
 </div>
<div class="container ">
    <div class="row">
        <div class="col-md-6 offset-3 card p-5">        
            <form method="post" action="{{ route('admin.brand.update',$brand->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="">Brand Name:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$brand->name}}" autofocus>
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Category<i color="red">*</i></label>  
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    <?php if ($category->id == $brand->category_id): ?>
                                        <?php echo "selected"; ?>
                                    <?php endif ?>
                                >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4 offset-4">
                    <input type="submit" value="Update" class="btn btn-primary ">
                </div>
            </form>
        </div>
    </div>  
</div>
@endsection