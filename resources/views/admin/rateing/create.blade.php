@extends('admin.layout.app')

@section('page', 'Create Rating')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Rating Creation Form -->
        <form action="{{ route('rateing.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="app-ecommerce">
                <!-- Page Header -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">{{ __('admin.Create') }} /</span> {{ __('admin.Rating') }}
                    </h4>
                </div>

                <div class="row">
                    <!-- Main Form Column -->
                    <div class="col-12 col-lg-12">
                        <!-- Rating Information Card -->
                        <div class="card mb-12">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ __('admin.Add New Rating') }}</h5>
                            </div>

                            <div class="card-body">
                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.Name') }} *</label>
                                    <input type="text" class="form-control" required
                                           id="rating-name" value="{{ old('name') }}"
                                           placeholder="{{ __('admin.Enter name') }}"
                                           name="name" aria-label="Rating name">
                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Name Field -->

                                <!-- Review Field -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.Review') }}</label>
                                    <textarea class="form-control" name="review" rows="3"
                                              placeholder="{{ __('admin.Write your review here') }}">{{ old('review') }}</textarea>
                                    @error('review')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Review Field -->

                                <!-- Rating Value Field -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.Rating') }} (1-5) *</label>
                                    <input type="number" class="form-control" required
                                           id="rating-value" value="{{ old('rate') }}"
                                           placeholder="{{ __('admin.Enter rating value') }}"
                                           name="rate" min="1" max="5"
                                           aria-label="Rating value">
                                    <small class="text-muted">{{ __('admin.Please enter a value between 1 and 5') }}</small>
                                    @error('rate')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Rating Value Field -->

                                <!-- Photo Upload Field -->
                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Photo') }}</label>
                                    <div class="alert alert-info">
                                        <small>{{ __('admin.Upload a photo to represent this rating') }}</small>
                                    </div>
                                    <input type="file" name="photo"
                                           onchange="readURL(this);"
                                           class="form-control">
                                    @error('photo')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror

                                    <!-- Photo Preview Area -->
                                    <div class="mt-3">
                                        <label class="form-label">{{ __('admin.Photo Preview') }}:</label>
                                        <div class="row last">
                                            <div class="col-md-3 mb-3 position-relative">
                                                <img id="photo-preview"
                                                     style="width: 100%; height: auto; padding: 5px; border: 1px dashed #ddd; border-radius: 4px; display: none;"
                                                     alt="{{ __('admin.Photo preview will appear here') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Photo Upload Field -->

                                <!-- Form Actions -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i> {{ __('admin.Create Rating') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End Rating Information Card -->
                    </div>
                </div>
            </div>
        </form>
        <!-- End Rating Creation Form -->
    </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>
<script>
    // Function to preview uploaded image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var preview = document.getElementById('photo-preview');

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
