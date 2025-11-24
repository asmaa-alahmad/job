
    @php
        use Illuminate\Support\Str;
        // دالة لتحديد عدد كلمات معين
        function word_limit($text, $limit = 20) {
            $words = explode(' ', $text);
            return count($words) > $limit
                ? implode(' ', array_slice($words, 0, $limit)) . '...'
                : $text;
        }
    @endphp
   
@if (isset($packages) && count($packages))

    <div class="section testimonialwrap">
        <div class="container">
            <div class="paypackages"> 
                <!---four-paln-->
                <div class="titleTop">
                        <h3>{{__('Plans')}}</h3>
                </div>
                    <div class="row" style="display: flex;flex-wrap: wrap;width: 90%;margin: auto;padding: 1rem;gap: 20px;justify-content: center;"> 
                        @foreach($packages as $package)
                                
                                    <div class="col-lg-3 col-md-6 col-sm-12 m-center plan_card" style="border: 1px solid #bebbbb;border-radius: 9px;padding: 1rem;" >
                                        <ul class="boxes">
                                            <li class="plan-name plan_title">{{$package->package_title}} </li>
                                            <li>
                                                <div class="main-plan">
                                                    <div class="plan-price1-2">{{$package->package_price}}</div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </li>
                                            
                                            <li class="plan-pages"> {{__('For')}} {{$package->package_num_days}} {{__('Days')}}</li>           
                                            <!-- <li class="plan-pages"> {{$package->description}}  </li>    -->
                                            <!-- <li class="plan-pages" id="basic-{{ $loop->index }}" >{{ Str::limit($package->description, 100, '...') }}  </li>  -->
                                            <li class="plan-pages" id="basic-{{ $loop->index }}" >@php echo word_limit($package->description, 20); @endphp </li> 
                                            <li class="plan-pages"  style="display: none;" id="more-{{ $loop->index }}" class="more-text" > {{ $package->description }} </li>
                                            <br>
                                            <button onclick="toggleMore({{ $loop->index }})" id="see_more_btn-{{ $loop->index }}" class="see_more_btn">قراءة المزيد <i class="fa fas-plus-lg"></i></button>  
                                            <!-- <li class="plan-pages @if($package->package_price == 0) disabled @endif"><i class="far fa-check-square"></i> {{__('Premium Support 24/7')}}</li>    -->
                                            <li class="order paypal"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#buypack{{$package->id}}" class="reqbtn">{{__('Buy Now')}} <i class="fas fa-arrow-right"></i></a></li>
                                        </ul>
                                        
                                    </div>    
                                    
                                <script>
                                    function toggleMore(index) {
                                        const more = document.getElementById("more-" + index);
                                        const basic = document.getElementById("basic-" + index);
                                        const see_more_btn = document.getElementById("see_more_btn-" + index);
                                        
                                        if (more.style.display === "none") {
                                            more.style.display = "inline";
                                            basic.style.display = "none";
                                            see_more_btn.innerText = "إقرأ أقل";
                                        } else {
                                            more.style.display = "none";
                                            basic.style.display = "inline";
                                            see_more_btn.innerText = "قراءة المزيد";
                                        }
                                    }
                                </script>
                        @endforeach 
                    </div>
                <!---end four-paln--> 
            </div>
        </div>
    </div>
@endif