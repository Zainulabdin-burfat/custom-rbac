@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="/permissions/{{ $permission['id'] }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title">Update Permission</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $permission['name'] }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" value="{{ $permission['slug'] }}" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a type="button" href="/permissions" class="btn btn-danger">Back</a>
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
