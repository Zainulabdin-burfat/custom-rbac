@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form>
                    <fieldset disabled>
                        <div class="modal-header">
                            <h4 class="modal-title">Show User</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{ $user['name'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{ $user['email'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Roles</label>
                                <ul class="">
                                    @forelse ($user['roles'] as $role)
                                        <li style="list-style: none;">{{ $role }}</li>
                                    @empty
                                        <li>-</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        <a type="button" href="/users" class="btn btn-danger">Back</a>
                        <a type="button" href="/users/{{ $user['id'] }}/edit" class="btn btn-success">Edit</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
