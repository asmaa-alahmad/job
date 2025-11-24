<div class="section">
    <div class="container">
        <!-- title start -->
        <div class="titleTop text-center">
            <h3>{{ __('Job Seeker') }}</h3>
        </div>
        <ul class="jobslist newjbox row">
            @if (isset($seekers) && count($seekers))
                @foreach ($seekers as $seeker)
                    <!--Job start-->
                    <li class="col-lg-4 col-md-6">
                         <div class="card" id="card-1">
    <div class="avatar">
       {{ $seeker->printUserImage() }}
    </div>
    <div class="header">
      <h2>{{ $seeker->name }}</h2>

    </div>
    <div class="colorband"></div>
    <div class="desc">Morgan has collected ants since they were six years old and now has many dozen ants but none in their pants.</div>
    <div class="actions">
      <button><span><i class="far fa-heart"></i><span>Like</span></span></button>
      <button><span><i class="fas fa-retweet"></i><span>Trade</span></span></button>
    </div>
  </div>






                        


                    </li>
                    <!--Job end-->
                @endforeach
            @endif
        </ul>
        <!-- title end -->


        <!--view button-->
        <div class="viewallbtn"><a href="{{ route('job.list') }}">{{ __('View All Latest Jobs') }}</a></div>
        <!--view button end-->
    </div>
</div>
