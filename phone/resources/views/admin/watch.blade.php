@extends('layouts.admin')
@section('header')
    <div class="col-sm-6">
        <h4>Watch</h4>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"></li>
        </ol>
    </div>
@endsection
@section('css')
@endsection

@section('content')
<div id="controller">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" autocomplete="off" placeholder="Search from title" v-model="search">
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" @click="addData">Add New Watch</button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12" v-for="watch in filteredList">
            <div class="info-box" v-on:click="editData(watch)">
                <div class="info-box-content">
                    <span class="info-box-text h4">@{{ watch.type }} (@{{ watch.qty }})</span>
                    <span class="info-box-number">Rp. @{{ numberWithSpaces(watch.price) }} ,- <small></small></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, watch.id)">
                    <div class="modal-header">
                        <h4 class="modal-title">Watch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                            <label>SERIES</label>
                            <input type="number" name="series" class="form-control" placeholder="Enter series" required="" :value="watch.series">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" placeholder="Enter type" required="" :value="watch.type">
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="number" name="year" class="form-control" placeholder="Enter year" required="" :value="watch.year">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <select name="phone_id" class="form-control">
                                <option value="" disabled>-- Select phone --</option>
                                @foreach ($phones as $phone)
                                <option :selected="watch.phone_id == {{ $phone->id }}" value="{{ $phone->id }}">{{ $phone->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tablet</label>
                            <select name="tablet_id" class="form-control">
                                <option value="" disabled>-- Select tablet --</option>
                                @foreach ($tablets as $tablet)
                                <option :selected="watch.tablet_id == {{ $tablet->id }}" value="{{ $tablet->id }}">{{ $tablet->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Laptop</label>
                            <select name="laptop_id" class="form-control">
                                <option value="" disabled>-- Select laptop --</option>
                                @foreach ($laptops as $laptop)
                                <option :selected="watch.laptop_id == {{ $laptop->id }}" value="{{ $laptop->id }}">{{ $laptop->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qty Stock</label>
                            <input type="number" name="qty" class="form-control" placeholder="Enter qty stock" required="" :value="watch.qty">
                        </div>
                        <div class="form-group">
                            <label>Price Transaction</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter price transaction" required="" :value="watch.price">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default bg-danger" data-dismiss="modal" v-if="editStatus" v-on:click="deleteData(watch.id)">Delete</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    var actionUrl = '{{ url('watches') }}';
    var apiUrl = '{{ url('api/watches') }}';
    var app = new Vue({
        el: '#controller',
        data: {
            watches: [],
            search: '',
            watch: {},
            actionUrl,
            apiUrl,
            editStatus: false
        },
        mounted: function() {
            this.get_watches();
        },
        methods: {
            get_watches() {
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(data) {
                        _this.watches = JSON.parse(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addData(){
                this.watch = {};
                this.editStatus = false;
                $('#modal-default').modal();
            },
            editData(watch){
                this.watch = watch;
                this.editStatus = true;
                $('#modal-default').modal();
            },
            deleteData(id){
                this.actionUrl = '{{ url('watches') }}'+'/'+id;
                if (confirm("Are you sure ?")) {
                    axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                        location.reload();
                    });
                }
            },
            numberWithSpaces(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            submitForm(event, id) {
                event.preventDefault();
                const _this = this;
                var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl + '/' + id;
                axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                    $('#modal-default').modal('hide');
                    location.reload();
                });
            }
        },
        computed: {
            filteredList() {
                return this.watches.filter(watch => {
                    return watch.type.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })
</script>
@endsection