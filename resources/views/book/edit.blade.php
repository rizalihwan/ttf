@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="my-3">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('book.update', $book->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="{{ route('book.index') }}" class="btn btn-danger">BACK</a>
                            </div>
                            <div>
                                <h5>Update Book</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err . '!' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" name="name" id="name" value="{{ $book->name ?? old('name') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="category">Category*</label>
                                        <select name="category_id" id="category" class="form-control custom-select">
                                            @foreach ($categories as $id => $key)
                                                <option value="{{ $key }}" @if ($book->category_id == $key) selected @endif>{{ $id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @foreach ($book->bookdetails as $detail)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="field_wrapper">
                                            <div class="form-group">
                                                <label for="description">Description*</label>
                                                <textarea name="description[]" value="{{ $detail->description }}"
                                                    id="description" class="form-control"
                                                    rows="3">{{ $detail->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-12">
                                <div class="mx-2 my-1">
                                    <a class="btn btn-success" href="javascript:void(0);" style="width: 100%"
                                        id="add_button" title="Add other image"><i class="fa fa-plus"></i> Tambahkan
                                        deskripsi lainnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            let maxField = 10;
                            let addButton = $('#add_button');
                            let wrapper = $('.field_wrapper');
                            let fieldHTML = '<div class="form-group add"><div class="row">';
                            fieldHTML = fieldHTML +
                                '<div class="form-group"><label for="description">Description*</label><textarea name="description[]" id="description" class="form-control" rows="3"></textarea></div>';
                            fieldHTML = fieldHTML +
                                '<div class="col-md-2"><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="fa fa-trash"></i></a></div>';
                            fieldHTML = fieldHTML + '</div></div>';
                            let x = 1;
                            $(addButton).click(function() {
                                if (x < maxField) {
                                    x++;
                                    $(wrapper).append(fieldHTML);
                                }
                            });
                            $(wrapper).on('click', '.remove_button', function(e) {
                                if (confirm('Yakin?')) {
                                    e.preventDefault();
                                    $(this).parent('').parent('').remove();
                                    x--;
                                } else {
                                    return false;
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
