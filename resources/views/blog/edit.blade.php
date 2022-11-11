@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="/posts/{{ $post['id'] }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title">Update Blog</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $post['title'] }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea required name="description" rows="5" class="form-control">{{$post['description']}}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a type="button" href="/posts" class="btn btn-danger">Back</a>
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
