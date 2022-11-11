@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">

        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/permissions">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Permission</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a type="button" href="/roles" class="btn btn-danger">Cancel</a>
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
