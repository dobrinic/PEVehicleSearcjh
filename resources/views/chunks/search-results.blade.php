<div class="row card-deck">
    @foreach ($vehicles2 as $vehicle)
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
    {{ $vehicles2->appends(['sort' => 'votes'])->links() }}
</div>
