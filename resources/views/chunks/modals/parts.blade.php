<div id="parts-modal-{{$vehicle->vehicle_id}}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Parts for: {{ $vehicle->fullName() }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                @foreach ($vehicle->parts as $part)
                    <li class="list-group-item"><a class="{{ $part->active ? 'text-success' : 'text-danger' }}" {{ $part->active ? 'href': '' }}> {{ $part->name }}</a></li>
                @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
