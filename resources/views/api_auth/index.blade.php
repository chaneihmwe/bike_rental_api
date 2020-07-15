 @extends('backend.backend_template')
 @section('content')
 <div class="container">
     <div class="row">
         <div class="col">
            <h1>Authentication Token</h1>
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
        <?php $jsons = null ?>
        @if($jsons != null)
         <div class="col-lg-12 p-3 card">             
                @foreach($jsons as $json)
                    <ul>
                        <li>{{ $json }}</li>                    
                    </ul>
                @endforeach
         </div>
         @endif
     </div>
 </div>
@endsection