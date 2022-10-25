@extends('layouts.app')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card shadow p-4">
            <h3 class="text-center mb-2">Edit Role</h3>
            <form action="{{ route('role.update', $role->id) }}" method="POST" id="update-role">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}">
                </div>

                <p>Permissions</p>
                <div class="row mb-3">
                    @foreach ($permissions as $permission)
                        <div class="col-md-3 col-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                    name="permissions[]" id="{{ $permission->name }}"
                                    @if (in_array($permission->id, $old_permissions)) checked @endif />
                                <label class="form-check-label" for="{{ $permission->name }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="float-end mt-4">
                    <a href="{{ route('role.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\CreateRoleRequest', '#create-role') !!}
@endpush
