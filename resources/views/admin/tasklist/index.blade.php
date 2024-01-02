@extends('admin.layout.app')

<div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">

</div>
<div class="modal fade" id="show-modal" style="display: none;" aria-hidden="true">
    
</div>

@section('content')
<div class="content-wrapper bg-light text-dark">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid pt-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('tasklist.create') }}" class="btn btn-primary"> Add Task + </a>
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
                            <div class="d-flex bd-highlight">
                                <div class="p-2 flex-grow-1 bd-highlight">
                                    <h3>Task List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 20px" class="no">No</th>
                                        <th style="width: 50px" class="subject">Subject</th>
                                        <th style="width: 40px" class="description">Description</th>
                                        <th style="width: 20px" class="start_date">Start Date</th>
                                        <th style="width: 20px" class="end_date">End Date</th>
                                        <th style="width: 40px" class="status">Status</th>
                                        <th style="width: 40px" class="priority">Priority</th>
                                        <th style="width: 40px" class="is_active">Is_Active</th>
                                        <th width="100px" class="action">Action</th>
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
            // "searching": false, 
            "bPaginate": false,
            ajax: {
                url: "{{ route('tasklist.index') }}",
                data: function (d) {
                    d.status = $('#status').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'subject', name: 'subject'},
                {data: 'description', name: 'description'},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},
                {data: 'status', name: 'status'},
                {data: 'priority', name: 'priority'},
                {data: 'is_active',name:'is_active',orderable:false,searchable:false },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function () {
                var newDiv = $("<div>");
                newDiv.addClass("datatable_custom_class row");
                $(".dataTables_wrapper .row:first > div:first-child").addClass("col-lg-6 col-xl-6 col-xxl-6");
                $(".dataTables_wrapper .row:first > div:eq(1)").addClass("col-lg-6 col-xl-6 col-xxl-6");
                $(".dataTables_wrapper .row:first > div:first-child").append(newDiv);
                $(".dataTables_wrapper .row:first > div:eq(1) .dataTables_filter").addClass("row");
                $(".dataTables_wrapper .row:first > div:eq(1) .dataTables_filter").find( "label").addClass("serachInput");
                
                var addDiv = '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 pt-2" id="divContainer"></div>';

                $('.dataTables_wrapper .row:first > div:eq(1) .dataTables_filter').append(addDiv);
                $('.dataTables_wrapper .row:first > div:eq(1) .dataTables_filter .serachInput').appendTo('#divContainer');
                
                var statusDropdown = 
                    '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">' +
                        '<div class="d-flex flex-row bd-highlight">' + 
                            '<div class="p-2 bd-highlight">' +
                                '<p class="pt-1"> Status </p>' +
                            '</div>' +
                            '<div class="p-2 bd-highlight">' +
                                '<select id="status" class="form-control">' +
                                    '<option value="">- Select Status -</option>' +
                                    '<option value="new">New</option>' +
                                    '<option value="incomplete">Incomplete</option>' +
                                    '<option value="complete">Complete</option>' +
                                '</select>' + 
                            '</div>' +
                        '</div>'                       
                    '</div>'
                $('.datatable_custom_class').append(statusDropdown);

                var priorityDropdown = 
                    '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">' +
                        '<div class="d-flex flex-row bd-highlight">' + 
                            '<div class="p-2 bd-highlight">' +
                                '<p class="pt-1"> Priority </p>' +
                            '</div>' +
                            '<div class="p-2 bd-highlight">' +
                                '<select id="priority" class="form-control">' +
                                    '<option value="">- Select Priority -</option>' +
                                    '<option value="high">High</option>' +
                                    '<option value="meduim">Meduim</option>' +
                                    '<option value="low">Low</option>' +
                                '</select>' +
                            '</div>' +
                        '</div>'                       
                    '</div>'
                $('.datatable_custom_class').append(priorityDropdown);

                var endDatePicker = 
                    '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">' +
                        '<div class="d-flex flex-row bd-highlight">' + 
                            '<div class="p-2 bd-highlight">' +
                                '<p class="pt-1"> End Date </p>' +
                            '</div>' +
                            '<div class="p-2 bd-highlight">' +
                                '<input type="date" class="form-control" id="end_date" name="end_date">' +
                            '</div>' +
                        '</div>'                       
                    '</div>'
                $('.dataTables_filter').prepend(endDatePicker);

                var startDatePicker = 
                    '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">' +
                        '<div class="d-flex flex-row bd-highlight">' + 
                            '<div class="p-2 bd-highlight">' +
                                '<p class="pt-1"> Start Date </p>' +
                            '</div>' +
                            '<div class="p-2 bd-highlight">' +
                                '<input type="date" class="form-control" id="start_date" name="start_date">' +
                            '</div>' +
                        '</div>'                       
                    '</div>'
                $('.datatable_custom_class').append(startDatePicker);
            },
            "drawCallback": function(settings) {
                let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                    let switchery = new Switchery(html, { size: 'small' });
                });
            },

            // createdRow: function ( row ) {
            //     $('td', row).eq(0).addClass('no');
            //     $('td', row).eq(1).addClass('subject');
            //     $('td', row).eq(2).addClass('description');
            //     $('td', row).eq(3).addClass('start_date');
            //     $('td', row).eq(4).addClass('end_date');
            //     $('td', row).eq(5).addClass('status');
            //     $('td', row).eq(6).addClass('priority');
            //     $('td', row).eq(7).addClass('is_active');
            // },
        });

        $('#status').change(function(){
            console.log("here");
            table.draw();
        });

        //for view record
        $(document).on('click','.viewData', function (){
            let view_id = $(this).attr('data-view-id');
            let url = "{{ route('taskList.show',':id') }}".replace(':id',view_id);

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

         //for open delete pop up
         $(document).on('click', '.deleteData', function(e) {
            let delete_id = $(this).attr("data-delete-id");
            $('.delete_record').val(delete_id);
            $('#deleteModal').modal('show');
        });

        //for delete record
        $(document).on('click','.confirmDelete', function(e){
            let delete_id = $('.delete_record').val();
            let url = "{{ route('tasklist.delete', '') }}/" + delete_id;
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

        //for change status
        $('.data-table').on('change', '.is_active', function () {
            var is_active = $(this).prop('checked') ? 1 : 0;
            var user_id = $(this).data('id'); 
            
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/change-task-status',
                data: {'is_active': is_active, 'user_id': user_id},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    table.ajax.reload();
                }
            });
        });
    });
</script>
@endsection