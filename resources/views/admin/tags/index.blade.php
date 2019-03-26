@extends('layouts.app')

@section('content')
        <div class="card text-white bg-dark">
            <div class="card-header text-center color-yellow">
                Tags List
            </div>

            <div class="card-body">
                <table class="table table-bordered table-dark">
                    <thead>
                        <th>Tag Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @if($tags->count() > 0)
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <a href="{{ route('tags.edit', ['tag' => $tag])}}" class="btn btn-info btn-sm text-white"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else 
                            <tr>
                                <th colspan="5" class="text-center">No tags to show</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                
                        {{ $tags->links() }}
        
            </div>
        </div>
@endsection