@extends('includes.master')

@section('title')
    Parts Europe
@endsection

@section('content')
<div class="content">

    @include('includes.notifications')

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-4 mb-5">Welcome to Parts Europe search page!</h1>

            @if ($vehicles->isEmpty())
            <p class="lead">First you need to upload Excel file containing Vehicle list. You can find one in "data" directory of tihs project.</p>
            <form action="{{ route('vehicles.import') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="vehicles_list" name="vehicles_list">
                                <label class="custom-file-label" for="vehicles_list">Choose vehicles file</label>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif

            @if ($vehicles->isNotEmpty() && $vehicles[0]->parts->isEmpty())
            <p class="lead">Next you need to upload CSV file containing Parts list. You can find one in "data" directory of tihs project.</p>
            <form action="{{ route('parts.import') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="parts_list" name="parts_list">
                            <label class="custom-file-label" for="parts_list">Choose parts file</label>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            @endif

        </div>

        @if ($vehicles->isNotEmpty() && $vehicles[0]->parts->isNotEmpty())
        <div class="main-content bg-light p-4">
            <div class="row">
                <div class="col-3">
                    <aside class="sidebar">
                        <div class="filters">
                            <form id="filters-form">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select class="custom-select" id="brand" name="bike_producer">
                                        <option value="0">Select bike producer</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->bike_producer }}">{{ $brand->bike_producer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <select class="custom-select" id="model" name="bike_model" disabled>
                                        <option value="0">Select model</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="size">Displacement</label>
                                    <select class="custom-select" id="size" name="size">
                                        <option value="0">Select engine size</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->size }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="year">Model year</label>
                                    <select class="custom-select" id="year" name="year">
                                        <option value="0">Select model year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <a href="/" class="btn btn-primary float-right">Reset filters</a>
                        </div>
                    </aside>
                </div>
                <div class="col-9">
                    <section class="search-results">
                        <div class="row card-deck">
                            @foreach ($vehicles as $vehicle)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-img-top"><span>{{ $vehicle->series }} image</span></div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $vehicle->fullName() }}</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Series: {{ $vehicle->series }}</li>
                                                <li class="list-group-item">Size: {{ $vehicle->size }}</li>
                                                <li class="list-group-item">Model: {{ $vehicle->bike_model }}</li>
                                                <li class="list-group-item">Year: {{ $vehicle->year }}</li>
                                            </ul>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#parts-modal-{{$vehicle->vehicle_id}}">Available parts</button>
                                        </div>
                                    </div>
                                </div>
                                @include('chunks.modals.parts', [ 'vehicle' => $vehicle ])
                            @endforeach
                        </div>
                        <div class="pagination-wrapper">
                            {{ $vehicles->links() }}
                        </div>
                    </section>
                </div>

            </div>
        </div>
        @endif

    </div>

</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function () {
        $('#model, #size, #year').change(function() {
            callAjax($('#filters-form').serialize(), "{{ route('search') }}");
        });
        $('#brand').change(function() {
            resetSelects();
            callAjax($('#filters-form').serialize(), "{{ route('search') }}");
        });

        $('.search-results').on('click', '.filtered .page-link', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('?').pop();
            callAjax( page, "{{ route('search') }}" );
        })
    });

</script>
@endpush
