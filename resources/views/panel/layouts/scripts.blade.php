<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script>
    window.ok = "{{ __('constants.confirm') }}";
    window.cancel = "{{ __('constants.cancel') }}";
    window.delete = "{{ __('constants.delete') }}";
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('panelAssets/js/plugins.bundle.js') }}"></script>
<script src="{{ asset('panelAssets/js/prismjs.bundle.js') }}"></script>
<script src="{{ asset('panelAssets/js/scripts.bundle.min.js') }}"></script>
<script src="{{asset('panelAssets/js/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/custom.sweet.js') }}" type="text/javascript"></script>
<script src="{{asset('panelAssets/js/datatables/datatables.bundle.js')}}"></script>

@stack('panel_js')
<script src="{{ asset('panelAssets/js/widgets.js') }}"></script>

<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->


<!--end::Page Vendors-->
<script>
    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $(document).on('click', '.delete', function (event) {
        var delete_url = $(this).data('url');
        event.preventDefault();
        swal.fire({
            title: '{{ __('constants.confirm_process') }}',
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: '{{ __('constants.confirm') }}',
            cancelButtonText: '{{ __('constants.cancel') }}',
            confirmButtonColor: '#56ace0',
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: delete_url,
                    method: 'delete',
                    type: 'json',
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.message);
                            if (datatable) {
                                datatable.reload();
                            }
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (response) {
                        errorCustomSweet();
                    }
                });
            }
        });
    });

    $(document).on('click', '.operation', function (event) {
        var delete_url = $(this).data('url');
        event.preventDefault();
        swal.fire({
            title: '{{ __('constants.are_you_sure_of_this_process') }}',
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: '{{ __('constants.confirm') }}',
            cancelButtonText: '{{ __('constants.cancel') }}',
            confirmButtonColor: '#56ace0',
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: delete_url,
                    method: 'POST',
                    type: 'json',
                    success: function (response) {
                        if (response.status) {

                            toastr.success(response.message);
                            if (datatable) {
                                datatable.reload();
                            }
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (response) {
                        errorCustomSweet();
                    }
                });
            }
        });
    });


    @if(app()->isLocale('ar'))
    $.extend($.validator.messages, {

        required: "هذا الحقل مطلوب",
        remote: "يرجى التأكد  من هذا الحقل للمتابعة",
        email: "يجب إدخال عنوان البريد الإلكتروني بالشكل الصحيح ",
        url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
        date: "رجاء إدخال تاريخ صحيح",
        dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
        number: "رجاء إدخال عدد بطريقة صحيحة",
        digits: "رجاء إدخال أرقام فقط",
        creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
        equalTo: "من فظلك ادخل نفس القيمة مرة أخرى.",
        extension: "رجاء إدخال ملف بامتداد موافق عليه",
        maxlength: $.validator.format("الحد الأقصى لعدد الحروف هو {0}"),
        minlength: $.validator.format("الحد الأدنى لعدد الحروف هو {0}"),
        rangelength: $.validator.format("عدد الحروف يجب أن يكون بين {0} و {1}"),
        range: $.validator.format("رجاء إدخال عدد قيمته بين {0} و {1}"),
        max: $.validator.format("رجاء إدخال عدد أقل من أو يساوي {0}"),
        min: $.validator.format("رجاء إدخال عدد أكبر من أو يساوي {0}")
    });
    @endif

</script>
