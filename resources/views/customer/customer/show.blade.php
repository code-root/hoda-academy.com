   @extends('customer.customer.app')

   @section('contant1')
       <!-- Invoice table -->
       <div class="card mb-4">
           <div class="table-responsive mb-3">
               <table id="products-table" class="table datatables-customer-order border-top">
                   <thead>
                       <tr>
                           <th></th>
                           <th></th>
                           <th>Order</th>
                           <th>Date</th>
                           <th>payment</th>
                           <th>total</th>

                       </tr>
                   </thead>
               </table>
           </div>
       </div>









       <script>
           $(document).ready(function() {
               var r = {
                   1: {
                       title: "Ready to  Pickup",
                       class: "bg-label-info"
                   },
                   2: {
                       title: "Dispatched",
                       class: "bg-label-warning"
                   },
                   3: {
                       title: "Delivered",
                       class: "bg-label-success"
                   },
                   4: {
                       title: "Out for delivery",
                       class: "bg-label-primary"
                   }
               };
               $('#products-table').DataTable({
                   processing: true,

                   ajax: "{{ route('customer1.getorder', $customer->id) }}",
                   columns: [{
                               data: " "
                           },

                           {
                               data: "id"
                           },
                           {
                               data: "order"
                           },
                           {
                               data: "date"
                           },

                           {
                               data: "spent"
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
                               selectAllRender: '<input type="checkbox"   class="all form-check-input">'
                           },
                           render: function(t, e, s, a) {
                               return '<input type="checkbox" value="' + s.id +
                                   '"   class="dt-checkboxes form-check-input" >'
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

                               return '<a href="/order1/' + s.id + '"><span class="fw-medium">#' +
                                   s
                                   .id + "</span></a>"


                           }
                       }

                       ////////////2//////////////




                       ///////////3////////////
                       , {
                           targets: 3,
                           responsivePriority: 1,
                           render: function(t, e, s, a) {


                               return '<span class="text-nowrap">' + new Date(s.created_at)
                                   .toLocaleDateString("en-US", {
                                       month: "short",
                                       day: "numeric",
                                       year: "numeric"
                                   }) + "</span > "
                           }
                       }


                       ////////////3//////////////

                       ///////////4////////////
                       , {
                           targets: 4,
                           responsivePriority: 1,
                           render: function(t, e, s, a) {



                               return '<h6 class="mb-0 w-px-100 text-success"><i class="bx bxs-circle fs-tiny me-2"></i>Paid</h6>';


                           }
                       }


                       ////////////4//////////////
                       ///////////5////////////
                       , {
                           targets: 5,
                           responsivePriority: 1,
                           render: function(t, e, s, a) {


                               return "<span >$" + s.total + "</span>"
                           }
                       }


                       ////////////5//////////////



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
                   }, ],
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
       </script>
   @endsection
