 <!DOCTYPE html>
 <html lang="en">
 <x-app-layout>

     @include('layout.header')

     <!-- Hero Section -->
     <section id="hero">
         <div class="hero-content">
             <h1>Begin Your Fantastic Travel Experience Here</h1>
             <p>Discover financial freedom and travel services that allow you to live life to the fullest.</p>
         </div>
     </section>

     <!-- Partner Section -->
     <section id="partners">
         <div class="container">
             <h1 style="font-size: 50px">Partner with</h1>
             <p>We are trusted partner og airlines. payment gateways, and travel services around the world</p>
             <div class="partner-logos">
                 <img src="{{ asset('img/paypal.png') }}" alt="PayPal" height="100px" width="100px">
                 <img src="{{ asset('img/stripe.png') }}" alt="Stripe" height="100px" width="100px">
                 <img src="{{ asset('img/visa.png') }}" alt="Visa" height="100px" width="100px">
                 <img src="{{ asset('img/mastercard.png') }}" alt="MasterCard" height="100px" width="100px">
             </div>
         </div>
     </section>

     <!-- Featured Packages -->
     <section id="packages">
         <div class="container">
             <div style="display: flex; align-items: center; justify-content: space-between;">
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Featured Package
                 </h2>

                 @if (auth()->user() && auth()->user()->roleName === 'admin')
                     <form action="{{ route('package.add') }}" method="post">

                         <x-primary-button>{{ __('add package') }}</x-primary-button>
                     </form>
                 @endif
             </div>
         </div>


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
     </section>

     <!-- Activities Section -->
     <section id="activities">
         <div class="container">
             <div style="display: flex; align-items: center; justify-content: space-between;">
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Travel By Activities
                 </h2>
                 @if (auth()->user() && auth()->user()->roleName === 'admin')
                     <form action="{{ route('activity.add') }}" method="post">
                         <x-primary-button>{{ __('add Activity') }}</x-primary-button>
                     </form>
                 @endif
             </div>
             <div class="activities-grid">
                 @foreach ($allActivities as $activity)
                     <div class="card">
                         <img src="{{ asset('photos/activities/' . $activity->photo) }}" alt="activity Photo"
                             style="width: 200px; height:100px; ">
                         <h3>{{ $activity->name }}</h3>
                         <p> {{ $activity->description }}</p>
                         @if (auth()->user() && auth()->user()->roleName === 'admin')
                             <a href="{{ route('activity.edit', $activity->id) }}"><button
                                     style="background-color: blue">Update</button></a>
                             <a href="{{ route('activity.delete', $activity->id) }}"><button
                                     style="background-color: red">Delete</button></a><br>
                         @endif

                     </div>
                 @endforeach



             </div>
     </section>

     <!-- Deals Section -->
     <section id="deals">
         <div class="container">
             <div style="display: flex; align-items: center; justify-content: space-between;">
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Flight Offer Deals
                 </h2>
                 @if (auth()->user() && auth()->user()->roleName === 'admin')
                     <form action="{{ route('deal.add') }}" method="post">
                         <x-primary-button>{{ __('add Deal') }}</x-primary-button>
                     </form>
                 @endif
             </div>
             <div class="deals-grid">
                 @foreach ($alldeals as $deal)
                     <div class="card">
                         <img src="{{ asset('photos/deals/' . $deal->photo) }}" alt="deal Photo"
                             style="width: 200px; height:100px; ">
                         <h3>{{ $deal->name }}</h3>
                         <p>$ {{ $deal->price }}</p>
                         @if (auth()->user() && auth()->user()->roleName === 'admin')
                             <a href="{{ route('deal.edit', $deal->id) }}"><button
                                     style="background-color: blue">Update</button></a>
                             <a href="{{ route('deal.delete', $deal->id) }}"><button
                                     style="background-color: red">Delete</button></a><br>
                         @endif
                         <a href=""><button>Book Now</button></a>
                     </div>
                 @endforeach

             </div>
         </div>
     </section>

     <!-- Testimonials Section -->
     <section id="testimonials">
         <div class="container">
             <div style="display: flex; align-items: center; justify-content: space-between;">
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     What our clients are saying about us?
                 </h2>
                 @if (auth()->user() && auth()->user()->roleName === 'user')
                     <form action="{{ route('commant.add') }}" method="post">
                         <x-primary-button>{{ __('add commant') }}</x-primary-button>
                     </form>
                 @endif
             </div>
             <div class="testimonial-slider">
                 @foreach ($allCommant as $commant)
                     <div class="testimonial">
                         <p>"{{ $commant->commant }}"</p>
                         <h3>- {{ $commant->username }}</h3>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>

     <!-- Footer -->
     @include('layout.footer')
     </body>


 </x-app-layout>

 </html>
