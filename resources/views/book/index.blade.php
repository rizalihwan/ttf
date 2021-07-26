@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1>Books Lists</h1>
                    </div>
                    <a href="{{ route('book.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                        Create</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($books as $key)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $key->name }}</td>
                            <td>{{ $key->category->name }}</td>
                            <td>
                                <a href="{{ route('book.edit', $key->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('book.destroy', $key->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hmm Sure?');"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        @empty
                            <td colspan="4" class="text-center text-danger">Book Empty!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
