@extends('panel.layouts.master' , ['title' => __('panel.subscriptions') , 'active'=>'subscriptions' , 'sub_active'=>'add'])
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        @php
            $item = isset($item) ? $item: null;
        @endphp

        <div class="container">
            <form method="POST" action="{{ url()->current() }}" to="{{ url()->current() }}" class="form-horizontal"
                  id="form">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b ">

                            <!--begin::Form-->
                            <div class="card-body">


                                    <div class="form-group">
                                    <label for="exampleSelect1">@lang('panel.students')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control selectpicker" name="student_id"
                                            title="@lang('panel.students')">
                                        @foreach($students as $student)
                                            <option
                                                value="{{$student->id}}" {{ isset($item) && @$item->student_id==$student->id ? 'selected' :'' }} >{{$student->ssn_id . ' | ' . $student->email . ' | ' . $student->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>


                                    <div class="form-group">
                                    <label for="exampleSelect2">@lang('panel.courses')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control selectpicker" name="course_id"
                                            title="@lang('panel.courses')">
                                        @foreach($courses as $course)
                                            <option
                                                value="{{$course->id}}" {{ isset($item) && @$item->course_id==$course->id ? 'selected' :'' }} >{{$course->title}}</option>
                                        @endforeach
                                    </select>
                                    </div>


                                    <div class="form-group">
                                        <label>{{ __('panel.started_at') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="date"  class="form-control" name="start_data"
                                                required>{{isset($item)?@$item->start_date:''}}</input>
                                    </div>

                                       <div class="form-group">
                                        <label>{{ __('panel.ended_at') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="date"  class="form-control" name="end_data"
                                                required>{{isset($item)?@$item->end__date:''}}</input>
                                    </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card card-custom gutter-b">
                            <div class="card-footer">
                                <button type="submit" id="m_login_signin_submit"
                                        class="btn btn-primary mr-2 w-100">@lang('constants.save')
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>

    </div>
@endsection


@push('panel_js')

    <script src="{{ asset('panelAssets/js/edit-user.js') }}"></script>
    <script src="{{ asset('panelAssets/js/post.js') }}"></script>
@endpush
