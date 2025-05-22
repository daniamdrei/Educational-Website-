@extends('panel.layouts.master' , ['title' => __('panel.admins')])
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
                                    <label>{{ __('constants.name') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{isset($item)?@$item->name:''}}"
                                           required/>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('constants.email') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                           value="{{isset($item)?@$item->email:''}}"
                                           required/>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelect1">@lang('panel.roles_permissions')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control selectpicker" name="role_id"
                                            title="@lang('panel.roles_permissions')">
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}" {{ isset($item) && @$item->roles()->first()->id==$role->id ? 'selected' :'' }} >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('constants.password')<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password"/>
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

    <script src="{{ asset('panelAssets/js/post.js') }}"></script>
@endpush
