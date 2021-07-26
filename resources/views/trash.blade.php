@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <form action="{{ route('log.destroy.all') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-arrow-trash"></i>
                                DELETE ALL</button>
                        </form>
                        <a href="{{ route('log.restore.all') }}" class="btn btn-info">Restore ALL</a>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Subject</th>
                        <th>URL</th>
                        <th>Method</th>
                        <th>Ip</th>
                        <th width="300px">User Agent</th>
                        <th>User Id</th>
                        <th>Action</th>
                    </tr>
                    @if ($logs->count())
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->subject . ' - ' . $log->created_at->format('d F, Y') . ' - ' . \Str::upper($log->created_at->format('H:i:s')) }}
                                </td>
                                <td class="text-success">{{ $log->url }}</td>
                                <td><label class="label label-info">{{ $log->method }}</label></td>
                                <td class="text-warning">{{ $log->ip }}</td>
                                <td class="text-danger">{{ $log->agent }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>
                                    <form action="{{ route('log.destroy.permanent', $log->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hmm Sure?');"><i
                                                class="fa fa-trash mr-1"></i> Hapus Permanen</button>
                                    </form>
                                    <a href="{{ route('log.restore', $log->id) }}" class="btn btn-info">Restore</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
