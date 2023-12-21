<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form data-update-id="{{$data->id}}" id="updateUser" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" value="{{$data->id}}" name="id">
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Name :- </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$data->name)}}">
                </div>
                <div class="mb-3 form-group">
                    <label for="email" class="form-label">Email address :- </label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email',$data->email) }}">
                </div>
                <div class="mb-3 form-group">
                    <label for="photo" class="form-label">Image :- </label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    <input type="hidden" name="old_img" value={{ $data->image}}>
                    <img src="{{ asset('images/' . $data->id . '/' . $data->image)}}" width="200px" class="pt-2" id="old_img">
                    <img src="#" id="preview_img" width="200px" style="display:none;" name="new_img" class="pt-2"/> 
                </div>
                <label for="address" class="form-label">Address :- </label>
                <div class="row input_fields_wrap">
                    @foreach($data->address as $key => $address)
                        <div class="row ">
                            <div class="mb-3 col-8 form-group">
                                <textarea class="form-control" id="address" name="multiple_addresses[{{$key}}][address]">{{ $address->address }}</textarea>
                            </div>
                            <div class="mb-3 col-2 form-check pt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="is_default" {{ $address->is_default == '1' ? 'checked' : ''}} name="multiple_addresses[{{$key}}][is_default]">
                                <label class="form-check-label" for="is_default">
                                    Mark as Default
                                </label>
                            </div>
                            <div class="mb-3 col-1 pt-2">
                                <input type="button" class="btn btn-secondary remove_field" value="-">
                            </div>
                            <div class="mb-3 col-1 pt-2">
                                <input type="button" class="btn btn-secondary add_field_button" value="+">
                            </div>
                            @if($loop->last)
                                <input type="hidden" value="{{$key}}" id="hidden_id">
                            @endif  
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"  id="submitForm">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function (){
        //for preview image
        photo.onchange = evt => {
            preview = document.getElementById('preview_img');
            preview.style.display = 'block';
            const [file] = photo.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
            old_img.style.display = 'none';
        }

        //for add address dynamically 
        var max_fields      = 7; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var key = $('#hidden_id').val();
        
        var x = parseInt(key) + 1;  //initlal text box count
        console.log(x);
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class=row>' + 
                    '<div class="mb-3 col-8 form-group">' + 
                    '<textarea class="form-control" id="address" name="multiple_addresses[' + (x - 1) + '][address]"></textarea></div>' + 
                    '<div class="mb-3 col-2 form-check pt-3">' + 
                    '<input class="form-check-input" type="checkbox" value="1" id="is_default" name="multiple_addresses[' + (x - 1) + '][is_default]">' + 
                    '<label class="form-check-label" for="is_default">Mark as Default</label></div>' + 
                    '<div class="mb-3 col-1 pt-2"><input type="button" class="btn btn-secondary remove_field" value="-"></div>' +
                    '<div class="mb-3 col-1 pt-2"><input type="button" class="btn btn-secondary add_field_button" value="+"></div></div>'
                    ); // add input boxes.
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
        });

        //for validate form using jquery
        $('#updateUser').validate({
            rules: {
                name : {
                    required : true,
                    maxlength : 255,
                },
                email : {
                    required : true,
                    email : true
                },
                password : {
                    minlength : 6
                },
                photo: {
                    accept: "image/jpg,image/jpeg,image/png",
                }
            },
            messages : {
                name : {
                    required : "Name is Required",
                    maxlength : "Name cannot be more than 255 characters"
                },
                email : {
                    required : "Email is required",
                    email : "Email must be a valid email address"
                },
                password : {
                    minlength : "Password must be at least 6 characters"
                },
                photo : {
                    accept: "Please upload file in these format only (jpg, jpeg, png).", 
                    max: "Image size cannot be more than 2048 bytes"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        //for update record
        $("#updateUser").on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#updateUser').attr('data-update-id');
            let url = "{{ route('user.update',':id')}}".replace(':id',id);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res && res.success) {
                        $('#edit-modal').modal('hide');
                        table.ajax.reload();
                    }
                },
                error: function (res) {
                    console.log('error', res.message);
                },
            });
        });
    });
</script>