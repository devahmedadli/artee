<div class="modal fade" id="editPaymentModal-{{ $payment->id }}" tabindex="-1"
    aria-labelledby="editPaymentModalLabel-{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentModalLabel-{{ $payment->id }}">تعديل عملية دفع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPaymentForm-{{ $payment->id }}" action="{{ route('payments.update', $payment->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="freelancer_id" class="form-label">المستخدم</label>
                        <select class="form-select" id="freelancer_id" name="freelancer_id" required>
                            @foreach ($freelancers as $freelancer)
                                <option value="{{ $freelancer->id }}"
                                    {{ $payment->freelancer_id == $freelancer->id ? 'selected' : '' }}>
                                    {{ $freelancer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                            value="{{ $payment->amount }}" required>
                    </div>
                    {{-- payment details --}}
                    <div class="mb-3">
                        <label for="details" class="form-label">التفاصيل</label>
                        <textarea class="form-control" id="details" name="details" rows="3">{{ $payment->details }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">التاريخ</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $payment->date }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">تسجيل</button>
                </form>
            </div>
        </div>
    </div>
</div>
