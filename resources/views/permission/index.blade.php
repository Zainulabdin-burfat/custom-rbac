@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Permission</b></h2>
                        </div>
                        <div class="col-sm-6">

                            {{-- @role('admin') --}}
                                <a href="permissions/create" class="btn btn-success">
                                    <i class="material-icons">&#xE147;</i> <span>Add New Permission</span>
                                </a>

                                <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                        class="material-icons">&#xE15C;</i> <span>Delete</span></a>
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
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($permissions as $key => $permission)
                            <tr>
                                <td> {{ $key + 1 ?? null }} </td>
                                <td> {{ $permission['name'] ?? null }} </td>
                                <td> {{ $permission['slug'] ?? null }} </td>
                                {{-- <td>
                                    <ul class="list-group">
                                        @forelse (json_decode($permission['slug'], true) as $item)
                                            <li class="list-group-item">{{ $item }}</li>
                                        @empty
                                            <li class="list-group-item">No Data Found..!</li>
                                        @endforelse
                                    </ul>
                                </td> --}}

                                <td class="d-flex">
                                    <a href="permissions/{{ $permission['id'] }}" class="show">
                                        <i class="material-icons" data-toggle="tooltip" title="show">&#xe8f4;</i></a>

                                    {{-- @role('admin') --}}
                                        <a href="permissions/{{ $permission['id'] }}/edit" class="edit">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>

                                        <form action="/permissions/{{ $permission['id'] }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="material-icons">&#xE872;</i>
                                            </button>
                                        </form>
                                    {{-- @endrole --}}
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

                    {{-- {{ $permissions->links() }} --}}

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
