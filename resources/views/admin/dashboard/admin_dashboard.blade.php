@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper bg-light text-dark">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="background-color: aliceblue; color:black;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>User List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('user.create') }}" class="btn btn-secondary"> Add User +</a>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content" style="background-color: aliceblue">
        <div class="container-fluid" style="background-color: aliceblue; color:black;">
            <div class="row" style="background-color: aliceblue; color:black;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: aliceblue; color:black;">
                            <h3 class="card-title">User List</h3>
                        </div>
                    <div class="card-body" style="background-color: aliceblue; color:black;">
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
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () { 
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
    });
</script>
@endsection