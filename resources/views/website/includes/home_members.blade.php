@if($memberslists)
<section id="section-features" class="text-light jarallax">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                <h1>{{__('webMessage.membershiplistings')}}</h1>
                <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                <div class="spacer-single"></div>
            </div>
        </div>

        <div class="row mt50">
            @foreach($memberslists as $memberslist)
                @if($memberslist->image)
                    <div class="col-lg-4 mt-70 sm-mt0 px-md-1 mt-sm-none fadeInRight" data-wow-delay=".3s">
                        <img class="mw-100" src="{{url('uploads/memberships/'.$memberslist->image)}}" alt="">
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif
