@extends('admin.layouts.admin_layout')
@section('content')
    <style type="text/css">
        .table td,
        .table th {
            font-size: 12px;
            line-height: 2.42857 !important;
        }
    </style>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Users</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Users <small>Users</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span
                                    class="caption-subject font-dark sbold uppercase">Users</span> </div>
                            <div class="actions">
                                <a href="{{ route('create.user') }}" class="btn btn-xs btn-success"><i
                                        class="glyphicon glyphicon-plus"></i> Add New User</a>
                                {{-- <select id="company_id" class="form-control" style="width:200px; display:inline-block;">
                                    <option value="">اختر شركة</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>

                                <button id="assign_company" class="btn btn-primary">إسناد المستخدمين للشركة</button>
                           
                           <form method="POST" action="{{ route('users.assign.company') }}">
    @csrf
    <input type="hidden" name="company_id" value="1" />
    <input type="hidden" name="user_ids[]" value="1" />
    <input type="hidden" name="user_ids[]" value="2" />
    <button type="submit">اختبار يدوي</button>
</form> --}}

                            </div>




                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="user-search-form">
                                    <table class="table table-striped table-bordered table-hover" id="user_datatable_ajax">
                                        <thead>
                                            <tr role="row" class="filter">
                                                <td><input type="text" class="form-control" name="id" id="id"
                                                        autocomplete="off"></td>
                                                <td><input type="text" class="form-control" name="name" id="name"
                                                        autocomplete="off"></td>
                                                <td><input type="text" class="form-control" name="email" id="email"
                                                        autocomplete="off"></td>
                                                <td><select name="is_active" id="is_active" class="form-control">
                                                        <option value="-1">Is Active?</option>
                                                        <option value="1" selected="selected">Active</option>
                                                        <option value="0">In Active</option>
                                                        <option value="2">pending</option>
                                                    </select></td>
                                                <td></td>
                                            </tr>
                                            <tr role="row" class="heading">
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Is Active?</th>
                                                <th style="width: 30%;align-items:center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
        <!-- start model -->

        <div class="modal fade" id="youtubeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Video Preview</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body p-0">
                        <iframe id="youtubeFrame" width="100%" height="450" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>
        <!-- END model -->



    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#user_datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                order: [
                    [0, "desc"]
                ],
                ajax: {
                    url: '{!! route('fetch.data.users') !!}',
                    data: function(d) {
                        d.id = $('input[name=id]').val();
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.is_active = $('#is_active').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],


                createdRow: function(row, data, dataIndex) {
                    if (data.is_active == 1) {
                        $(row).addClass('active-user-row');
                    }
                }
            });


            $('#user-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#id').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#name').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#email').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });

            $('#is_active').on('change', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function delete_user(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("{{ route('delete.user') }}", {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#user_datatable_ajax').DataTable();
                            table.row('user_dt_row_' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }

        function make_active(id) {
            $.post("{{ route('make.active.user') }}", {
                    id: id,
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    if (response == 'ok') {
                        $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                        $('#onclick_active_' + id).html(
                            "<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Make InActive");
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function make_not_active(id) {
            $.post("{{ route('make.not.active.user') }}", {
                    id: id,
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    if (response == 'ok') {
                        $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                        $('#onclick_active_' + id).html(
                            "<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Make Active");
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function make_pending(id) {
    $.post("{{ route('make.pending.user') }}", {
            id: id,
            _method: 'PUT',
            _token: '{{ csrf_token() }}'
        })
        .done(function (res) {

            if (res.status === 'ok') {

                // لو حابب تحديث الزر داخل الصف
                $('#onclick_active_' + id)
                    .attr("onclick", "make_not_active(" + id + ")")
                    .html('<i class="fa fa-hourglass-half"></i> Pending');

                // هنا reload لبيانات الجدول
                $('#users-table').DataTable().ajax.reload(null, false);
            }
        });
}
        function make_verified(id) {
            $.post("{{ route('make.verified.user') }}", {
                    id: id,
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    if (response == 'ok') {
                        $('#onclick_verified_' + id).attr("onclick", "make_not_verified(" + id + ")");
                        $('#onclick_verified_' + id).html(
                            "<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Verified");
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function make_not_verified(id) {
            $.post("{{ route('make.not.verified.user') }}", {
                    id: id,
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    if (response == 'ok') {
                        $('#onclick_verified_' + id).attr("onclick", "make_verified(" + id + ")");
                        $('#onclick_verified_' + id).html(
                            "<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Not Verified");
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function openYoutubeModal(url) {
            // Load YouTube URL
            console.log(url);
            $('#youtubeFrame').attr('src', url);

            // Show modal
            $('#youtubeModal').modal('show');
        }

        // Stop video when modal closes
        $('#youtubeModal').on('hidden.bs.modal', function() {
            $('#youtubeFrame').attr('src', '');
        });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 3. معالج النقر على زر الإسناد (كما طلبت، مع تحسين بسيط)
        $('#assign_company').click(function() {
            let selectedCompany = $('#company_id').val();

            if (!selectedCompany) {
                alert("اختر الشركة أولاً.");
                return;
            }

            let userIDs = [];
            $('.user-select:checked').each(function() {
                userIDs.push($(this).val());
            });

            if (userIDs.length === 0) {
                alert("اختر مستخدم واحد على الأقل.");
                return;
            }

            // 4. إرسال الطلب بدون _token (لأنه يُرسل في الـ header تلقائيًا)
            $.post("{{ route('users.assign.company') }}", {
                    user_ids: userIDs,
                    company_id: selectedCompany
                })
                .done(function(response) {
                    alert("تم إسناد المستخدمين للشركة بنجاح!");
                    // مثال: إزالة العناصر المحددة أو تحديث القائمة
                    $('.user-select:checked').prop('checked', false);
                })
                .fail(function(xhr) {
                    let errorMsg = "خطأ غير معروف.";
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            errorMsg = Object.values(errors).flat().join("\n");
                        } else {
                            errorMsg = "بيانات غير صالحة.";
                        }
                    } else if (xhr.status === 500) {
                        errorMsg = "خطأ داخلي في الخادم.";
                    } else if (xhr.status === 403) {
                        errorMsg = "غير مصرح لك بتنفيذ هذا الإجراء.";
                    } else {
                        errorMsg = "خطأ: " + xhr.status + " — " + (xhr.statusText || "تحقق من سجلات الخادم");
                    }

                    alert("فشل في الإسناد:\n" + errorMsg);
                    console.error("AJAX Error:", xhr);
                });
        });
    </script>
@endpush
