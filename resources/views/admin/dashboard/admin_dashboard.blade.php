@extends('admin.layout.app')

<div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">

</div>
<div class="modal fade" id="show-modal" style="display: none;" aria-hidden="true">

</div>

@section('content')
<div class="content-wrapper bg-light text-dark">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        {{-- @if (\Session::has('success'))
        <div class="alert alert-success fade-message">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
        @endif --}}
        {{-- @if (\Session::has('error'))
        <div class="alert alert-danger fade-message">
            <p>{{ \Session::get('danger') }}</p>
        </div><br />
        @endif --}}
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('user.create') }}" class="btn btn-primary"> Add User +</a>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No</th>
                                        <th style="width: 50px">Name</th>
                                        <th style="width: 40px">Email</th>
                                        <th style="width: 20px">Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <input type="hidden" id="delete_record" value="" class="delete_record">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you want to delete this item ??
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary confirmDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () { 
        //for yajra datatable
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive:true,
            ajax: "{{ route('admin.dashboard') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                { data: 'status',name:'status',orderable:false,searchable:false },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "drawCallback": function(settings) {
                let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                    let switchery = new Switchery(html, { size: 'small' });
                });
            }
        });

        //for change status
        $('.data-table').on('change', '.status', function () {
            var status = $(this).prop('checked') ? 1 : 0;
            var user_id = $(this).data('id'); 
            
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/change-status',
                data: {'status': status, 'user_id': user_id},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                }
            });
        });

        //for settimeout for success message
        setTimeout(function() {
            $('.fade-message').slideUp();
        }, 3000);

        //for view record

        $(document).on('click','.viewData', function (){
            let view_id = $(this).attr('data-view-id');
            let url = "{{ route('user.show',':id') }}".replace(':id',view_id);

            $.ajax({
                url : url,
                type : "GET",
                data : {
                    id : view_id
                },
                success : function(res) {
                    if (res && res.success) {
                        $('#show-modal').html(null);
                        $('#show-modal').html(res.html);
                        $('#show-modal').modal('show');
                    } else {
                        console.log('error', res.message);
                    }
                },
                error: function (res) {
                    console.log('error', res.message);
                },
            });
        });


        //for edit record
        // $(document).on('click','.editData',function (e){
        //     e.preventDefault();
        //     var edit_id = $(this).attr('data-edit-id');
        //     var url = "{{ route('user.edit',':id')}}".replace(':id',edit_id);

        //     $.ajax({
        //         url : url,
        //         type: "GET",
        //         data : {
        //             id: edit_id
        //         },
        //         success: function (res) {
        //             if (res && res.success) {
        //                 $('#edit-modal').html(null);
        //                 $('#edit-modal').html(res.html);
        //                 $('#edit-modal').modal('show');
        //             } else {
        //                 console.log('error', res.message);
        //             }
        //         },
        //         error: function (res) {
        //             console.log('error', res.message);
        //         },
        //     });
        // });

        //for open delete pop up
        $(document).on('click', '.deleteData', function(e) {
            let delete_id = $(this).attr("data-delete-id");
            $('.delete_record').val(delete_id);
            $('#deleteModal').modal('show');
        });

        //for delete record
        $(document).on('click','.confirmDelete', function(e){
            let delete_id = $('.delete_record').val();
            let url = "{{ route('user.delete', '') }}/" + delete_id;
            $.ajax({
                url : url,
                type : "GET",
                data : {
                    id : delete_id
                },
                success : function (){
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                }
            })
        });
    });
</script>
@endsection