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

        $(document).on('click','.add_field_button',function (){
            let id = $(this).attr('id');
            let rowIndexValue = id.split('_').pop();
            let rowIndex = parseInt(rowIndexValue) + 1;
            let url = "{{ route('user.clone.column') }}";
            $.ajax({
                url : url,
                type : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    rowIndex : rowIndex,
                },
                success : function(res) {
                    if (res && res.success) {
                        $('#add_more_feild').append(res.html);
                        var numItems = $('.item').length;
                        if (numItems > 0) {
                            $('.add_more_' + rowIndexValue).css("display", "none");
                            $('.remove_' + rowIndexValue).css("display", "block");
                            $('.remove_' + rowIndex).css("display", "block");
                        }
                    } else {
                        console.log('error', res.message);
                    }
                },
                error: function (res) {
                    console.log('error', res.message);
                },
            })
        });

        $(document).on('click','.remove_field_button', function (){
            let itemLength = $('.item').length;
            let rowId = $(this).attr('id');
            let rowIndexId = rowId.split('_');
            if (rowIndexId.length > 0) {
                $('#item_' + rowIndexId[1]).remove();
            }

            $('.item').each(function (index){
                var cloneIndex = index + 1;
                });
                if (cloneLength == 2) {
                    $('#add_more_' + cloneIndex).show();
                    $('#butDelete_' + cloneIndex).hide();
                } else if (cloneIndex + 1 == cloneLength) {
                    $('#add_more_' + cloneIndex).show();
                    $('#butDelete_' + cloneIndex).show();
                }
            });
        });

      


        // var max_fields      = 5; //maximum input boxes allowed
        // var add_button      = $(".add_field_button"); //Add button ID
        
        // var x = 1; //initlal text box count
        // $(add_button).click(function(e){ //on add input button click
        //     e.preventDefault();
        //     if(x < max_fields){ //max input box allowed
        //         x++; //text box increment
        //         $(wrapper).append(
        //             '<div class=row>' + 
        //             '<div class="mb-3 col-md-9 form-group">' + 
        //             '<textarea class="form-control" id="address" rows="3" name="multiple_addresses[' + (x - 1) + '][address]"></textarea></div>' + 
        //             '<div class="mb-3 col-md-1 form-check pt-5">' + 
        //             '<input class="form-check-input" type="checkbox" value="1" id="is_default" name="multiple_addresses[' + (x - 1) + '][is_default]">' + 
        //             '<label class="form-check-label" for="is_default">Mark as Default</label></div>' + 
        //             '<div class="mb-3 col-md-1 form-check pt-5"><input type="button" class="btn btn-secondary remove_field" value="Remove"></div></div>'
        //             ); // add input boxes.
        //     }
        // });
        
        // $(wrapper).on("click",".remove_field_button", function(e){ //user click on remove text
        //     e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
        // });

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