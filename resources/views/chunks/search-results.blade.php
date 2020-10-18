<div class="row card-deck">
    @foreach ($vehicles as $vehicle)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-img-top"><span>{{ $vehicle->series }} image</span></div>
                <div class="card-body">
                    <h5 class="card-title mb-4">{{ $vehicle->fullName() }}</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bolder text-muted">
                            <span class="">Series:</span>
                            <span class="">{{ $vehicle->series }}</span>
                        </li>
                        <li class="list-group-item bolder text-muted">
                            <span class="">Size:</span>
                            <span class="">{{ $vehicle->size }}</span>
                        </li>
                        <li class="list-group-item bolder text-muted">
                            <span class="">Model:</span>
                            <span class="">{{ $vehicle->bike_model }}</span>
                        </li>
                        <li class="list-group-item bolder text-muted">
                            <span class="">Year:</span>
                            <span class="">{{ $vehicle->year }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#parts-modal-{{$vehicle->vehicle_id}}">Available parts</button>
                </div>
            </div>
        </div>
        {{-- TODO: This should really be separate page "vehicle/show" with info about vehicle and list of available parts --}}
        @include('chunks.modals.parts', [ 'vehicle' => $vehicle ])
    @endforeach
</div>
<div class="pagination-wrapper filtered">
    {{ $vehicles->links() }}
</div>
