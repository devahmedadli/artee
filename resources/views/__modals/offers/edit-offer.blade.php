<div class="modal fade" id="editModal{{ $offer->id }}" tabindex="-1"
    aria-labelledby="editModalLabel{{ $offer->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $offer->id }}">
                    {{ __('Update Price') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="admin_price" class="form-label">
                            {{ __('Offered Price') }}</label>
                        <input type="number" class="form-control" id="admin_price"
                            name="admin_price" value="{{ $offer->admin_price }}"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit"
                        class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>