<?php $currentPage = 'test-crud';?>
@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <h1>Item List</h1>

        <!-- Tampilkan pesan kesalahan jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tampilkan daftar item -->
        <ul class="list-group">
            @forelse($items as $item)
                <li class="list-group-item">
                    {{ $item['name'] }} - {{ $item['description'] }}
                    <div class="float-right">
                        <!-- Tombol Edit (buka modal) -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $item['id'] }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus (buka modal) -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $item['id'] }}">
                            Delete
                        </button>
                    </div>
                </li>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item['id'] }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="updateItemForm" action="{{ route('items.update', $item['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item['id'] }}">Edit Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="editName{{ $item['id'] }}">Name</label>
                                        <input type="text" class="form-control" id="editName{{ $item['id'] }}" name="name" value="{{ $item['name'] }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editDescription{{ $item['id'] }}">Description</label>
                                        <textarea class="form-control" id="editDescription{{ $item['id'] }}" name="description" required>{{ $item['description'] }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item['id'] }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('items.destroy', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item['id'] }}">Delete Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <li class="list-group-item">Data Kosong</li>
            @endforelse
        </ul>

        <!-- Formulir Tambah Item -->
        <div class="mt-4">

            <h2>Add New Item</h2>

            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Add Item</button>
            </form>
        </div>
    </div>

<script>
$('#updateItemForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var url = $(this).attr('action');
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function (response) {
            // Di sini Anda dapat memperbarui tampilan tanpa me-refresh halaman.
            alert(response.message); // Tampilkan pesan sukses atau lakukan apa yang Anda butuhkan.
        }
    });
});
</script>
@endsection