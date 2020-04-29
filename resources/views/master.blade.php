@include('pages.layouts.header')
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                @include('pages.layouts.slider')
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                @include('pages.layouts.leftmenu')
                
                <div class="col-sm-9 padding-right">
                    
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
@include('pages.layouts.footer')  