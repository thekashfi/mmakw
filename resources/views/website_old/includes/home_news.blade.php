@if(count($newseventslists))

<section class="blog-section" id="news">
            <div class="container">
                <div class="row animatedParent">
                    <div class="col col-md-4">
                        <div class="section-title-s4 slower animated fadeInLeft">
                            <span>{{__('webMessage.latestnews')}}</span>
                            <h3>{{__('webMessage.checkoutlatestnewsevents')}}</h3>
                            <div class="my_clear20x"></div>
                            <a href="{{url('/news')}}" class="mybutton">{{__('webMessage.viewmore')}}</a>
                            
                        </div>
                    </div>
                    <div class="col col-md-8">
                        <div class="blog-grids clearfix">
                        @foreach($newseventslists as $newseventslist)
                            <div class="grid">
                                <div class="entry-media slower animated fadeInDown">
                                    @if($newseventslist->image)
                                    <img src="{{url('uploads/newsevents/'.$newseventslist->image)}}" alt>
                                    @endif
                                </div>
                                <div class="entry-details slower animated fadeInUp">
                                    <!--<div class="cat">Business, Law</div>-->
                                    @if($newseventslist->title_en && app()->getLocale()=="en")
                                    <h4><a href="{{url('newsdetails/'.$newseventslist->slug)}}">{{$newseventslist->title_en}}</a></h4>
                                    @else
                                    <h4><a href="{{url('newsdetails/'.$newseventslist->slug)}}">{{$newseventslist->title_ar}}</a></h4>
                                    @endif
                                </div>
                            </div>
                        @endforeach    
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
       
 @endif       