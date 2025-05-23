
{{-- <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('panel.courses.lectures.index',$instance->id)}}"
   title="@lang('panel.lectures')"><i class="fab fa-youtube"></i> </a>


<a class="btn btn-sm btn-clean btn-icon btn-icon-md delete" href=""
    data-url="{{route('panel.courses.destroy',$instance->id)}}"
    title="@lang('panel.add_new_lecture')"> <i class="fa fa-plus-circle"></i> </a>

<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('panel.courses.lectures.index' ,$instance->id)}}"
    title="@lang('panel.add_new_lecture')"><i class="fa fa-youtube"></i> </a>
 --}}



<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('panel.courses.lectures.index',$instance->id)}}"
   title="@lang('panel.lectures')"><i class="fab fa-youtube"></i> </a>

<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('panel.courses.edit',$instance->id)}}"
   title="@lang('constants.edit')"><i class="flaticon2-edit"></i> </a>

<a class="btn btn-sm btn-clean btn-icon btn-icon-md delete" href=""
   data-url="{{route('panel.courses.destroy',$instance->id)}}" title="@lang('constants.delete')"><i
        class="flaticon2-delete"></i> </a>
