@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1>Categories Lists</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($categories as $key)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $key->name }}</td>
                            <td>
                                <form action="{{ route('category.destroy', $key->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hmm Sure?');"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        @empty
                            <td colspan="3" class="text-center text-danger">Category Empty!</td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>
    </div>
@endsection
