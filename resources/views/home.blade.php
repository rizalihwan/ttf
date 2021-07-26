@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1>Log Activity Lists</h1>
                    </div>
                    <a href="{{ route('trash') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                        Sampah</a>
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
                                    <form action="{{ route('log.destroy', $log->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hmm Sure?');"><i
                                                class="fa fa-arrow-right mr-1"></i> Pindahkan ke Sampah</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
