<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#assignFreelancerModal-{{ $id }}">
    <i class="bi bi-person-fill-add"></i>
    {{ __('Assign Freelancer') }}
</button>

<!-- Modal -->
<div class="modal fade" id="assignFreelancerModal-{{ $id }}" tabindex="-1"
    aria-labelledby="assignFreelancerModalLabel-{{ $id }}" aria-hidden="true">
    <form action="{{route('offers.store')}}" method="post" class="modal-dialog modal-dialog-centered modal-lg">
        @csrf
        <input type="hidden" name="order_id" value="{{ $id }}">
        <div class="modal-content container p-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="assignFreelancerModalLabel-{{ $id }}">ارسال عرض الى مستقل
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="form-group mb-3">
                    <label for="freelancer_id" class="form-label">المستقل</label>
                    <select name="freelancer_id" id="freelancer_id" class="form-control">
                        @foreach ($freelancers as $freelancer)
                            <option value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="admin_price" class="form-label">المبلغ</label>
                    <input type="number" step="0.01" min="0" id="admin_price" name="admin_price"
                        class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-primary">إرسال عرض</button>
            </div>
        </div>
    </form>
</div>
