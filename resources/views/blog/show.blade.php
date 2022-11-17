@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form>
                    <fieldset disabled>
                        <div class="modal-header">
                            <h4 class="modal-title">Show Blog</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" value="{{ $post['title'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ $post['description'] }}</textarea>
                            </div>
                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        @can('post.index')
                            <a type="button" href="/posts" class="btn btn-danger">Back</a>
                        @endcan
                        @can('post.edit')
                            <a type="button" href="/posts/{{ $post['id'] }}/edit" class="btn btn-success">Edit</a>
                        @endcan
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
