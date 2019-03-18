@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark text-center text-white">
                            <h5>Create Channel</h5>    
                        </div>    

                        <div class="card-body">

                            @include('admin.includes.errors')

                            <form action="{{ route('channels.update', ['channel' => $channel]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" value="{{ $channel->title }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">Update channel</button>
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>    
            </div> 
       </div>  
    </div> 
@endsection