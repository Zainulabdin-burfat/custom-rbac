@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form>
                    <fieldset disabled>
                        <div class="modal-header">
                            <h4 class="modal-title">Show Role</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{ $role['name'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" value="{{ $role['slug'] }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Permissions</label>
                                @forelse ($role->permissions as $permission)
                                    <li style="list-style: none"> {{ $permission->name }}</li>
                                @empty
                                    -
                                @endforelse
                            </div>

                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        <a type="button" href="/roles" class="btn btn-danger">Back</a>
                        <a type="button" href="/roles/{{ $role['id'] }}/edit" class="btn btn-success">Edit</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
