@extends('admin.layout.app')
@section('page', 'Create blog')
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

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">
                    <div class="row">
                        <!-- Main Content Column -->
                        <div class="col-12 col-lg-12">
                            <!-- Blog Information Card -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{!! __('admin.Add Blogs') !!}</h5>
                                </div>

                                <div class="card-body">
                                    <!-- Titles Section -->
                                    <div class="row g-3">
                                        <!-- Arabic Title -->
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                            <input type="text" class="form-control" required
                                                   value="{{ old('title_ar') }}"
                                                   placeholder="{!! __('admin.Title_ar1') !!}"
                                                   name="title_ar" aria-label="Blog title">
                                            @error('title_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- English Title -->
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                            <input type="text" class="form-control" required
                                                   value="{{ old('title_en') }}"
                                                   placeholder="{!! __('admin.Title_en1') !!}"
                                                   name="title_en" aria-label="Blog title">
                                            @error('title_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Descriptions Section -->
                                    <div class="row g-3 mt-3">
                                        <!-- Arabic Meta Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>
                                            <input type="text" class="form-control" required
                                                   value="{{ old('meta_description_ar') }}"
                                                   placeholder="{!! __('admin.Meta_Description_ar1') !!}"
                                                   name="meta_description_ar">
                                            @error('meta_description_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- English Meta Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                            <input type="text" class="form-control" required
                                                   value="{{ old('meta_description_en') }}"
                                                   placeholder="{!! __('admin.Meta_Description_en1') !!}"
                                                   name="meta_description_en">
                                            @error('meta_description_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Overview Section -->
                                    <div class="row g-3 mt-3">
                                        <!-- Arabic Overview -->
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Overview_ar') !!}</label>
                                            <textarea class="form-control" name="overview_ar"
                                                      placeholder="اكتب هنا">{{ old('overview_ar') }}</textarea>
                                            @error('overview_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- English Overview -->
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Overview_en') !!}</label>
                                            <textarea class="form-control" name="overview_en"
                                                      placeholder="Write here">{{ old('overview_en') }}</textarea>
                                            @error('overview_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Dynamic Items Section -->
                                    <div class="row g-3 mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Description') !!}</label>
                                            <div id="row_item"></div>

                                            <button type="button" class="btn btn-primary mt-2" onclick="additem()">
                                                {!! __('admin.Add Another Description') !!}
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Tags Section -->
                                    <div class="row g-3 mt-3">
                                        <!-- Arabic Tags -->
                                        <div class="col-md-12">
                                            <label class="form-label">Tag_ar</label>
                                            <input id="ecommerce-product-tags" class="form-control"
                                                   name="tag_ar" value="{{ old('tag_ar') }}">
                                            @error('tag_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- English Tags -->
                                        <div class="col-md-12">
                                            <label class="form-label">tag_en</label>
                                            <input id="ecommerce-product-tags1" class="form-control"
                                                   name="tag_en" value="{{ old('tag_en') }}">
                                            @error('tag_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Photo Upload Section -->
                                    <div class="row g-3 mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label">{!! __('admin.Photo') !!}</label>
                                            <input type="file" multiple name="photo" class="form-control">
                                            @error('photo')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <div class="row last mt-2"></div>
                                        </div>
                                    </div>

                                    <!-- Hidden User ID and Submit Button -->
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        {!! __('admin.Submit') !!}
                                    </button>
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
            // Initialize Tagify for tags input
            var tagInput1 = document.getElementById('ecommerce-product-tags');
            if (tagInput1) {
                new Tagify(tagInput1);
            }

            var tagInput2 = document.getElementById('ecommerce-product-tags1');
            if (tagInput2) {
                new Tagify(tagInput2);
            }
        });

        // Dynamic items functionality
        function additem() {
            var item = `
            <div class="option-row1 row mt-2">
                <div class="mb-3 col-md-5">
                    <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                    <input required type="text" name="title_ar1[]" class="form-control" placeholder="Enter">
                </div>

                <div class="mb-3 col-md-5">
                    <label class="form-label">{!! __('admin.Description_ar') !!}</label>
                    <textarea class="form-control" name="description_ar1[]" placeholder="اكتب هنا"></textarea>
                </div>

                <div class="mb-3 col-md-5">
                    <label class="form-label">{!! __('admin.Title_en') !!}</label>
                    <input required type="text" name="title_en1[]" class="form-control" placeholder="Enter">
                </div>

                <div class="mb-3 col-md-5">
                    <label class="form-label">{!! __('admin.Description_en') !!}</label>
                    <textarea class="form-control" name="description_en1[]" placeholder="Write here"></textarea>
                </div>

                <div class="mb-3 col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-option1">
                        {!! __('admin.Delete') !!}
                    </button>
                </div>
            </div>
            <hr>`;

            $('#row_item').append(item);
        }

        $(document).on('click', '.remove-option1', function() {
            $(this).closest('.option-row1').next('hr').remove();
            $(this).closest('.option-row1').remove();
        });
    </script>
@endsection
