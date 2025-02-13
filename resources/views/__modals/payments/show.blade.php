{{-- show payment modal --}}
<div class="modal fade" id="showPaymentModal-{{ $payment->id }}" tabindex="-1"
    aria-labelledby="showPaymentModalLabel-{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showPaymentModalLabel-{{ $payment->id }}">تفاصيل الدفع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>المستقل: {{ $payment->freelancer->name }}</p>
                <p>المبلغ: {{ $payment->amount }} $ </p>
                <p>التاريخ: {{ $payment->date }}</p>
                <p>التفاصيل: {{ $payment->details }}</p>
            </div>
        </div>
    </div>
</div>
