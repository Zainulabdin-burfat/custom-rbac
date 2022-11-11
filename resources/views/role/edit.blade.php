@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="/roles/{{ $role['id'] }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title">Update Role</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $role['name'] }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" value="{{ $role['slug'] }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" name="permissions[]" multiple>
                                <option value="0">Select Permissions</option>

                                @php $permissionIds = $role['permissions']->pluck('id')->toArray(); @endphp

                                @forelse ($permissions as $permission)
                                    @if(in_array($permission['id'], $permissionIds))
                                        <option value="{{$permission['id']}}" selected>{{$permission['name']}}</option>
                                    @else
                                        <option value="{{$permission['id']}}">{{$permission['name']}}</option>
                                    @endif
                                @empty
                                    <option value="0">No Permissions Found..!</option>
                                @endforelse
                            </select>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <a type="button" href="/roles" class="btn btn-danger">Back</a>
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
