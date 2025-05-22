"use strict";
// Class definition
var datatable
var KTDatatableRemoteAjaxDemo = function () {
    // Private functions

    // basic demo
    var demo = function () {

        datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: window.data_url,
                        method: "GET",
                        // sample custom headers
                        // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            // translate: {
            //     records: {
            //         processing: 'جاري التحميل...',
            //         noRecords: 'لا توجد نتائج'
            //     },
            //     toolbar:{
            //
            //         pagination:{
            //             items:{
            //                 default: {
            //                     first: 'الأول',
            //                     prev: 'السابق',
            //                     next: 'التالي',
            //                     last: 'الأخير',
            //                     more: 'المزيد',
            //                     input: 'رقم الصفحة',
            //                     select: 'حدد عدد العناصر'
            //                 },
            //                 info: 'عرض {{start}} - {{end}} من {{total}} السجلات'
            //             }
            //         }
            //     }
            // },

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            // columns definition
            columns: window.columns,
        });
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };

    $(document).on('click', 'thead tr', function () {
        if ($(this).hasClass("datatable-row-active")) {
            $('.deletes').removeClass('d-none')
        } else {
            $('.deletes').addClass('d-none')
        }
    });
    $(document).on('click', '.checkbox-single', function () {
        $('.deletes').removeClass('d-none')
    });

    return {
        // public functions
        init: function () {
            demo();
        },
    };
}();

jQuery(document).ready(function () {
    KTDatatableRemoteAjaxDemo.init();
});
