@extends('backend.backend_template')
@section('content')
<div class="container">
     <div class="row">
         <div class="col">
             <h1>Create Category</h1>
         </div>
         <div class="col col-lg-2">
             <a class="btn btn-primary" href="{{route('admin.category.index')}}">
                 <i class="fas fa-list-ul"> Category List</i>
             </a>
         </div>
     </div>
 </div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 card p-5">
            <form action="{{route('admin.category.store')}}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="">Category Name<i color="red">*</i></label>   
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="title" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>        
                <div class="form-group col-4 offset-4">
                    <input type="submit" value="Save" class="form-control btn btn-primary " >
                </div>
            </form>    
        </div>
    </div>    
</div>
@endsection