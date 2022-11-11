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
                                    @if (in_array($permission['id'], $permissionIds))
                                        <option value="{{ $permission['id'] }}" selected>{{ $permission['name'] }}</option>
                                    @else
                                        <option value="{{ $permission['id'] }}">{{ $permission['name'] }}</option>
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

                <div class="row">
                    <div class="col-sm-12">

                        <div class="widget-body">
                            <ul id="auto-checkboxes" data-name="foo" class="list-unstyled list-feature">
                                <li id="mainNode" class="ui-widget ui-widget-content daredevel-tree">
                                    <input type="checkbox" class="hrv-checkbox-parent"
                                        id="expandCollapseAllTree">&nbsp;&nbsp;
                                    <label for="expandCollapseAllTree" class="label label-default allTree">All
                                        Permissions</label>
                                    <ul>
                                        <li class=" ui-widget ui-widget-content daredevel-tree" id="node0">
                                            <span class="daredevel-tree-anchor ui-icon ui-icon-triangle-1-e"></span>
                                            <input type="checkbox" class="hrv-checkbox" id="checkSelect0" name="flags[]"
                                                value="ads.index">
                                            <label for="checkSelect0" class="label label-warning"
                                                style="margin: 5px;">Ads</label>
                                            <ul style="">
                                                <li class=" ui-widget ui-widget-content daredevel-tree"
                                                    id="node_sub_0_0"><span
                                                        class="daredevel-tree-anchor ui-icon-triangle-1-e daredevel-tree-label ui-icon"></span>
                                                    <input type="checkbox" class="hrv-checkbox" id="checkSelect_sub_0_0"
                                                        name="flags[]" value="ads.create">
                                                    <label for="checkSelect_sub_0_0"
                                                        class="label label-primary nameMargin">List</label>
                                                </li>
                                                <li class=" ui-widget ui-widget-content daredevel-tree"
                                                    id="node_sub_0_0"><span
                                                        class="daredevel-tree-anchor ui-icon-triangle-1-e daredevel-tree-label ui-icon"></span>
                                                    <input type="checkbox" class="hrv-checkbox" id="checkSelect_sub_0_0"
                                                        name="flags[]" value="ads.create">
                                                    <label for="checkSelect_sub_0_0"
                                                        class="label label-primary nameMargin">Create</label>
                                                </li>
                                                <li class=" ui-widget ui-widget-content daredevel-tree"
                                                    id="node_sub_0_1"><span
                                                        class="daredevel-tree-anchor ui-icon-triangle-1-e daredevel-tree-label ui-icon"></span>
                                                    <input type="checkbox" class="hrv-checkbox" id="checkSelect_sub_0_1"
                                                        name="flags[]" value="ads.edit">
                                                    <label for="checkSelect_sub_0_1"
                                                        class="label label-primary nameMargin">Edit</label>
                                                </li>
                                                <li class=" ui-widget ui-widget-content daredevel-tree"
                                                    id="node_sub_0_2"><span
                                                        class="daredevel-tree-anchor ui-icon-triangle-1-e daredevel-tree-label ui-icon"></span>
                                                    <input type="checkbox" class="hrv-checkbox" id="checkSelect_sub_0_2"
                                                        name="flags[]" value="ads.destroy">
                                                    <label for="checkSelect_sub_0_2"
                                                        class="label label-primary nameMargin">Delete</label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
