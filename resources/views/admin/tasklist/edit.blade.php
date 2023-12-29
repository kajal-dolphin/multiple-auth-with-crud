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
        <form action="{{ route('tasklist.update')}}" method="post" id="taskListForm">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-12 form-group">
                    <input type="hidden" value="{{$taskList->id}}" name="id">
                    <label for="name" class="form-label">Task Subject :- </label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{old('subject',$taskList->subject)}}">
                    @error('subject')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-12 form-group">
                    <label for="description" class="form-label">Description :- </label>
                    <textarea name="description" id="description" class="description form-control">{{ old('description',$taskList->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6 form-group">
                    <label for="start_date" class="form-label"> Start Date :- </label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date',date('Y-m-d', strtotime($taskList->start_date)))}}" min="<?= date('Y-m-d'); ?>">
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 form-group">
                    <label for="end_date" class="form-label"> End Date :- </label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date',date('Y-m-d', strtotime($taskList->end_date)))}}" min="<?= date('Y-m-d'); ?>">
                    @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6 form-group">
                    <label for="status" class="form-label"> Status :- </label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="new" {{ !empty($taskList->status) && $taskList->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="incomplete" {{ !empty($taskList->status) && $taskList->status == 'incomplete' ? 'selected' : '' }}>Incomplete</option>
                        <option value="complete" {{ !empty($taskList->status) && $taskList->status == 'complete' ? 'selected' : '' }}>Complete</option>
                    </select>
                </div>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3 col-md-6 form-group">
                    <label for="priority" class="form-label"> Priority :- </label>
                    <select class="form-select" aria-label="Default select example" name="priority">
                        <option value="high" {{ !empty($taskList->priority) && $taskList->priority == 'high' ? 'selected' : '' }}>High</option>
                        <option value="meduim" {{ !empty($taskList->priority) && $taskList->priority == 'meduim' ? 'selected' : '' }}>Meduim</option>
                        <option value="low" {{ !empty($taskList->priority) && $taskList->priority == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>
                @error('priority')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-success">Submit</button>
                <a type="buttton" class="btn btn-danger" href="{{ route('tasklist.index') }}">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        $('#taskListForm').validate({
            rules : {
                subject : {
                    required : true,
                    maxlength : 255,
                },
                description : {
                    required : true,
                },
                start_date : {
                    required : true,
                },
                end_date : {
                    required : true,
                },
                status : {
                    required : true,
                },
                priority : {
                    required : true,
                },
            },
            messages : {
                subject : {
                    required : "Subject is required !!",
                    maxlength : "Subject is not more than 255 character !!",
                },
                description : {
                    required : "Description is required !!",
                },
                start_date : {
                    required : "Start Date is required !!",
                },
                end_date : {
                    required : "End Date is required !!",
                },
                status : {
                    required : "Status is required !!",
                },
                priority : {
                    required : "Priority is required !!",
                },
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
    });
</script>
@endsection