@extends('panel.layouts.master' , ['title' => __('panel.subscriptions')])
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom">

                <div class="card-body mt-2">

                    <div class="mb-7">
                        <div class="row align-items-center d-flex justify-content-between">
                            <div class="col-lg-4 col-xl-4">
                                   <div class="row align-items-center">
                                    <div class="col-md-6 my-2 my-md-0">
                                        <select class="form-control selectpicker" name="student_id"
                                                title="@lang('panel.students')" data-live-search="true" data-size="5">
                                            @foreach($students as $student)
                                                <option
                                                    value="{{$student->id}}" {{ isset($item) && @$item->student_id==$student->id ? 'selected' :'' }} >{{$student->ssn_id . ' | ' . $student->email . ' | ' . $student->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 my-2 my-md-0">
                                        <select class="form-control selectpicker" name="course_id"
                                                title="@lang('panel.courses')" data-live-search="true" data-size="5">
                                            @foreach($courses as $course)
                                                <option
                                                    value="{{$course->id}}" {{ isset($item) && @$item->course_id==$course->id ? 'selected' :'' }} >{{$course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-end">
                                <a href="{{ route('panel.subscriptions.create') }}"
                                   class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<i class="fa fa-plus"></i>
											</span>@lang('panel.add')
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>

                </div>
            </div>
            <!--end::Card-->
        </div>

    </div>
@endsection

@push('panel_js')

    <script src="{{ asset('panelAssets/js/data-ajax.js') }}"></script>

 <script>
        window.data_url = '{{route('panel.subscriptions.datatable')}}';
        window.columns = [
            {
                field: ' ',
                title: "#",
                width: 120,
                textAlign: "center",
                template: function (data, index, datatable) {
                    return ((datatable.getCurrentPage() - 1) * datatable.getPageSize()) + index + 1;
                },
            },
            {
                field: 'student_name',
                title: '@lang('panel.students')',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'course_title',
                title: '@lang('panel.courses')',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'start_date',
                title: '@lang('panel.started_at')',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'end_date',
                title: '@lang('panel.end_at')',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'created_at',
                title: '@lang('panel.created_at')',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'active',
                title: '@lang('constants.status')',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                width: 120,

            },
            {
                field: 'options',
                title: '@lang('constants.actions')',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                width: 120,

            }
        ];

        $(document).on('change', 'select[name=student_id]', function () {
            datatable.search($(this).val(), 'student_id')
        });
        $(document).on('change', 'select[name=course_id]', function () {
            datatable.search($(this).val(), 'course_id')
        });

    </script>


@endpush
