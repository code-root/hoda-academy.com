@extends('admin.layout.app')

@section('page', 'home')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Product List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> {!! __('admin.Rateing') !!}</h5>
                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">

                        {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}

                        @if (session('success'))
                            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div id="danger-message" class="alert alert-danger alert-dismissible fade show text-center"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}

                    </div>
                </div>

                <div class="card-datatable table-responsive">
                    <table id="products-table" class="datatables-products table border-top dataTable no-footer dtr-column"
                        style="width: 1211px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{!! __('admin.Name') !!}</th>
                                <th>{!! __('admin.Review') !!}</th>
                                <th>{!! __('admin.Rating') !!}</th>
                                <th>{!! __('admin.Photo') !!}</th>
                                <th class="text-lg-center">{!! __('admin.Actions') !!}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <br>
                <br>
            </div>
        </div>
        <!-- / Content -->

        <script>
            $(document).ready(function() {
                $('#products-table').DataTable({
                    processing: true,
                    ajax: '{{ route('rateing.data') }}',
                    columns: [{
                            data: "id"
                        },
                        {
                            data: "id"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "review"
                        },
                        {
                            data: "rate"
                        },
                        {
                            data: "photo"
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    columnDefs: [{
                            className: "control",
                            searchable: !1,
                            orderable: !1,
                            responsivePriority: 2,
                            targets: 0,
                            render: function(t, e, s, a) {
                                return ""
                            }
                        }, {
                            targets: 1,
                            orderable: !1,
                            checkboxes: {
                                selectAllRender: '<input type="checkbox" onclick="data1(`all`)" class="all form-check-input">'
                            },
                            render: function(t, e, s, a) {
                                return '<input type="checkbox" value="' + s.id +
                                    '" onclick="data(`dt-checkboxes`)" class="dt-checkboxes form-check-input" >'
                            },
                            searchable: !1
                        }, {
                            targets: 2,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                return '<div class="d-flex justify-content-start align-items-center product-name">' +
                                    '<div class="avatar-wrapper">' +
                                    '<div class="avatar avatar me-2 rounded-2 bg-label-secondary">' +
                                    '<span class="avatar-initial rounded-2">' + s.name.charAt(0).toUpperCase() + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="d-flex flex-column">' +
                                    '<h6 class="mb-0 text-body">' + s.name + '</h6>' +
                                    '</div>' +
                                    '</div>';
                            }
                        }, {
                            targets: 3,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                return s.review ? s.review.substring(0, 50) + (s.review.length > 50 ? '...' : '') : '-';
                            }
                        }, {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                let stars = '';
                                for (let i = 1; i <= 5; i++) {
                                    if (i <= s.rate) {
                                        stars += '<i class="bx bxs-star text-warning"></i>';
                                    } else {
                                        stars += '<i class="bx bx-star text-muted"></i>';
                                    }
                                }
                                return '<div class="d-flex align-items-center">' + stars + ' <span class="ms-1">(' + s.rate + ')</span></div>';
                            }
                        }, {
                            targets: 5,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                if (s.photo) {
                                    return '<div class="d-flex justify-content-start align-items-center product-name">' +
                                        '<div class="avatar-wrapper">' +
                                        '<div class="avatar avatar me-2 rounded-2 bg-label-secondary">' +
                                        '<img src="/images/' + s.photo + '" class="rounded-2" style="width: 40px; height: 40px; object-fit: cover;">' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';
                                } else {
                                    return '<div class="d-flex justify-content-start align-items-center product-name">' +
                                        '<div class="avatar-wrapper">' +
                                        '<div class="avatar avatar me-2 rounded-2 bg-label-secondary">' +
                                        '<span class="avatar-initial rounded-2">-</span>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';
                                }
                            }
                        }, {
                            targets: 6,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                return `
                                    <div class="d-flex align-items-sm-center justify-content-sm-center">
                                        <a href="rateing/${s.id}/edit" class="btn btn-sm btn-icon btn-outline-primary me-1">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-icon btn-outline-danger delete-btn" 
                                                data-id="${s.id}" 
                                                data-name="${s.name}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>`;
                            }
                        }, {
                            targets: -1,
                            searchable: !1,
                            orderable: !1,
                        }
                    ],
                    order: [2, "desc"],
                    dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-md-0"<"me-5 ms-n2 pe-5"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0"lB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    lengthMenu: [10, 20, 50, 70, 100],
                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "{!! __('admin.Search') !!} ",
                        info: "{!! __('admin.Displaying _START_ to _END_ of _TOTAL_ entries') !!}"
                    },
                    buttons: [{
                            text: '<i class="bx bx-trash"></i><span class="d-none d-sm-inline-block">حذف </span>',
                            className: "add-new btn btn-danger de me-3",
                            attr: {
                                "data-bs-toggle": "modal",
                                "data-bs-target": "#basicModal2",
                                "style": "display:none"
                            }
                        },
                        {
                            text: '<i class="bx bx-plus me-0 me-sm-1"></i>{!! __('admin.Add Rateing') !!}',
                            className: "add-new btn btn-primary ms-2",
                            attr: {
                                "data-bs-toggle": "offcanvas",
                                "data-bs-target": "#offcanvasEcommerceCategoryList"
                            },
                            action: function() {
                                window.location.href = "{{ route('rateing.create') }}"
                            }
                        }
                    ],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(t) {
                                    return "Details of " + t.data().name
                                }
                            }),
                            type: "column",
                            renderer: function(t, e, s) {
                                s = $.map(s, function(t, e) {
                                    return "" !== t.title ? '<tr data-dt-row="' + t.rowIndex +
                                        '" data-dt-column="' + t.columnIndex + '"><td>' + t.title +
                                        ":</td> <td>" + t.data + "</td></tr>" : ""
                                }).join("");
                                return !!s && $('<table class="table"/><tbody />').append(s)
                            }
                        }
                    },
                });

                // Handle delete button clicks
                $(document).on('click', '.delete-btn', function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    
                    if (confirm('هل أنت متأكد من حذف التقييم: ' + name + '؟')) {
                        $('.val').val(id);
                        $('#basicModal2').modal('show');
                    }
                });
            });
        </script>

        {{-- -------------------------------------------------------------- Delete-------------------------------------------------------------------- --}}

        <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="Delete">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ route('rateing.destroy', 0) }}">
                                @method('delete')
                                @csrf
                                <div id="name" class=" col mb-3">
                                    هل أنت متأكد من انك تريد الحذف؟
                                </div>
                                <input class="val" type="hidden" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            data-i18n="Close">Close</button>
                        <button type="submit" class="btn btn-danger" data-i18n="Delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- --------------------------------------------------------------end Delete-------------------------------------------------------------------- --}}

    @endsection

    @section('footer')

    @endsection
