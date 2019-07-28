@include('layouts.header')
@include('layouts.nav')
<!--main container -->
    <div class="main col-xs-12">
        <section class="main__content">
            <div class="col-xs-12 col-lg-12">
                 @section('messages')
                    @include('flash::message')
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                                      
                 @show
                 @yield('content')
             </div>
        </section>
    </div>
</div>    </div>   </div>   
@include('layouts.footer')
       