 @extends('admin.layout.app')

 @section('page', 'Create Product')


 @section('contant')








     @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif




     {{-- @dd($errors) --}}
     <!-- Content wrapper -->
     <div class="content-wrapper">

         <!-- Content -->

         <div class="container-xxl flex-grow-1 container-p-y">




             <form action="{{ route('card.update', $card->id) }}" method="post" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
                 <div class="app-ecommerce">

                     <!-- Add Product -->
                     <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">




                     </div>

                     <div class="row">

                         <!-- First column-->
                         <div class="col-12 col-lg-12">
                             <!-- Product Information -->
                             <div class="card mb-12">
                                 <div class="card-header">
                                     <h5 class="card-tile mb-0">{!! __('admin.Edit Card') !!} </h5>
                                 </div>
                                 <div class="card-body">

                                     {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Title_ar') !!}</label>


                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $card->title_ar }}" placeholder="{!! __('admin.Title_ar1') !!}"
                                             name="title_ar" aria-label="Product title">

                                         @error('title_ar')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                     {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $card->title_en }}" placeholder="{!! __('admin.Title_en1') !!}"
                                             name="title_en" aria-label="Product title">



                                         @error('title_en')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}


                                     {{-- -------------------------------------------------------------- description_ar-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Description_ar') !!}</label>


                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $card->description_ar }}" placeholder="{!! __('admin.Description_ar1') !!}"
                                             name="description_ar" aria-label="Product description">

                                         @error('description_ar')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end description_ar-------------------------------------------------------------------- --}}

                                     {{-- -------------------------------------------------------------- description_en-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Description_en') !!}</label>
                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $card->description_en }}" placeholder="{!! __('admin.Description_en1') !!}"
                                             name="description_en" aria-label="Product description">



                                         @error('description_en')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end description_en-------------------------------------------------------------------- --}}



                                     {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                     <div>
                                         <br>
                                         <label class="form-label">{!! __('admin.Photo') !!}</label>
                                         <input type="file" multiple name="photo" onchange="readURL(this);"
                                             value="{{ $card->photo }}" class="file form-control">

                                         @error('photo')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             <br>
                                         @enderror


                                         <br>
                                         <div class="row last">
                                             <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                 <a target="_blank" href="{{ asset('images') }}/{{ $card->photo }}">
                                                     <img id="blah" style="width: 100%;height: 100%;padding: 5px;"
                                                         src="{{ asset('images') }}/{{ $card->photo }}"
                                                         alt="your image" /></a>
                                             </div>



                                         </div>



                                         {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}

                                         <input type="hidden" name="page" value="card">

                                         <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!} </button>
                                     </div>
                                 </div>





                             </div>


             </form>
         </div>



         <!-- /Organize Card -->
     </div>
     <!-- /Second column -->
     </div>
     </div>
     </div>
     <!-- / Content -->
     </form>



 @endsection

 @section('footer')
     <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


 @endsection
