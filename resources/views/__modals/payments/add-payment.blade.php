<div class="modal fade {{ $errors->any() ? 'show' : '' }}" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">تسجيل عملية دفع جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPaymentForm" action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="freelancer_id" class="form-label">المستخدم</label>
                        <select class="form-select" id="freelancer_id" name="freelancer_id" required>
                            @foreach ($freelancers as $freelancer)
                                <option value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                            @endforeach
                        </select>
                        @error('freelancer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                            required>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="method" class="form-label">طريقة الدفع</label>
                        <input type="text" class="form-control" id="method" name="method" required>
                        @error('method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">التفاصيل</label>
                        <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                        @error('details')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">التاريخ</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ now()->toDateString() }}" required>
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">تسجيل</button>
                </form>
            </div>
        </div>
    </div>
</div>
