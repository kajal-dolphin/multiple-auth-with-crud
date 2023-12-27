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
            <form  action="{{ route('user.update')}}" method="post" id="userForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" value="{{$data->id}}" name="id">
                    <div class="mb-3 col-md-6 form-group">
                        <label for="name" class="form-label">Name :- </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$data->name)}}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6 form-group">
                        <label for="email" class="form-label">Email address :- </label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email',$data->email) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 form-group">
                        <label for="photo" class="form-label">Image :- </label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        {{-- <input type="hidden" name="old_img" value={{ $data->image}}> --}}
                        @foreach($data->images as $key => $img)
                            <img src="{{ asset('storage/images/' . $img->user_id . '/' . $img->image)}}" width="100px" class="pt-2 m-2" id="old_img">
                        @endforeach
                        <img src="#" id="preview_img" width="200px" style="display:none;" name="new_img" class="pt-2"/> 
                    </div>
                </div> 
                @if(empty(old('multiple_addresses', [])))
                    @foreach($data->addresses as $key => $address)
                        <div class="row item" id="item_{{ $key + 1 }}">
                            <input type="hidden" name="multiple_addresses[{{$key + 1}}][address_id]" value="{{ $address->id}}" id="hidden_id_{{ $key + 1 }}">
                            <label for="address" class="form-label">Address :- </label>     
                            <div class="mb-3 col-9 form-group">
                                <textarea class="form-control" id="address_{{ $key + 1 }}" name="multiple_addresses[{{$key + 1}}][address]">{{ $address->address }}</textarea>
                            </div>
                            <div class="mb-3 col-1 form-check pt-3">
                                <input class="form-check-input" type="radio" value="{{$key + 1}}" id="is_default_{{ $key + 1 }}" {{ $address->is_default == '1' ? 'checked' : ''}} name="is_default">
                                <label class="form-check-label" for="is_default">
                                    Mark as Default
                                </label>
                            </div>
                            @if($loop->last)
                                <div class="mb-3 col-md-1 pt-3 add_more_btn" id="add_more_btn_{{$key + 1}}">
                                    <input type="button" class="btn btn-secondary add_field_button" id="add_more_{{$key + 1}}" value="Add more"  style="display: block;">
                                </div>
                            @else
                                <div class="mb-3 col-md-1 pt-3 add_more_btn" id="add_more_btn_{{$key + 1}}">
                                    <input type="button" class="btn btn-secondary add_field_button" id="add_more_{{$key + 1}}" value="Add more"  style="display: none;">
                                </div>
                            @endif
                            <div class="mb-3 col-md-1 pt-3 remove_btn" id="remove_btn_{{$key + 1}}">
                                <input type="button" class="btn btn-secondary remove_field_button" value="Remove" id="remove_{{$key + 1}}"  style="display: block;">
                            </div>
                            
                            @if($loop->last)
                                <input type="hidden" value="{{$key}}" id="hidden_id">
                                @php
                                    $rowIndex = $key + 2;
                                @endphp
                            @endif  
                        </div>
                    @endforeach
                @endif
                <div id="add_more_feild">
                    @forelse (old('multiple_addresses', []) as $key => $input)
                        @include('admin.user.clone-column', ['rowIndex' => $key++, 'oldAddress' => $input['address'],
                        'totalItem' => count(old('multiple_addresses', []))])
                    @empty
                        {{-- @include('admin.user.clone-column', ['rowIndex' => $rowIndex]) --}}
                    @endforelse
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a type="buttton" class="btn btn-danger" href="{{ route('admin.dashboard') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function (){
            //for add address dynamically 
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
                                $('#add_more_' + rowIndexValue).css("display", "none");
                                $('#remove_' + rowIndexValue).css("display", "block");
                                $('#remove_' + rowIndex).css("display", "block");
                            }
                            else{
                                console.log("in else part");
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

            //for remove button
            // $(document).on('click','.remove_field_button', function (){
            //     let itemLength = $('.item').length;               
            //     let rowId = $(this).attr('id');
            //     let rowIndexId = rowId.split('_');
            //     if (rowIndexId.length > 0) {
            //         $('#item_' + rowIndexId[1]).remove();
            //     }

            //     $('.item').each(function (index) {
            //         var cloneIndex = index + 1;
            //         $(this).attr('id', 'item_' + cloneIndex);
            //         $(this).find(':input,textarea').each(function (i) {
            //             let inputId = $(this).attr('id').slice(0, -1);
            //             $(this).attr('id', inputId + cloneIndex);
            //             $(this).attr('name', 'multiple_addresses[' + cloneIndex + '][' + inputId + ']');
            //         });
            //     });
            //     var rowIndexNum = rowIndexId[rowIndexId.length-1];
            //     // console.log("RrowIndexNum",rowIndexNum);
            //     // console.log("itemLength",itemLength);
            //     // if(itemLength == rowIndexNum){
            //     //     console.log("here");
            //     //     $('#remove_' + (rowIndexNum-1)).hide();    
            //     //     $('#add_more_' + (rowIndexNum-1)).show();
            //     //     $('#remove_' + (rowIndexNum-1)).show();    
            //     // }
                
            //     console.log("itemLength",itemLength);
            //     let rowValue = parseInt(rowIndexNum) + 1;
            //     console.log("rowValue",rowValue);
            //     if(itemLength == rowValue + 1){
            //         console.log("hello");
            //         $('#add_more_' + (rowIndexNum-1)).show();
            //         $('#remove_' + (rowIndexNum-1)).show();    
            //     }
            //     if(itemLength == 2){
            //         $('#remove_' + (itemLength - 1)).hide();
            //     }
            // });

            //for remove button 
            $(document).on('click','.remove_field_button', function (){
                let itemLength = $('.item').length;               
                let rowId = $(this).attr('id');
                let rowIndexId = rowId.split('_');
                if (rowIndexId.length > 0) {
                    $('#item_' + rowIndexId[1]).remove();
                }

                $('.item').each(function (index) {
                    var cloneIndex = index + 1;
                    $(this).attr('id', 'item_' + cloneIndex);
                    $(this).find(':input,textarea').each(function (i) {
                        let inputId = $(this).attr('id').slice(0, -1);
                        $(this).attr('id', inputId + cloneIndex);
                        $(this).attr('name', 'multiple_addresses[' + cloneIndex + '][' + inputId + ']');
                    });
                });
                console.log("Item length :: ",itemLength);

                var rowIndexNum = rowIndexId[rowIndexId.length-1];
                console.log("rowIndexNum :: ",rowIndexNum);

                if(itemLength == rowIndexNum){
                    console.log("here");
                    $('#add_more_' + (rowIndexNum - 1)).show();
                    $('#remove_' + (rowIndexNum-1)).show();    
                }
                if(itemLength == 2){
                    $('#remove_' + (itemLength - 1)).hide();
                }
            });
            
            //for preview image
            photo.onchange = evt => {
                preview = document.getElementById('preview_img');
                oldImage = document.getElementById('old_img');
                oldImage.style.display = 'none';
                preview.style.display = 'block';
                const [file] = photo.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        });
    </script>
@endsection