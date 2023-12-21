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
                    {{-- <div class="mb-3 col-md-6 form-group">
                        <label for="exampleInputPassword1" class="form-label">Password :- </label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="mb-3 col-md-6 form-group">
                        <label for="photo" class="form-label">Image :- </label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        <input type="hidden" name="old_img" value={{ $data->image}}>
                        <img src="{{ asset('images/' . $data->id . '/' . $data->image)}}" width="200px" class="pt-2" id="old_img">
                        <img src="#" id="preview_img" width="200px" style="display:none;" name="new_img" class="pt-2"/> 
                    </div>
                </div> 
                @foreach($data->address as $key => $address)
                <div class="row item" id="item_{{ $key + 1 }}">
                    <label for="address" class="form-label">Address :- </label>     
                    <div class="mb-3 col-9 form-group">
                        <textarea class="form-control" id="address" name="multiple_addresses[{{$key + 1}}][address]">{{ $address->address }}</textarea>
                    </div>
                    <div class="mb-3 col-1 form-check pt-3">
                        <input class="form-check-input" type="checkbox" value="1" id="is_default" {{ $address->is_default == '1' ? 'checked' : ''}} name="multiple_addresses[{{$key + 1}}][is_default]">
                        <label class="form-check-label" for="is_default">
                            Mark as Default
                        </label>
                    </div>
                    <div class="mb-3 col-md-1 pt-3 add_more_{{$key + 1}}" style="display: none;">
                        <input type="button" class="btn btn-secondary add_field_button" id="add_more_{{$key + 1}}" value="Add more">
                    </div>
                    <div class="mb-3 col-md-1 pt-3 remove_{{$key + 1}}" style="display: block;">
                        <input type="button" class="btn btn-secondary remove_field_button" value="Remove" id="remove_{{$key + 1}}">
                    </div>
                    @if($loop->last)
                        <input type="hidden" value="{{$key}}" id="hidden_id">
                        @php
                            $rowIndex = $key + 2;
                        @endphp
                    @endif  
                </div>
                @endforeach
                <div id="add_more_feild">
                    @php($i = 1)
                    @forelse (old('multiple_addresses', []) as $input)
                        @include('admin.user.clone-column', ['rowIndex' => $i, 'oldAddress' => $input['address']])
                        @php($i++)
                    @empty
                        @include('admin.user.clone-column', ['rowIndex' => $rowIndex])
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
                                $('.add_more_' + rowIndexValue).css("display", "none");
                                $('.remove_' + rowIndexValue).css("display", "block");
                                $('.remove_' + rowIndex).css("display", "block");
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
            $(document).on('click','.remove_field_button', function (){
                let itemLength = $('.item').length;
                let rowId = $(this).attr('id');
                let rowIndexId = rowId.split('_');
                if (rowIndexId.length > 0) {
                    $('#item_' + rowIndexId[1]).remove();
                }

                $('.item').each(function(index) {
                    var cloneIndex = index + 1;
                    $(this).attr('id', 'item_' + cloneIndex);
                    $(this).find(':input,textarea').each(function(i) {
                        let inputId = $(this).attr('id').slice(0, -1);
                        $(this).attr('id', inputId + cloneIndex);
                        $(this).attr('name', 'multiple_addresses[' + cloneIndex + '][' + inputId
                            .slice(0, -1) + ']');
                    });
                    if (itemLength == 2) {
                        $('.add_more_' + cloneIndex).show();
                        $('.remove_' + cloneIndex).hide();
                    } else if (cloneIndex + 1 == itemLength) {
                        // $('.add_more_' + cloneIndex).show();
                        $('.remove_' + cloneIndex).show();
                    }
                });
            });
        });
    </script>
@endsection