@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="/users/{{ $user['id'] }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title">Update User</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $user['name'] }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user['email'] }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" name="roles[]" multiple>
                                <option value="0">Select Roles</option>
                                @php $roleIds = $user['roles']->pluck('id')->toArray(); @endphp
                                @forelse ($roles as $role)
                                    @if(in_array($role['id'], $roleIds))
                                        <option value="{{$role['id']}}" selected>{{$role['name']}}</option>
                                    @else
                                        <option value="{{$role['id']}}">{{$role['name']}}</option>
                                    @endif
                                @empty
                                    <option value="0">No Roles Found..!</option>
                                @endforelse
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a type="button" href="/users" class="btn btn-danger">Back</a>
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
