<?php $currentPage = 'travel-package';?>
@extends('layouts.admin.admin')

@section('content')
<!-- Content Row -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket Travel
        </a>
    </div>

    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Departure Date</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->departure_date }}</td>
                            <td>{{ $item->duration }}</td>
                            <td>
                                <!-- <a href="{{ route('travel-package.edit', $item->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a> -->
                                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Travel Package</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('travel-package.update', $item->id) }}" method="post">
                                                    <div class="form-group">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="editTitle">Title</label>
                                                                <input type="text" class="form-control" id="editTitle" value="{{ $item->title }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editDuration">Duration</label>
                                                                <input type="text" class="form-control" id="editDuration" value="{{ $item->duration }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editPrice">Price</label>
                                                                <input type="text" class="form-control" id="editPrice" value="{{ $item->price }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal -->
                                <form action="#" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="7" class="text-center">
                                Data Kosong
                            </td>
                        @endforelse
                    </tbody>
                </table>
                {{ $items->links() }}
                <br/>
                    Cureent Page : {{ $items->currentPage() }} <br/>
                    Jumlah Data : {{ $items->total() }} <br/>
                    Data Per Halaman : {{ $items->perPage() }} <br/>
            </div>
        </div>
    </div>

</div>

@endsection