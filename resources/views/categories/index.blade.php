@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Category
                </button>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Keywords</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->keywords }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{route('categories.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Delete this data permanently?')">
                                    @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('categories.update', $item->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>   
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $item->slug }}" required>   
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="keywords">Keywords</label>
                                                    <input type="text" name="keywords" class="form-control" id="keywords" value="{{ $item->keywords }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_desc">Meta Description</label>
                                                    <input type="text" name="meta_desc" class="form-control" id="meta_desc" value="{{ $item->meta_desc }}" required>   
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>   
                        </div>
                        <div class="form-group mb-2">
                            <label for="keywords">Keywords</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" required>   
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Meta Description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc" required>   
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
@endsection