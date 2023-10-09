<?php $currentPage = 'travel-package';?>
@extends('layouts.admin')

@section('content')
<!-- Content Row -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm"  data-toggle="modal" data-target="#addModal">
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
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <!-- Modal Add -->
                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Add Travel Package</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('travel-package.store') }}" method="post">
                                                    @method('POST')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label for="title">Title</label>
                                                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}" required>
                                                        </div>
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label for="location">Location</label>
                                                            <input type="text" class="form-control" name="location" placeholder="Location" value="{{ old('location') }}" required>
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <label for="about">About</label>
                                                            <textarea name="about" rows="4" class="d-block w-100 form-control">{{ old('about') }}</textarea>
                                                        </div>
                                                        <div class="col-12 col-md-4 form-group">
                                                            <label for="featured_event">Featured Event</label>
                                                            <input type="text" class="form-control" name="featured_event" placeholder="Featured Event" value="{{ old('featured_event') }}">
                                                        </div>
                                                        <div class="col-12 col-md-4 form-group">
                                                            <label for="language">Language</label>
                                                            <input type="text" class="form-control" name="language" placeholder="Language" value="{{ old('language') }}">
                                                        </div>
                                                        <div class="col-12 col-md-4 form-group">
                                                            <label for="foods">Foods</label>
                                                            <input type="text" class="form-control" name="foods" placeholder="Foods" value="{{ old('foods') }}">
                                                        </div>
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label for="departure_date">Departure Date</label>
                                                            <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" value="{{ old('departure_date') }}">
                                                        </div>
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label for="duration">Duration</label>
                                                            <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ old('duration') }}">
                                                        </div>
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label for="type">Type</label>
                                                            <input type="text" class="form-control" name="type" placeholder="Type" value="{{ old('type') }}">
                                                        </div>
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label for="price">Price</label>
                                                            <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        Add Package
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit -->
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
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $item->title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="location">Location</label>
                                                        <input type="text" class="form-control" name="location" placeholder="Location" value="{{ $item->location }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="about">About</label>
                                                        <textarea name="about" rows="10" class="d-block w-100 form-control">{{ $item->about }}</textarea>
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="featured_event">Featured Event</label>
                                                        <input type="text" class="form-control" name="featured_event" placeholder="Featured Event" value="{{ $item->featured_event }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="language">Language</label>
                                                        <input type="text" class="form-control" name="language" placeholder="Language" value="{{ $item->language }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="foods">Foods</label>
                                                        <input type="text" class="form-control" name="foods" placeholder="Foods" value="{{ $item->foods }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="departure_date">Departure Date</label>
                                                        <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" value="{{ $item->departure_date }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="duration">Duration</label>
                                                        <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ $item->duration }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="type">Type</label>
                                                        <input type="text" class="form-control" name="type" placeholder="Type" value="{{ $item->type }}">
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="price">Price</label>
                                                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $item->price }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        Ubah
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('travel-package.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $item['id'] }}">Delete Item</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    Are you sure you want to delete this package?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                    <!-- Cureent Page : {{ $items->currentPage() }} <br/>
                    Jumlah Data : {{ $items->total() }} <br/>
                    Data Per Halaman : {{ $items->perPage() }} <br/> -->
            </div>
        </div>
    </div>

</div>

@endsection