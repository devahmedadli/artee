{{-- set order price modal --}}
<div class="modal fade" id="setOrderPriceModal" tabindex="-1" aria-labelledby="setOrderPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setOrderPriceModalLabel">
                    {{ __('Set Order Price') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.set-price', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="subtotal" class="form-label">{{ __('Cost') }}</label>
                        <input type="number" class="form-control" id="subtotal" name="subtotal" min="0"
                            placeholder="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">{{ __('Discount') }}
                            $</label>
                        <input type="number" class="form-control" id="discount" name="discount" min="0"
                            placeholder="10" required>
                    </div>
                    {{-- display total --}}
                    <div class="mb-3">
                        <label for="total" class="form-label">{{ __('Total') }}</label>
                        <input type="number" class="form-control" id="total" name="total" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Set Price') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
