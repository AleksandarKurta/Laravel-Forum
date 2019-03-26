@extends('layouts.app')

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header text-center color-yellow">
            <h5>Channels List</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-dark">
                <thead>
                    <th>Channel Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @if($channels->count() > 0)
                        @foreach($channels as $channel)
                        <tr>
                            <td>{{ $channel->title }}</td>
                            <td>
                                <a href="{{ route('channels.edit', ['channel' => $channel])}}" class="btn btn-info btn-sm text-white"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('channels.destroy', ['channel' => $channel]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else 
                        <tr>
                            <th colspan="5" class="text-center">No channels to show</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $channels->links() }}
        </div>
    </div>
@endsection