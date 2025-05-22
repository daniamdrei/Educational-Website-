


@if(auth('admin')->user()->can('add_admins'))
<a class="btn btn-sm btn-clean btn-icon btn-icon-md"
href="{{route('panel.admins.edit',$instance->id)}}"
title="@lang('constants.edit')"><i class="flaticon2-edit"></i>  </a>


<a class="btn btn-sm btn-clean btn-icon btn-icon-md delete"
href="" data-url="{{route('panel.admins.destroy',$instance->id)}}"
title="@lang('constants.delete')"><i class="flaticon2-delete"></i>  </a>

@endif

