@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    {{-- @include('includes.inner_top_search') --}}
    <!-- Inner Page Title end -->

    <div class="about-wraper bg-grey">
        <div class="container bg-white padding-50">


            <h2 class="text-center">{{ __($cmsContent->page_title) }}</h2>
            <p>{!! __($cmsContent->page_content) !!}</p>


        </div>
    </div>
    @include('includes.footer')
@endsection
