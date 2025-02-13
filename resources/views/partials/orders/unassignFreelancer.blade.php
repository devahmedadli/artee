<!-- Modal -->
<div class="modal fade" id="unassignFreelancerModal-{{ $id }}" tabindex="-1"
    aria-labelledby="unassignFreelancerModalLabel-{{ $id }}" aria-hidden="true">
    <form action="" method="post" class="modal-dialog modal-dialog-centered modal-lg">
        @csrf
        <input type="hidden" name="order_id" value="{{ $id }}">
        <div class="modal-content container p-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="assignFreelancerModalLabel-{{ $id }}">ازالة المستقل</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </form>
</div>
