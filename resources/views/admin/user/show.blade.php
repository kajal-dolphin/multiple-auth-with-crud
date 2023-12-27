<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Show User Detail</h5>
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
            @csrf
            <div class="modal-body">
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Name :- </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$data->name)}}" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="email" class="form-label">Email address :- </label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email',$data->email) }}" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="photo" class="form-label">Image :- </label>
                    <div>
                        <img src="{{ asset('storage/images/' . $data->id . '/' . $data->image)}}" width="200px" class="pt-2" id="old_img">
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="form-label">Address :- </label>
                    @foreach($data->addresses as $key => $address)
                        @if($address->is_default == 1)
                            <div class="row">
                                <div class="mb-3 col-md-11 form-group">
                                    <textarea class="form-control" id="address" name="multiple_addresses[0][address]" readonly>{{ $address->address }}</textarea>
                                </div>
                                <div class="mb-3 col-md-1 form-check pt-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_default" checked>
                                    <label class="form-check-label" for="is_default">
                                        Default
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="mb-3 form-group">
                                <textarea class="form-control" id="address" name="multiple_addresses[0][address]" readonly>{{ $address->address }}</textarea>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>