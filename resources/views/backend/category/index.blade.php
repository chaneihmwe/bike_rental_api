 @extends('backend.backend_template')
 @section('content')
 <div class="container">
     <div class="row">
         <div class="col">
            <h1>Category</h1>
         </div>
         <div class="col col-lg-2">
             <a class="btn btn-primary" href="{{route('admin.category.create')}}">
                <i class="fas fa-plus">Add Category</i>
             </a>
         </div>
     </div>
 </div>
 <div class="container">      
     <div class="row">
        @if (session('status'))
          <div class="alert alert-success col-md-6 offset-3">
              {{ session('status') }}
          </div>
        @endif
         <div class="col-lg-12 p-3 card">             
             <form action="{{route('admin.category.store')}}" method="post">
                <table class="table align-items-center table-white" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $row)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $row->name }}</td>                   
                                <td>
                                    <form  method="post" action="{{route('admin.category.destroy',$row->id)}}" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('admin.category.edit',$row->id)}}" class="btn btn-outline-primary">Edit</a>
                                        <input type="submit" class="btn btn-outline-primary" value="Delete">
                                    </form>
                                </td>                          
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
             </form>
         </div>
     </div>
 </div>
@endsection