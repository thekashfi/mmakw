   @if(!empty($servicesMenus))
   <section class="case-studies-section" id="services">
            <div class="container">
                <div class="row animatedParent">
                    <div class="col col-xs-12">
                        <div class="section-title-s3 slower animated bounceIn">
                            <span>{{__('webMessage.ourbestservices')}}</span>
                            <h2>{{__('webMessage.ourservices')}}</h2>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
            <div class="content-area">
                <div class="case-studies-grids case-studies-slider animatedParent">
                
                @foreach($servicesMenus as $servicesMenu)
                            
                    <div class="grid slower animated bounceInDown">
                        <div class="img-holder">
                           @if($servicesMenu->image)
                            <img src="{{url('uploads/services/thumb/'.$servicesMenu->image)}}" alt="@if(app()->getLocale()=='en') {{$servicesMenu->title_en}} @else {{$servicesMenu->title_ar}} @endif">
                            @else
                            <img src="{{url('uploads/no-image.png')}}" alt="@if(app()->getLocale()=='en') {{$servicesMenu->title_en}} @else {{$servicesMenu->title_ar}} @endif">
                            @endif
                        </div>
                        <div class="overlay">
                            <div class="content">
                                <h3><a href="{{url('/services/'.$servicesMenu->slug)}}">@if(app()->getLocale()=="en") {{$servicesMenu->title_en}} @else {{$servicesMenu->title_ar}} @endif</a></h3>
                            </div>
                        </div>
                    </div>
                    
                @endforeach    
                    
                </div>
            </div>
        </section>
        @endif