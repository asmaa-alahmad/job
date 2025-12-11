{!! Form::model($user, [
    'method' => 'put',
    'route' => ['my.profile'],
    'class' => 'form form-profile',
    'files' => true,
]) !!}

<h5>{{ __('Account Information') }}</h5>
@if ($user->is_active == 0)
    <span class="alert alert-warning d-inline pending">{{ __('pending') }}</span>
@else
    <span class="alert alert-success d-inline pending">{{ __('active') }}</span>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
            <label for="">{{ __('Email') }}</label>
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => __('Email')]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!}
        </div>
    </div>


    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
            <label for="">{{ __('Password') }}</label>
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => __('Password')]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!}
        </div>
    </div>
</div>

<hr>

<h5>{{ __('Personal Information') }}</h5>

<div class="row">
    <div class="col-md-6">
        <div class="userimgupbox">
            <div class="imagearea">
                <label>{{ __('Profile Image') }} <span>*</span></label>
                {{ ImgUploader::print_image("user_images/$user->image", 100, 100) }}
            </div>
            <div class="formrow">
                <div id="thumbnail"></div>
                <label class="btn btn-default"><i class="fas fa-upload"></i> {{ __('Select Profile Image') }}
                    <input type="file" name="image" id="image" style="display: none;">
                </label>
                {!! APFrmErrHelp::showErrors($errors, 'image') !!}
            </div>
        </div>


    </div>
    {{-- <div class="col-md-6">
        <div class="userimgupbox">
            <div class="imagearea">
                <label>{{ __('Cover Photo') }}</label>
                {{ ImgUploader::print_image("user_images/$user->cover_image", 200, 90) }}
            </div>
            <div class="formrow">
                <div id="thumbnail_cover_image"></div>
                <label class="btn btn-default"><i class="fas fa-upload"></i> {{ __('Select Cover Photo') }}
                    <input type="file" name="cover_image" id="cover_image" style="display: none;">
                </label>
                {!! APFrmErrHelp::showErrors($errors, 'cover_image') !!}
            </div>
        </div>
    </div> --}}

    <div class="col-md-6">
    <div class="userimgupbox">
        
        <!-- Preview Area -->
        <div class="imagearea">
            <label>{{ __('CV Document') }}</label>

            @if (!empty($user->cv_document))
                <a href="{{ url('user_documents/' . $user->cv_document) }}" target="_blank"
                    class="btn btn-primary btn-sm" style="margin-top: 10px;">
                    <i class="fas fa-file-pdf"></i> {{ __('Open CV') }}
                </a>
            @else
                <p class="text-muted" style="margin-top: 10px;">{{ __('No CV uploaded') }}</p>
            @endif
        </div>

        <!-- Upload / Edit Button -->
        <div class="formrow">
            <div id="thumbnail"></div>

            <label class="btn btn-default">
                <i class="fas fa-upload"></i> 
                {{ !empty($user->cv_document) ? __('Select CV') : __('Upload CV') }}

                <input type="file" name="cv_document" id="cv_document" style="display: none;">
            </label>

            {!! APFrmErrHelp::showErrors($errors, 'cv_document') !!}
        </div>

    </div>
</div>






   



<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'first_name') !!}">
            <label for="">{{ __('First Name') }} <span>*</span></label>
            {!! Form::text('first_name', null, [
                'class' => 'form-control',
                'id' => 'first_name',
                'placeholder' => __('First Name'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'first_name') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
            <label for="">{{ __('Last Name') }} <span>*</span></label>
            {!! Form::text('last_name', null, [
                'class' => 'form-control',
                'id' => 'last_name',
                'placeholder' => __('Last Name'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'middle_name') !!}">
			<label for="">{{__('Nick Name')}}</label>
			{!! Form::text('middle_name', null, array('class'=>'form-control', 'id'=>'middle_name', 'placeholder'=>__('Middle Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'middle_name') !!}</div>
    </div> --}}

    {{-- <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'gender_id') !!}">
			<label for="">{{__('Gender')}} <span>*</span></label>
			{!! Form::select('gender_id', [''=>__('Select Gender')]+$genders, null, array('class'=>'form-control', 'id'=>'gender_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!} </div>
    </div> --}}
    {{-- <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'marital_status_id') !!}">
			<label for="">{{__('Martial Status')}} <span>*</span></label>
			{!! Form::select('marital_status_id', [''=>__('Select Marital Status')]+$maritalStatuses, null, array('class'=>'form-control', 'id'=>'marital_status_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'marital_status_id') !!} </div>
    </div> --}}
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'country_id') !!}">
            <label for="">{{ __('Country') }} <span>*</span></label>
            <?php $country_id = old('country_id', isset($user) && (int) $user->country_id > 0 ? $user->country_id : $siteSetting->default_country_id); ?>
            {!! Form::select('country_id', ['' => __('Select Country')] + $countries, $country_id, [
                'class' => 'form-control',
                'id' => 'country_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}
        </div>
    </div>


    <div class="col-md-3">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
            <label for="">{{ __('State') }} <span>*</span></label>
            <span id="state_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, ['class' => 'form-control', 'id' => 'state_id']) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
            <label for="">{{ __('City') }} <span>*</span></label>
            <span id="city_dd"> {!! Form::select('city_id', ['' => __('Select City')], null, ['class' => 'form-control', 'id' => 'city_id']) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}
        </div>
    </div>
    {{-- <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'nationality_id') !!}">
			<label for="">{{__('Nationality')}} <span>*</span></label>
			{!! Form::select('nationality_id', [''=>__('Select Nationality')]+$nationalities, null, array('class'=>'form-control', 'id'=>'nationality_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'nationality_id') !!} </div>
    </div> --}}
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_title_id') !!}">
            <label for="">{{ __('job_title_id') }} <span>*</span></label>
            {!! Form::select('job_title_id', ['' => __('Select jobTitle')] + $jobTitles, null, [
                'class' => 'form-control',
                'id' => 'job_title_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_title_id') !!}
        </div>
    </div>
    <div class="col-md-6">


        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'date_of_birth') !!}">
            <?php
            
            if (!empty($user->date_of_birth)) {
                $d = $user->date_of_birth;
            } else {
                $d = date('Y-m-d', strtotime('-16 years'));
            }
            $dob = old('date_of_birth') ? date('Y-m-d', strtotime(old('date_of_birth'))) : date('Y-m-d', strtotime($d));
            
            ?>
            <label for="">{{ __('Date of Birth') }} <span>*</span></label>
            {!! Form::date('date_of_birth', $dob, [
                'class' => 'form-control',
                'id' => 'date_of_birth',
                'placeholder' => __('Date of Birth'),
                'autocomplete' => 'off',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'date_of_birth') !!}
        </div>




    </div>


    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'mobile_num') !!}">
            <label for="">{{ __('Mobile') }}</label>
            {!! Form::text('mobile_num', null, [
                'class' => 'form-control',
                'id' => 'mobile_num',
                'placeholder' => __('Mobile Number'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'mobile_num') !!}
        </div>

    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}">
            <label for="">{{ __('Job Experience') }} <span>*</span></label>
            {!! Form::select('job_experience_id', ['' => __('Select Experience')] + $jobExperiences, null, [
                'class' => 'form-control',
                'id' => 'job_experience_id',
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!}
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'street_address') !!}">
            <label for="">{{ __('Street Address') }} <span>*</span></label>
            {!! Form::textarea('street_address', null, [
                'class' => 'form-control',
                'id' => 'street_address',
                'placeholder' => __('Street Address'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'street_address') !!}
        </div>

    </div>
</div>

<hr>
<h5>{{ __('Add Video Profile') }}</h5>

<div class="row">
    <div class="col-md-12" id="video_link_id">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'video_link') !!}">
            <label for="">{{ __('Video Link') }} - sample: https://www.youtube.com/embed/538cRSPrwZU</label>
            {!! Form::textarea('video_link', null, [
                'class' => 'form-control',
                'id' => 'video_link',
                'placeholder' => __('Video Link'),
            ]) !!}
            {!! APFrmErrHelp::showErrors($errors, 'video_link') !!}
        </div>
    </div>
</div>
<hr>







<div class="row">

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_subscribed') !!}">
            <?php
            $is_checked = 'checked="checked"';
            if (old('is_subscribed', isset($user) ? $user->is_subscribed : 1) == 0) {
                $is_checked = '';
            }
            ?>
            <input type="checkbox" value="1" name="is_subscribed" {{ $is_checked }} />
            {{ __('Subscribe to Newsletter') }}
            {!! APFrmErrHelp::showErrors($errors, 'is_subscribed') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow"><button type="submit" class="btn">{{ __('Update Profile and Save') }} <i
                    class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></div>
    </div>
</div>


{!! Form::close() !!}


@push('styles')
    <style type="text/css">
        .datepicker>div {
            display: block;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            initdatepicker();
            $('#salary_currency').typeahead({
                source: function(query, process) {
                    return $.get("{{ route('typeahead.currency_codes') }}", {
                        query: query
                    }, function(data) {
                        console.log(data);
                        data = $.parseJSON(data);
                        return process(data);
                    });
                }
            });

            $('#country_id').on('change', function(e) {
                e.preventDefault();
                filterStates(0);
            });
            $(document).on('change', '#state_id', function(e) {
                e.preventDefault();
                filterCities(0);
            });
            filterStates(<?php echo old('state_id', $user->state_id); ?>);

            /*******************************/
            var fileInput = document.getElementById("image");
            fileInput.addEventListener("change", function(e) {
                var files = this.files
                showThumbnail(files)
            }, false)

            var fileInput_cover_image = document.getElementById("cover_image");

            fileInput_cover_image.addEventListener("change", function(e) {

                var files_cover_image = this.files

                showThumbnail_cover_image(files_cover_image)

            }, false)


            function showThumbnail(files) {
                $('#thumbnail').html('');
                for (var i = 0; i < files.length; i++) {
                    var file = files[i]
                    var imageType = /image.*/
                    if (!file.type.match(imageType)) {
                        console.log("Not an Image");
                        continue;
                    }
                    var reader = new FileReader()
                    reader.onload = (function(theFile) {
                        return function(e) {
                            $('#thumbnail').append(
                                '<div class="fileattached"><img height="100px" src="' + e.target
                                .result + '" > <div>' + theFile.name +
                                '</div><div class="clearfix"></div></div>');
                        };
                    }(file))
                    var ret = reader.readAsDataURL(file);
                }
            }


            function showThumbnail_cover_image(files) {

                $('#thumbnail_cover_image').html('');

                for (var i = 0; i < files.length; i++) {

                    var file = files[i]

                    var imageType = /image.*/

                    if (!file.type.match(imageType)) {

                        console.log("Not an Image");

                        continue;

                    }

                    var reader = new FileReader()

                    reader.onload = (function(theFile) {

                        return function(e) {

                            $('#thumbnail_cover_image').append(
                                '<div class="fileattached"><img height="100px" src="' + e.target
                                .result + '" > <div>' + theFile.name +
                                '</div><div class="clearfix"></div></div>');

                        };

                    }(file))

                    var ret = reader.readAsDataURL(file);

                }

            }


        });

        function filterStates(state_id) {
            var country_id = $('#country_id').val();
            if (country_id != '') {
                $.post("{{ route('filter.lang.states.dropdown') }}", {
                        country_id: country_id,
                        state_id: state_id,
                        _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        $('#state_dd').html(response);
                        filterCities(<?php echo old('city_id', $user->city_id); ?>);
                    });
            }
        }

        function filterCities(city_id) {
            var state_id = $('#state_id').val();
            if (state_id != '') {
                $.post("{{ route('filter.lang.cities.dropdown') }}", {
                        state_id: state_id,
                        city_id: city_id,
                        _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        $('#city_dd').html(response);
                    });
            }
        }

        function initdatepicker() {
            $(".datepicker").datepicker({
                autoclose: true,
                format: 'yyyy-m-d'
            });
        }
    </script>
@endpush
