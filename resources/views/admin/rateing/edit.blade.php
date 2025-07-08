@extends('admin.layout.app')
@section('page', 'Edit Rating')
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

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Rating Edit Form -->
        <form action="{{ route('rateing.update', $rateing->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="app-ecommerce">
                <!-- Header Section -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">{{ __('admin.Edit') }} /</span> {{ __('admin.Rating') }}
                    </h4>
                </div>

                <div class="row">
                    <!-- Main Form Column -->
                    <div class="col-12 col-lg-12">
                        <!-- Rating Information Card -->
                        <div class="card mb-12">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ __('admin.Edit Rating') }}</h5>
                            </div>

                            <div class="card-body">
                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.Name') }} *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" required
                                           id="rating-name" value="{{ old('name', $rateing->name) }}"
                                           placeholder="{{ __('admin.Name') }}" name="name"
                                           aria-label="Rating name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Name Field -->

                                <!-- Review Field -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.Review') }}</label>
                                    <textarea class="form-control @error('review') is-invalid @enderror" name="review"
                                              placeholder="{{ __('admin.Write your review here') }}"
                                              rows="3">{{ old('review', $rateing->review) }}</textarea>
                                    @error('review')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Review Field -->

                                <!-- Rating Field -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.Rating') }} *</label>
                                    <input type="number" class="form-control @error('rate') is-invalid @enderror" required
                                           id="rating-value" value="{{ old('rate', $rateing->rate) }}"
                                           placeholder="{{ __('admin.Enter rating (1-5)') }}"
                                           name="rate" min="1" max="5"
                                           aria-label="Rating value">
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Rating Field -->

                                <!-- Photo Field -->
                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Photo') }}</label>
                                    <div class="alert alert-info">
                                        <small>{{ __('admin.Upload a new photo if you want to change the current one') }}</small>
                                    </div>
                                    <input type="file" name="photo"
                                           onchange="readURL(this);"
                                           class="form-control @error('photo') is-invalid @enderror">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Current Photo Preview -->
                                    <div class="mt-3">
                                        <label class="form-label">{{ __('admin.Current Photo') }}:</label>
                                        <div class="row last">
                                            <div class="col-md-3 mb-3 position-relative">
                                                @if($rateing->photo)
                                                    <a target="_blank" href="/images/{{ $rateing->photo }}">
                                                        <img id="photo-preview"
                                                             style="width: 100%; height: auto; padding: 5px; border: 1px solid #ddd; border-radius: 4px;"
                                                             src="/images/{{ $rateing->photo }}"
                                                             alt="{{ __('admin.Current rating photo') }}">
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
                                <!-- End Photo Field -->

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('rateing.index') }}" class="btn btn-secondary me-2">
                                        <i class="bx bx-arrow-back me-1"></i> {{ __('admin.Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> {{ __('admin.Update Rating') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End Rating Information Card -->
                    </div>
                </div>
            </div>
        </form>
        <!-- End Rating Edit Form -->
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

            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
