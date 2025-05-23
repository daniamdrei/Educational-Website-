@extends('panel.layouts.master' , ['title' => __('panel.courses')])
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


                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{__('constants.image')}}</label>

                                    <div class="col-md-9">
                                        <div class="image-input image-input-empty image-input-outline"
                                            id="kt_user_edit_avatar"
                                            style="background-image: url('{{ isset($item) ? asset($item->image) :  asset('panelAssets/images/placeholder.png') }}')">
                                            <div class="image-input-wrapper"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="profile_avatar_remove"/>
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title="Remove">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>


                                @foreach(locales() as $key => $lang)
                                    <div class="form-group">
                                        <label>{{ __('constants.title') }} ({{ $lang['name'] }})
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title_{{$key}}"
                                               value="{{isset($item)?@$item->translate($key)->title:''}}"
                                               required/>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('panel.description') }}({{ $lang['name'] }})
                                            <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description_{{$key}}" rows="5"
                                                  required>{{isset($item)?@$item->translate($key)->description:''}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('panel.category') }} ({{ $lang['name'] }})
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="category_{{$key}}"
                                               value="{{isset($item)?@$item->translate($key)->category:''}}"
                                               required/>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('panel.instructor') }} ({{ $lang['name'] }})
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="instructor_{{$key}}"
                                               value="{{isset($item)?@$item->translate($key)->instructor:''}}"
                                               required/>
                                    </div>

                                    <hr>
                                @endforeach


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
