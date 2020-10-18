<div id="parts-modal-{{$vehicle->vehicle_id}}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Parts for: {{ $vehicle->fullName() }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    @forelse ($vehicle->parts as $part)
                    <li class="list-group-item">
                        @if ($part->active)
                            {{-- TODO: Link should point to "parts/show" page with info about Part --}}
                            <a class="text-success" href="">{{ $part->name }}
                                <span class="float-right badge badge-success">Available</span>
                            </a>
                        @else
                            <a class="text-danger">{{ $part->name }}
                                <span class="float-right badge badge-danger">Out of stock</span>
                            </a>
                        @endif
                    </li>
                    @empty
                        <li>No available parts for this model</li>
                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
