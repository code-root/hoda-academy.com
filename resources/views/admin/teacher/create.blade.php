@extends('admin.layout.app')
@section('page', 'Order List')
@section('contant')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4">
            <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title m-0">{!! __('admin.Add Teachers') !!}</h5>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show text-center">
                                        {{ session('success') }}
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

                                <form action="{{ route('teachers.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3 g-3">
                                        <!-- Arabic Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Name_ar') !!}</label>
                                                <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                                       value="{{ old('name_ar') }}" name="name_ar" required>
                                                @error('name_ar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- English Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Name_en') !!}</label>
                                                <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                                       value="{{ old('name_en') }}" name="name_en" required>
                                                @error('name_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Meta Description (Arabic) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>
                                                <input type="text" class="form-control @error('meta_description_ar') is-invalid @enderror"
                                                       value="{{ old('meta_description_ar') }}" name="meta_description_ar" required>
                                                @error('meta_description_ar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Meta Description (English) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                <input type="text" class="form-control @error('meta_description_en') is-invalid @enderror"
                                                       value="{{ old('meta_description_en') }}" name="meta_description_en" required>
                                                @error('meta_description_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Phone') !!}</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                       value="{{ old('phone') }}" name="phone" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Country -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Country') !!}</label>
                                                <select name="country_id" class="form-select @error('country_id') is-invalid @enderror" required>
                                                    <option value="" disabled selected>Select Country</option>
                                                    @foreach ($country as $item)
                                                        <option value="{{ $item->id }}" {{ old('country_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Category') !!}</label>
                                                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                                    <option value="مدرس قرآن" selected>مدرس قرآن</option>
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Overview (Arabic) -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Overview_ar') !!}</label>
                                                <textarea class="form-control @error('overview_ar') is-invalid @enderror"
                                                          name="overview_ar" rows="3" required>{{ old('overview_ar') }}</textarea>
                                                @error('overview_ar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Overview (English) -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Overview_en') !!}</label>
                                                <textarea class="form-control @error('overview_en') is-invalid @enderror"
                                                          name="overview_en" rows="3" required>{{ old('overview_en') }}</textarea>
                                                @error('overview_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Dynamic Descriptions -->
                                        <div class="col-12">
                                            <label class="form-label">{!! __('admin.Description') !!}</label>
                                            <div class="row" id="row_item">
                                                <!-- Items will be added here dynamically -->
                                            </div>
                                            <button type="button" class="btn btn-primary mt-2" onclick="addItem()">
                                                {!! __('admin.Add Another Description') !!}
                                            </button>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Email') !!}</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                       value="{{ old('email') }}" name="email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Password') !!}</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                       name="password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Photo -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">{!! __('admin.Photo') !!}</label>
                                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                       name="photo" accept="image/*">
                                                @error('photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-3">
                                        <button type="submit" class="btn btn-primary">
                                            {!! __('admin.Submit') !!}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @section('footer') --}}
    <!-- Page JS -->
    <script src="{{ asset('admin') }}/js/app-ecommerce-settings.js"></script>

    <script>
        // Add initial item
        addItem();

        function addItem() {
            var item = `
            <div class="option-row1 row mb-3">
                <div class="col-md-5">
                    <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                    <input type="text" name="title_ar1[]" class="form-control" required>
                </div>

                <div class="col-md-5">
                    <label class="form-label">{!! __('admin.Description_ar') !!}</label>
                    <textarea class="form-control" name="description_ar1[]" rows="2" required></textarea>
                </div>

                <div class="col-md-5">
                    <label class="form-label">{!! __('admin.Title_en') !!}</label>
                    <input type="text" name="title_en1[]" class="form-control" required>
                </div>

                <div class="col-md-5">
                    <label class="form-label">{!! __('admin.Description_en') !!}</label>
                    <textarea class="form-control" name="description_en1[]" rows="2" required></textarea>
                </div>

                <div class="col-md-2 d-flex align-items-end">
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

{{-- @endsection --}}
