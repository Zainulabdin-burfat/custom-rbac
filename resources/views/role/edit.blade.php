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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="all">
                                                <label class="form-check-label" for="all">
                                                    All Permissions
                                                </label>
                                            </div>
                                        </th>
                                        {{-- <label><input type=checkbox id=all></label>All Permissions</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($permissions as $permission)
                                        @php $permission = $permission->pluck('slug', 'id'); @endphp

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="parent form-check-input" type="checkbox">
                                                    <label class="form-check-label">{{ $permission['name'] }}</label>
                                                </div>

                                                <label><input type=checkbox class="child form-check-input"
                                                        name="{{ $permission['name'] }}[]"
                                                        value={{ $permission['id'] }}></label>
                                            </td>
                                            <td>
                                                <span>{{ $permission['slug'] }}</span>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Permissions Found..!</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        // *️⃣ Code for indeterminate state - There are comments for removal
        // Bind all checkboxes to the change event
        $(':checkbox').on('change', checkUncheck);

        function checkUncheck(e) {
            // The tag the user checked/unchecked
            const $this = $(this);
            // Reference to the closest <tr>
            const $row = $this.closest('tr');
            /*
            If the user clicked a .parent...
            ...and if it is checked...
            ... .find() all the <td> of $row...
            ...and check them all...
            ...otherwise uncheck them all
            */
            if ($this.is('.parent')) {
                if ($this.is(':checked')) {
                    $row.find('.child').prop('checked', true);
                } else {
                    $row.find('.child').prop('checked', false);
                }
            }
            /*
            If the user checked/unchecked a .child...
            ... .makeArray() of all of $row .child and...
            ... if .every() <td> is .checked then check .parent
            ... and if .some() <td> are .checked then .parent is...
            ... indeterminate, otherwise uncheck .parent
            */
            if ($this.is('.child')) {
                $row.find('.parent').prop('indeterminate', false); //*️⃣
                const chxArray = jQuery.makeArray($row.find('.child'));
                let rowChecked = chxArray.every(cb => cb.checked); //*️⃣
                let someChecked = chxArray.some(cb => cb.checked);
                if (rowChecked) {
                    /* if (someChecked) { */ //*️⃣ 
                    $row.find('.parent').prop('checked', true);
                } else if (someChecked) {
                    $row.find('.parent').prop('indeterminate', true); //*️⃣
                } else {
                    $row.find('.parent').prop('checked', false);
                }
            }
            /*
            If the user clicked #all...
            ...and if it is checked...
            ... .find() all the <td> of $tB...
            ...and check them all...
            ...otherwise uncheck them all
            */
            if ($this.is('#all')) {
                $('.parent').prop('indeterminate', false); //*️⃣
                if ($this.is(':checked')) {
                    $(':checkbox').prop('checked', true);
                } else {
                    $(':checkbox').prop('checked', false);
                }
            }
            /*
            If the user checked/unchecked a .child or .parent...
            ... .makeArray() of all of <td> in <tbody> and...
            ... if .every() <td> is checked...
            ... #all is checked and if .some() <td> are checked...
            ... then #all is indeterminate...
            ... otherwise uncheck #all
            */
            let allArray = jQuery.makeArray($(':checkbox').not('#all'));
            if (allArray.every(cb => cb.checked)) {
                $('#all').prop('indeterminate', false); //*️⃣
                $('#all').prop('checked', true); /* Move to: ✳️ */
            } else if (allArray.some(cb => cb.checked)) {
                $('#all').prop('indeterminate', true); //*️⃣ ✳️
            } else {
                $('#all').prop('indeterminate', false); //*️⃣
                $('#all').prop('checked', false);
            }
        }
    </script>
@endsection
