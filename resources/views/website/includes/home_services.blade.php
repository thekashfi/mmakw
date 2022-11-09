@if(!empty($servicesMenus))
<section id="section-services" class="no-top mt150">
    <div class="container">
        <div class="row">

{{--            <span>{{__('webMessage.ourbestservices')}}</span>--}}
{{--            <h2>{{__('webMessage.ourservices')}}</h2>--}}

            @foreach($servicesMenus as $servicesMenu)
            <div class="col-lg-3 mt-70 sm-mt0 text-middle text-light wow fadeInRight" data-wow-delay="0">
                <div class="shadow-soft" data-bgimage="url({{ $servicesMenu->image ? url('uploads/services/thumb/'.$servicesMenu->image) : url('uploads/no-image.png')}})">
                    <div class="padding40 overlay60">
                        <h3>@if(app()->getLocale()=="en") {{$servicesMenu->title_en}} @else {{$servicesMenu->title_ar}} @endif</h3>
                        <p>
                            {{ Illuminate\Support\Str::limit(strip_tags((app()->getLocale()=="en" ? $servicesMenu->details_en : $servicesMenu->details_ar)), 180, '...') }}
                        </p>
                        <a href="{{url('/services/'.$servicesMenu->slug)}}" class="btn-line btn-fullwidth">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
