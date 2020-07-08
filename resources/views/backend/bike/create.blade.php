@extends('backend.backend_template')
@section('content')
<div class="container">
     <div class="row">
         <div class="col">
             <h1>Create Bike</h1>
         </div>
         <div class="col col-lg-2">
             <a class="btn btn-primary" href="{{route('admin.bike.index')}}">
                 <i class="fas fa-list-ul"> Bike List</i>
             </a>
         </div>
     </div>
 </div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 card p-5">
            <form action="{{route('admin.bike.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Category<i color="red">*</i></label>  
                    <select class="form-control" name="category_id" id="category">
                        <option disabled="disabled" selected="selected">Choose Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="brand_id">
                    
                </div>
                <div class="form-group">
                    <label for="number">Number<i color="red">*</i></label>   
                    <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="title" autofocus>
                    @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="model">Model<i color="red">*</i></label>   
                    <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model') }}" required autocomplete="title" autofocus>
                    @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="color">Color<i color="red">*</i></label>   
                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="title" autofocus>
                    @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="image">Image<i color="red">*</i></label>   
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="title" autofocus>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price<i color="red">*</i></label>   
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="title" autofocus>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description<i color="red">*</i></label>
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="title" autofocus>{{ old('description') }}</textarea>
                    @error('description')
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function (argument) {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

        })
        $('#category').change(function (argument) {
            var category_id = $('#category').val();
            console.log(category_id);
            var url="{{route('admin.get_brands',':id')}}";
            url=url.replace(':id',category_id);
            $.ajax({
                type : 'get',
                url : url,
                processData : false,
                contentData: false,
                success:(data) => {
                    var j =1;
                    var html = '';
                    console.log(data);
                    $.each(data,function(i,v){
                        html += `
                            <label for="${v.id}">${v.name}</label>
                            <input type="radio" name="brand_id" id="${v.id}" value="${v.id}">`;
                    })
                    $('#brand_id').html(html);
                },
                error: function(error){
                    console.log(error);
                }
            });
        })
    </script>
@endsection