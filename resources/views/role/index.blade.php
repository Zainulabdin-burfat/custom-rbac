@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Role</b></h2>
                        </div>
                        <div class="col-sm-6">

                            {{-- @role('admin') --}}
                            @can('create', 'role')
                                <a href="roles/create" class="btn btn-success">
                                    <i class="material-icons">&#xE147;</i> <span>Add New Role</span>
                                </a>

                            @endcan
                            {{-- @endrole --}}
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Assign Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($roles as $key => $role)
                            <tr>
                                <td> {{ $key + 1 ?? null }} </td>
                                <td> {{ $role['name'] ?? null }} </td>
                                <td> {{ $role['slug'] ?? null }} </td>
                                <td>
                                    @forelse ($role->permissions as $permission)
                                        <li style="list-style: none"> {{ $permission->name }}</li>
                                    @empty
                                        -
                                    @endforelse
                                </td>

                                <td class="d-flex">
                                    <a href="roles/{{ $role['id'] }}" class="show">
                                        <i class="material-icons" data-toggle="tooltip" title="show">&#xe8f4;</i></a>

                                    {{-- @can('list-users') --}}
                                        <a href="roles/{{ $role['id'] }}/edit" class="edit">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    {{-- @endcan --}}

                                        <form action="/roles/{{ $role['id'] }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="material-icons">&#xE872;</i>
                                            </button>
                                        </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Record Found..!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <div class="clearfix">

                    {{-- {{ $roles->links() }} --}}

                    {{-- <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>

        <div id="deleteEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
