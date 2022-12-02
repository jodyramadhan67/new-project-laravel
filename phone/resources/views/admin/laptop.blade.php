@extends('layouts.admin')
@section('header', 'Laptop')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> 
@endsection

@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" @click="addData()" data-target="#modal-default" data-toggle="modal" class="btn btn-sm btn-primary pull-right">Add New Laptop</a>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px">No.</th>
                                    <th class="text-center">Brand</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Imei</th>
                                    <th class="text-center">Spec</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <form method="post" :action="actionUrl" autocomplete="off"  @submit="submitForm($event, data.id)">
                    <div class="modal-header">

                        <h4 class="modal-title">Laptop</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                                <label>Brand</label>
                                <input type="text" name="brand" class="form-control" require="" :value="data.brand">
                        </div>
                        <div class="form-group">
                                <label>Type</label>
                                <input type="text" name="type" class="form-control" require="" :value="data.type">
                        </div>
                        <div class="form-group">
                                <label>Imei</label>
                                <input type="text" name="imei" class="form-control" require="" :value="data.imei">
                        </div>
                        <div class="form-group">
                                <label>Spec</label>
                                <input type="text" name="spec" class="form-control" require="" :value="data.spec">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.card -->
@endsection
    
@section('js')
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript">
    var actionUrl = '{{ url('laptops') }}';
    var apiUrl = '{{ url('api/laptops') }}';

    var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: false},
        {data: 'brand', class: 'text-center', orderable: false},
        {data: 'type', class: 'text-center', orderable: true},
        {data: 'imei', class: 'text-center', orderable: true},
        {data: 'spec', class: 'text-center', orderable: true},
        {render: function (index, row, data,meta) {
          return `
              <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">
                Edit
              </a>
              <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
              Delete
              </a>`;
        }, orderable: false, width: '200px', class: 'text-center'},
    ];
</script>
<script src="{{ asset('js/data.js') }}"></script>

<!-- CSS Scoped -->
<style>
        .row {
            margin: 0 auto;
        }
        td a.btn {
            margin: 5px;
        }
</style>
<!-- <script type="text/javascript"> -->
     <!-- $(function () {
        $("#datatable").DataTable();
    }); -->
<!-- </script>
<script type="text/javascript"> -->
        <!-- var controller = new Vue({
            el:'#controller',
            data: {
                data : {},
                actionUrl : '{{ url('laptops') }}',
                editStatus : false -->
            <!-- },
            mounted: function() {

            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('laptops') }}';
                    this.editStatus = false;
                    $('#modal-default').modal()
                }, -->
                <!-- editData(data) {
                    this.data = data;
                    this.actionUrl = '{{ url('laptops') }}'+'/'+data.id;
                    this.editStatus = true;
                    $('#modal-default').modal()
                },
                deleteData(id) {
                    this.actionUrl = '{{ url('laptops') }}'+'/'+id;
                    if(confirm("Are You Sure?")) {
                        axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                            location.reload();
                        });
                    }
                }
            }
        });
</script> -->

<!-- CSS Scoped -->
<!-- <style>
        .row {
            margin: 0 auto;
        }
        td a.btn {
            margin: 5px;
        }
    </style> -->
@endsection