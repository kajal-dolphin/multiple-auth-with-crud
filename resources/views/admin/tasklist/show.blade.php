<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Show User Detail</h5>
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
            <div class="modal-body">
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Task Subject :- </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->subject }}" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="description" class="form-label">Description :- </label>
                    <textarea name="description" id="description" class="description form-control" readonly>{{ $data->description }}</textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="start_date" class="form-label"> Start Date :- </label>
                    <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="start_date" class="form-label"> End Date :- </label>
                    <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Status :- </label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ $data->status }}" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="name" class="form-label"> Priority :- </label>
                    <input type="text" class="form-control" id="name" name="priority" value="{{ $data->priority }}" readonly>
                </div>
            </div>
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>