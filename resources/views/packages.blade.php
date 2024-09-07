 @include('layout.header')

 <div class="package-grid">
     @foreach ($allPackages as $package)
         <div class="card">
             <img src="{{ asset('photos/packages/' . $package->photo) }}" alt="Package Photo"
                 style="width: 200px; height:100px; ">
             <h3>{{ $package->name }}</h3>
             <p>$ {{ $package->price }}</p>
             @if (auth()->user() && auth()->user()->roleName === 'admin')
                 <a href="{{ route('package.edit', $package->id) }}"><button
                         style="background-color: blue">Update</button></a>
                 <a href="{{ route('package.delete', $package->id) }}"><button
                         style="background-color: red">Delete</button></a><br>
             @endif
             <a href=""><button>Book Now</button></a><br>
         </div>
     @endforeach
 </div>
