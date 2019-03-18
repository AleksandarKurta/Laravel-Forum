@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            Channels List
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
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
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection