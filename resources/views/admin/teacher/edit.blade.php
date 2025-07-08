@extends('admin.layout.app')

@section('page', 'Order List')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4">
            <!-- Options -->
            <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                <div class="tab-content p-0">
                    <!-- Store Details Tab -->
                    <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title m-0">{!! __('admin.Edit Teachers') !!}</h5>
                            </div>
                            <div class="card-body">
                                {{-- ------------------------- Alert ------------------------- --}}
                                @if (session('success'))
                                    <div id="success-message" class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div id="danger-message" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
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
                                {{-- ------------------------- End Alert ------------------------- --}}

                                <form action="{{ route('teachers.update', $id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3 g-3">
                                        <!-- Name Arabic -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Name_ar') !!}</label>
                                            <input type="text" class="form-control" required
                                                value="{{ $teachers->name_ar }}"
                                                placeholder="{!! __('admin.Name_ar1') !!}" name="name_ar">
                                            @error('name_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Name English -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Name_en') !!}</label>
                                            <input type="text" class="form-control" required
                                                value="{{ $teachers->name_en }}"
                                                placeholder="{!! __('admin.Name_en1') !!}" name="name_en">
                                            @error('name_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Meta Description Arabic -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>
                                            <input type="text" class="form-control" required
                                                value="{{ $teachers->meta_description_ar }}"
                                                placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="meta_description_ar">
                                            @error('meta_description_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Meta Description English -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                            <input type="text" class="form-control" required
                                                value="{{ $teachers->meta_description_en }}"
                                                placeholder="{!! __('admin.Meta_Description_en1') !!}" name="meta_description_en">
                                            @error('meta_description_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Phone') !!}</label>
                                            <input type="text" class="form-control" required
                                                value="{{ $teachers->phone }}"
                                                placeholder="{!! __('admin.Phone') !!}" name="phone">
                                            @error('phone')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Country -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Country') !!}</label>
                                            <select name="country_id" class="select2 form-select" data-placeholder="Select Country">
                                                <option value="" disabled>Select Country</option>
                                                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $teachers->country_id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Category -->
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Category') !!}</label>
                                            <select name="category" class="select2 form-select" data-placeholder="Select Category">
                                                <option value="مدرس قرآن" selected>مدرس قرآن</option>
                                            </select>
                                            @error('category')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Overview Arabic -->
                                        <div>
                                            <label class="form-label">{!! __('admin.Overview_ar') !!}</label>
                                            <textarea class="form-control" name="overview_ar" placeholder="اكتب هنا ">{{ $teachers->overview_ar }}</textarea>
                                            @error('overview_ar')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Overview English -->
                                        <div class="mt-3">
                                            <label class="form-label">{!! __('admin.Overview_en') !!}</label>
                                            <textarea class="form-control" name="overview_en" placeholder="اكتب هنا ">{{ $teachers->overview_en }}</textarea>
                                            @error('overview_en')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Dynamic Descriptions -->
                                        <div class="mt-3">
                                            <label class="form-label">{!! __('admin.Description') !!}</label>
                                            <div class="row" id="row_item">
                                                @foreach ($teachers->userDescription as $item)
                                                    <div class="option-row1 row">
                                                        <div class="mb-3 col-5">
                                                            <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                                            <input required type="text" name="title_ar1[]" class="form-control" value="{{ $item->title_ar }}" placeholder="Enter">
                                                        </div>
                                                        <div class="mb-3 col-5">
                                                            <label class="form-label">{!! __('admin.Description_ar') !!}</label>
                                                            <textarea class="form-control" name="description_ar1[]" placeholder="اكتب هنا ">{{ $item->description_ar }}</textarea>
                                                        </div>
                                                        <div class="mb-3 col-5">
                                                            <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                                            <input required type="text" name="title_en1[]" class="form-control" value="{{ $item->title_en }}" placeholder="Enter">
                                                        </div>
                                                        <div class="mb-3 col-5">
                                                            <label class="form-label">{!! __('admin.Description_en') !!}</label>
                                                            <textarea class="form-control" name="description_en1[]" placeholder="اكتب هنا ">{{ $item->description_en }}</textarea>
                                                        </div>
                                                        <div class="mb-3 col-2 d-flex align-items-end">
                                                            <button type="button" class="btn btn-danger remove-option1">{!! __('admin.Delete') !!}</button>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-primary mt-2" onclick="additem()">
                                                {!! __('admin.Add Another Description') !!}
                                            </button>
                                            @error('Item')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Email -->
                                        <div class="col-12 col-md-6 mt-3">
                                            <label class="form-label mb-0" for="email">{!! __('admin.Email') !!}</label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ $teachers->email }}" placeholder="johndoe@gmail.com"
                                                name="email">
                                        </div>
                                        <!-- Password -->
                                        <div class="col-12 col-md-6 mt-3">
                                            <label class="form-label mb-0" for="password">{!! __('admin.Password') !!}</label>
                                            <input type="password" class="form-control" id="password"
                                                name="password" placeholder="Enter a new password">
                                        </div>
                                        <!-- Photo -->
                                        <div class="col-12 col-md-12 mt-3">
                                            <label class="form-label mb-0" for="photo">{!! __('admin.Photo') !!}</label>
                                            <input type="file" class="form-control" id="photo" name="photo">
                                            <br>
                                            <img style="width: 120px;height:auto"
                                                src="{{ asset('images') }}/{{ $teachers->photo != null ? $teachers->photo : 'no-image.png' }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-3 mt-4">
                                        <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Options -->
        </div>
    </div>
    <!-- /Content wrapper -->
</div>
@endsection

@section('footer')
<script src="{{ asset('admin') }}/js/app-ecommerce-settings.js"></script>
<script>
    function additem() {
        var item = `
        <div class="option-row1 row">
            <div class="mb-3 col-5">
                <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                <input required type="text" name="title_ar1[]" class="form-control" placeholder="Enter">
            </div>
            <div class="mb-3 col-5">
                <label class="form-label">{!! __('admin.Description_ar') !!}</label>
                <textarea class="form-control" name="description_ar1[]" placeholder="اكتب هنا "></textarea>
            </div>
            <div class="mb-3 col-5">
                <label class="form-label">{!! __('admin.Title_en') !!}</label>
                <input required type="text" name="title_en1[]" class="form-control" placeholder="Enter">
            </div>
            <div class="mb-3 col-5">
                <label class="form-label">{!! __('admin.Description_en') !!}</label>
                <textarea class="form-control" name="description_en1[]" placeholder="اكتب هنا "></textarea>
            </div>
            <div class="mb-3 col-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-option1">{!! __('admin.Delete') !!}</button>
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
