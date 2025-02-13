{{-- edit order progress modal --}}
<div class="modal fade" id="editOrderProgressModal-{{ $progress->id }}" tabindex="-1" aria-labelledby="editOrderProgressModalLabel-{{ $progress->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderProgressModalLabel-{{ $progress->id }}">
                    {{ __('Edit Order Progress') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.orders.progress.update', $progress->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="note" class="form-label">{{ __('Note') }}</label>
                        <textarea type="text" class="form-control" id="note" name="note" rows="5" required>{{ $progress->note }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
