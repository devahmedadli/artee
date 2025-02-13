<div class="modal fade" id="sendPrice{{ $offer->id }}" tabindex="-1" aria-labelledby="sendPriceLabel{{ $offer->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendPriceLabel{{ $offer->id }}">
                    {{ __('Update Price') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('freelancer.offers.sendPrice', $offer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="freelancer_price" class="form-label">
                            {{ __('Required Price') }}
                        </label>
                        <input type="number" class="form-control" id="freelancer_price" name="freelancer_price"
                            value="{{ $offer->freelancer_price ?? '' }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
