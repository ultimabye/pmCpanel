@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/ordermanage/css/style.css'))}}" />

@endsection

@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav nav_list" role="tablist">
                            @if (permissionCheck('confirmed_orders'))
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#order_confirmed_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.confirmed_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('complete_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#order_complete_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.completed_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('pending_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#pending_payment_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.pending_payment_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('cancelled_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#cancelled_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.cancelled_orders')}}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">

                    <div class="tab-content">
                        @if (permissionCheck('confirmed_orders'))
                            <div role="tabpanel" class="tab-pane fade active show" id="order_confirmed_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.confirmed_orders')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderConfimedTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (permissionCheck('complete_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="order_complete_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.completed_orders')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderCompletedTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (permissionCheck('pending_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="pending_payment_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.pending_payment_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderPendingPaymentTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (permissionCheck('cancelled_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="cancelled_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.cancelled_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderCanceledTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
@endsection

@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $('#orderConfimedTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=confirmed'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'action', name: 'action' }

                    ],

                    bLengthChange: false,
                    "bDestroy": true,
                    language: {
                        search: "<i class='ti-search'></i>",
                        searchPlaceholder: trans('common.quick_search'),
                        paginate: {
                            next: "<i class='ti-arrow-right'></i>",
                            previous: "<i class='ti-arrow-left'></i>"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            title: $("#header_title").text(),
                            margin: [10, 10, 10, 0],
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,

                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            title: $("#header_title").text(),
                            exportOptions: {
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            postfixButtons: ['colvisRestore']
                        }
                    ],
                    columnDefs: [{
                        visible: false
                    }],
                    responsive: true,
                });

                $('#orderCompletedTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=completed'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'action', name: 'action' }

                    ],

                    bLengthChange: false,
                    "bDestroy": true,
                    language: {
                        search: "<i class='ti-search'></i>",
                        searchPlaceholder: trans('common.quick_search'),
                        paginate: {
                            next: "<i class='ti-arrow-right'></i>",
                            previous: "<i class='ti-arrow-left'></i>"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            title: $("#header_title").text(),
                            margin: [10, 10, 10, 0],
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,

                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            title: $("#header_title").text(),
                            exportOptions: {
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            postfixButtons: ['colvisRestore']
                        }
                    ],
                    columnDefs: [{
                        visible: false
                    }],
                    responsive: true,
                });

                $('#orderPendingPaymentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=pending_payment'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'action', name: 'action' }

                    ],

                    bLengthChange: false,
                    "bDestroy": true,
                    language: {
                        search: "<i class='ti-search'></i>",
                        searchPlaceholder: trans('common.quick_search'),
                        paginate: {
                            next: "<i class='ti-arrow-right'></i>",
                            previous: "<i class='ti-arrow-left'></i>"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            title: $("#header_title").text(),
                            margin: [10, 10, 10, 0],
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,

                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            title: $("#header_title").text(),
                            exportOptions: {
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            postfixButtons: ['colvisRestore']
                        }
                    ],
                    columnDefs: [{
                        visible: false
                    }],
                    responsive: true,
                });

                $('#orderCanceledTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=canceled'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'action', name: 'action' }

                    ],

                    bLengthChange: false,
                    "bDestroy": true,
                    language: {
                        search: "<i class='ti-search'></i>",
                        searchPlaceholder: trans('common.quick_search'),
                        paginate: {
                            next: "<i class='ti-arrow-right'></i>",
                            previous: "<i class='ti-arrow-left'></i>"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            title: $("#header_title").text(),
                            margin: [10, 10, 10, 0],
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,

                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            title: $("#header_title").text(),
                            exportOptions: {
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            postfixButtons: ['colvisRestore']
                        }
                    ],
                    columnDefs: [{
                        visible: false
                    }],
                    responsive: true,
                });
            });
        })(jQuery);
    </script>
@endpush
