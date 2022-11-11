@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">

        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/posts">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea readonly name="description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a type="button" href="/posts" class="btn btn-danger">Cancel</a>
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
