@extends('admin.layout.app')

@section('page', 'Edit blog')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="app-ecommerce">

                    <!-- Add blog -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">{{ __('admin.Edit') }} /</span> {{ __('admin.Blogs') }}
                        </h4>
                    </div>

                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- blog Information -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Edit Blogs') !!}</h5>
                                </div>
                                <div class="card-body">

                                    {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                        <input type="text" class="form-control @error('title_ar') is-invalid @enderror" required id="ecommerce-blog-name"
                                            value="{{ old('title_ar', $blog->title_ar) }}" placeholder="blog title" name="title_ar"
                                            aria-label="blog title">

                                        @error('title_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" required id="ecommerce-blog-name"
                                            value="{{ old('title_en', $blog->title_en) }}" placeholder="blog title" name="title_en"
                                            aria-label="blog title">

                                        @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- meta_description_ar-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>
                                        <input type="text" class="form-control @error('meta_description_ar') is-invalid @enderror" required id="ecommerce-product-name"
                                            value="{{ old('meta_description_ar', $blog->meta_description_ar) }}" placeholder="{!! __('admin.Meta_Description_ar1') !!}"
                                            name="meta_description_ar" aria-label="Product title">

                                        @error('meta_description_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- --------------------------------------------------------------end meta_description_ar-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- Meta_Description_en-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                        <input type="text" class="form-control @error('meta_description_en') is-invalid @enderror" required id="ecommerce-product-name"
                                            value="{{ old('meta_description_en', $blog->meta_description_en) }}" placeholder="{!! __('admin.Meta_Description_en1') !!}"
                                            name="meta_description_en" aria-label="Product title">

                                        @error('meta_description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- --------------------------------------------------------------end Meta_Description_en-------------------------------------------------------------------- --}}

                                    {{-- --------------------------------------------------------------  overview_ar-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Overview_ar') !!}</label>
                                        <textarea class="form-control @error('overview_ar') is-invalid @enderror" name="overview_ar" placeholder="اكتب هنا ">{{ old('overview_ar', $blog->overview_ar) }}</textarea>

                                        @error('overview_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- --------------------------------------------------------------end overview_ar-------------------------------------------------------------------- --}}

                                    {{-- --------------------------------------------------------------  overview_en-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Overview_en') !!}</label>
                                        <textarea class="form-control @error('overview_en') is-invalid @enderror" name="overview_en" placeholder="Write here ">{{ old('overview_en', $blog->overview_en) }}</textarea>

                                        @error('overview_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- --------------------------------------------------------------end overview_en-------------------------------------------------------------------- --}}

                                    {{-- --------------------------------------------------------------  Item-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Description') !!} </label>

                                        <div class="row" id="row_item">

                                            @foreach ($blog->blogDescription as $item)
                                                <div class="option-row1 row">
                                                    <div class="mb-3 col-5 ">
                                                        <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                                        <input required type="text" id="form-repeater "
                                                            value="{{ $item->title_ar }}" name="title_ar1[]"
                                                            class="form-control" placeholder="Enter  " />
                                                    </div>

                                                    <div class="mb-3 col-5 ">
                                                        <label class="form-label">{!! __('admin.Description_ar') !!}</label>
                                                        <textarea class="form-control" name="description_ar1[]" placeholder="اكتب هنا ">{{ $item->description_ar }}</textarea>
                                                    </div>

                                                    <div class="mb-3 col-5 ">
                                                        <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                                        <input required type="text" id="form-repeater "
                                                            value="{{ $item->title_en }}" name="title_en1[]"
                                                            class="form-control" placeholder="Enter  " />
                                                    </div>

                                                    <div class="mb-3 col-5 ">
                                                        <label class="form-label">{!! __('admin.Description_en') !!}</label>
                                                        <textarea class="form-control" name="description_en1[]" placeholder="Write here ">{{ $item->description_en }}</textarea>
                                                    </div>

                                                    <div class="mb-3 col-2">
                                                        <label class="form-label invisible" for="form-repeater-1-2">Not visible</label>
                                                        <button type="button" class="btn btn-danger remove-option1">{!! __('admin.Delete') !!}</button>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>

                                        @error('Item')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <button type="button" class="btn btn-primary" onclick="additem()">
                                            {!! __('admin.Add Another Description') !!}
                                        </button>
                                    </div>
                                    {{-- --------------------------------------------------------------end item-------------------------------------------------------------------- --}}

                                    <div class="row g-6">
                                        {{-- -------------------------------------------------------------- tag_ar-------------------------------------------------------------------- --}}
                                        <div class="mb-3">
                                            <label for="ecommerce-product-tags" class="form-label mb-1">Tag_ar</label>
                                            <input id="ecommerce-product-tags" class="form-control @error('tag_ar') is-invalid @enderror" name="tag_ar"
                                                value="{{ old('tag_ar', $blog->tag_ar) }}" aria-label="Product tag_ar" />

                                            @error('tag_ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- --------------------------------------------------------------end tag_ar-------------------------------------------------------------------- --}}
                                        
                                        {{-- -------------------------------------------------------------- tag_en-------------------------------------------------------------------- --}}
                                        <div class="mb-3">
                                            <label for="ecommerce-product-tags" class="form-label mb-1">tag_en</label>
                                            <input id="ecommerce-product-tags1" class="form-control @error('tag_en') is-invalid @enderror" name="tag_en"
                                                value="{{ old('tag_en', $blog->tag_en) }}" aria-label="Product tag_en" />

                                            @error('tag_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- --------------------------------------------------------------end tag_en-------------------------------------------------------------------- --}}
                                    </div>

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    
                                    {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Photo') !!} </label>
                                        <div class="alert alert-info">
                                            <small>{{ __('admin.Upload a new photo if you want to change the current one') }}</small>
                                        </div>
                                        <input type="file" name="photo" onchange="readURL(this);"
                                            class="form-control @error('photo') is-invalid @enderror">

                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <!-- Current Photo Preview -->
                                        <div class="mt-3">
                                            <label class="form-label">{{ __('admin.Current Photo') }}:</label>
                                            <div class="row last">
                                                <div class="col-md-3 mb-3 position-relative">
                                                    @if($blog->photo)
                                                        <a target="_blank" href="{{ asset('storage/blog') }}/{{ $blog->photo }}">
                                                            <img id="photo-preview" style="width: 100%; height: auto; padding: 5px; border: 1px solid #ddd; border-radius: 4px;"
                                                                src="{{ asset('storage/blog') }}/{{ $blog->photo }}"
                                                                alt="{{ __('admin.Current blog photo') }}" />
                                                        </a>
                                                    @else
                                                        <div class="text-center p-3 border rounded">
                                                            <i class="bx bx-image text-muted" style="font-size: 2rem;"></i>
                                                            <p class="text-muted mt-2">{{ __('admin.No photo uploaded') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}

                                    <!-- Submit Button -->
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('blog.index') }}" class="btn btn-secondary me-2">
                                            <i class="bx bx-arrow-back me-1"></i> {{ __('admin.Cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i> {!! __('admin.Submit') !!}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            // التعامل مع Tagify
            var $e = $("#ecommerce-product-tags");
            if ($e.length) {
                new Tagify($e[0]);
            }
            // التعامل مع Tagify
            var $e = $("#ecommerce-product-tags1");
            if ($e.length) {
                new Tagify($e[0]);
            }
        });

        // Function to preview uploaded image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function additem() {
            var item = ` <div class="option-row1 row">
<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Title_ar') !!}</label>
<input required type="text" id="form-repeater "   name="title_ar1[]" class="form-control" placeholder="Enter  " />
</div>

<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Description_ar') !!}</label>
<textarea class="form-control" name="description_ar1[]" placeholder="اكتب هنا "></textarea>
</div>

<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Title_en') !!}</label>
<input required type="text" id="form-repeater "   name="title_en1[]" class="form-control" placeholder="Enter  " />
</div>

<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Description_en') !!}</label>
<textarea class="form-control" name="description_en1[]" placeholder="Write here "></textarea>
</div>

<div class="mb-3 col-2">
<label class="form-label invisible" for="form-repeater-1-2">Not visible</label>
<button type="button" class="btn btn-danger remove-option1">{!! __('admin.Delete') !!}</button>
</div>
</div>
<hr>
`;

            $('#row_item').append(item);
        }
        
        $(document).on('click', '.remove-option1', function() {
            $(this).closest('.option-row1').next('hr').remove();
            $(this).closest('.option-row1').remove();
        });
    </script>
@endsection
