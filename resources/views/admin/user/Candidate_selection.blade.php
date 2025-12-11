@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="{{ route('list.users') }}">Users</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Add User</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <!--<h3 class="page-title">Edit User <small>Users</small> </h3>-->
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <br />
            @include('flash::message')
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span
                                    class="caption-subject bold uppercase">select candidate</span> </div>
                        </div>
                        <div class="portlet-body form">

                            <div class="card">

                                <form method="POST" action="{{ route('users.assign.company') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">select company</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="company_id">
                                            <option value="">select company </option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select users</label>

                                        <select class="form-control" name="users[]"  id="userSelect" multiple>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="selectedUsers" class="mt-2"></div>


                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
    </div>
@endsection
@push('scripts')
    <script>
        $('#userSelect').on('change', function() {
            let selected = $(this).find('option:selected')
                .map(function() {
                    return $(this).text();
                })
                .get();

            $('#selectedUsers').html(selected.join(', '));
        });
    </script>
@endpush
