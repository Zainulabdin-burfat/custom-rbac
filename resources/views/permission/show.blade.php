@extends('layouts.app')

@section('content')
    <div class="card" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <form>
                    <fieldset disabled>
                        <div class="modal-header">
                            <h4 class="modal-title">Show Permission</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{ $permission['name'] }}" class="form-control">
                            </div>
                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        <a type="button" href="/permissions" class="btn btn-danger">Back</a>
                        <a type="button" href="/permissions/{{ $permission['id'] }}/edit" class="btn btn-success">Edit</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
