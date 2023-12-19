@extends('admin.layout.app')

@include('admin.layout.header')
@section('content')
    <div class="container pt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="pt-3">
            <form  action="{{ route('user.store')}}" method="post" id="userForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6 form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3 col-md-6 form-group">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 form-group">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3 col-md-6 form-group">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        <img src="#" id="preview_img" width="200px" style="display:none;"/> 
                    </div>
                </div> 
                <div class="row input_fields_wrap">
                    <div class="mb-3 col-md-9 form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="3" name="multiple_addresses[0][address]"></textarea>
                    </div>
                    <div class="mb-3 col-md-1 form-check pt-5">
                        <input class="form-check-input" type="checkbox" value="1" id="is_default" name="multiple_addresses[0][is_default]">
                        <label class="form-check-label" for="is_default">
                            Mark as Default
                        </label>
                    </div>
                    <div class="mb-3 col-md-1 form-check pt-5">
                        <input type="button" class="btn btn-secondary add_field_button" value="Add more">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                    <a type="buttton" class="btn btn-secondary" href="{{ route('admin.dashboard') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function (){
            $('#userForm').validate({
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
                        required : true,
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
                        required : "Password is required",
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

            var max_fields      = 5; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class=row>' + 
                        '<div class="mb-3 col-md-9 form-group">' + 
                        '<textarea class="form-control" id="address" rows="3" name="multiple_addresses[' + (x - 1) + '][address]"></textarea></div>' + 
                        '<div class="mb-3 col-md-1 form-check pt-5">' + 
                        '<input class="form-check-input" type="checkbox" value="1" id="is_default" name="multiple_addresses[' + (x - 1) + '][is_default]">' + 
                        '<label class="form-check-label" for="is_default">Mark as Default</label></div>' + 
                        '<div class="mb-3 col-md-1 form-check pt-5"><input type="button" class="btn btn-secondary remove_field" value="Remove"></div></div>'
                        ); // add input boxes.
                }
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
            });

            //for preview image
            photo.onchange = evt => {
                preview = document.getElementById('preview_img');
                preview.style.display = 'block';
                const [file] = photo.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        });
    </script>
@endsection