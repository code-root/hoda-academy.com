@extends('admin.layout.app')

@section('page', 'home')


@section('contant')





    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            @include('admin.layout.menu-slider')

            <!-- Product List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> {!! __('admin.Card') !!}</h5>
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
                                    {{-- @dd($errors) --}}
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
                                <th>{!! __('admin.Card') !!}</th>

                                <th class="text-nowrap text-sm-end">{!! __('admin.Description') !!} </th>
                                <th class="text-lg-center">{!! __('admin.Actions') !!}</th>
                            </tr>



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

                    ajax: '{{ route('card.data') }}',
                    columns: [{
                                data: "id"
                            },


                            {
                                data: "title_ar"
                            },
                            {
                                data: "description"
                            },

                            {
                                data: " "
                            },




                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ]

                        ,
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
                        }

                        ///////////2////////////
                        //     , {
                        //         targets: 2,
                        //         responsivePriority: 1,
                        //         render: function(t, e, s, a) {

                        // // console.log(s)



                        //             var n = s.id;
                        //             return n;

                        //         }
                        //     }

                        ////////////2//////////////
                        ///////////2////////////
                        , {
                            targets: 2,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                // التحقق من وجود الصورة
                                if (s.photo != null) {
                                    var photo = s.photo;
                                } else {
                                    var photo = 'no-image.png';
                                }

                                // إنشاء عنصر مؤقت لاستخراج النص بدون أكواد HTML
                                var tempElement = document.createElement('div');
                                tempElement.innerHTML =
                                    @if (App::isLocale('en'))
                                        s.title_en;
                                    @else
                                        s.title_ar;
                                    @endif

                                // استخراج النص العادي
                                var plainText = tempElement.textContent || tempElement.innerText ||
                                    'النص غير متوفر';

                                // بناء العنصر النهائي
                                var list =
                                    '<div class="d-flex justify-content-start align-items-center product-name">' +
                                    '<div class="avatar-wrapper">' +
                                    '<div class="avatar avatar me-2 rounded-2 bg-label-secondary">' +
                                    '<img src="{{ asset('images') }}/' + photo +
                                    '" class="rounded-2">' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="d-flex flex-column">' +
                                    '<h6 class="text-body text-nowrap mb-0" style="font-size: 16px;">' +
                                    plainText + '</h6>' +
                                    '</div>' +
                                    '</div>';

                                return list;
                            }
                        }


                        ////////////2//////////////

                        ///////////3////////////
                        , {
                            targets: 3,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                var tempElement = document.createElement('div');
                                tempElement.innerHTML =
                                    @if (App::isLocale('en'))
                                        s.description_en;
                                    @else
                                        s.description_ar;
                                    @endif

                                // الحصول على النص فقط بدون الأكواد HTML
                                var plainText = tempElement.textContent || tempElement.innerText ||
                                    'النص غير متوفر';
                                return `
            <div class="text-sm-end" dir="rtl">
                ${plainText}
            </div>
        `;
                            }

                        }

                        ////////////3//////////////
                        ///////////4////////////
                        , {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                return `
                                        <div class="d-flex align-items-sm-center justify-content-sm-center">
                                            <a href="card/${s.id}/edit">

                                                <i class="bx bx-edit"></i>

                                            </a>
                                        </div>`;


                                //             return `
                        // <div class="d-flex align-items-sm-center justify-content-sm-center">
                        //     <button id="edit" class="btn btn-sm btn-icon"
                        //         data-id="${s.id}"
                        //         data-title_ar="${s.title_ar}"
                        //         data-title_en="${s.title_en}"
                        //         data-descrition_ar="${s.descrition_ar}"
                        //         data-descrition_en="${s.descrition_en}"
                        //         data-photo="${s.photo}"

                        //         aria-controls="products-table"
                        //         type="button"
                        //         data-bs-toggle="modal"
                        //         data-bs-target="#EditModal1">
                        //         <i class="bx bx-edit"></i>
                        //     </button>
                        // </div>`;
                            }
                        }


                        ////////////4//////////////





                        , {
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
                            text: '<i class="bx bx-plus me-0 me-sm-1"></i>{!! __('admin.Add Card') !!}',
                            className: "add-new btn btn-primary ms-2",
                            attr: {
                                "data-bs-toggle": "offcanvas",
                                "data-bs-target": "#offcanvasEcommerceCategoryList"
                            },
                            action: function() {
                                window.location.href = "{{ route('card.create') }}"
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
            });


            //     function edit(id){
            //       $('#edit').val(id);

            //     }

            // $('#EditModel').on('show', function (event) {
            //       console.log(event)
            //     });
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
                            <form method="POST" action="{{ route('card.destroy', 0) }}">
                                @method('delete')
                                @csrf
                                <div id="name" class=" col mb-3">

                                    ﻫﻞ اﻧﺖ ﻣﺘﺄﻛﺪ ﻣﻦ اﻧﻚ ﺗﺮﻳﺪ اﻟﺤﺬﻑ؟

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
