<x-layout>

    <form  action="{{route("role.update", [$role->id])}}" method="post" id="roleForm">
        @csrf
        <div style="margin-left: 30px; margin-right: 30px;">
        <div class="mb-3">
          <label for="Role Name" class="form-label">Role Name</label>
          <input type="text" name="roleName" value="{{$role->name}}" class="form-control" >
        </div>
        <h5>Role Permissions</h5>
        <div class="checkbox-container" style="display: flex;">
            <label for="User" class="form-label" id="userLabel">{{$feature['user']->name}}</label>
                @foreach ($permissions['userPermission'] as $userPermission)
                <div class="form-check mx-3">
                    <input class="form-check-input" type="checkbox" value="{{ $userPermission->name }}" name="permissions[]" id="userPermission_{{ $userPermission->id }}" {{ in_array($userPermission->name, $role->permissions->pluck('name')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label" for="userPermission_{{ $userPermission->id }}">
                        {{ $userPermission->name }}
                    </label>
                </div>
            @endforeach


        </div>

        <div class="checkbox-container" style="display: flex;">
            <label for="Role" class="form-label" id="roleLabel">{{$feature['role']->name}}</label>
            @foreach ($permissions['rolePermission'] as $rolePermission)
        <div class="form-check mx-3">
            <input class="form-check-input" type="checkbox" value="{{ $rolePermission->name }}" name="permissions[]" id="rolePermission_{{ $rolePermission->id }}"  {{ in_array($rolePermission->name, $role->permissions->pluck('name')->toArray()) ? 'checked' : '' }}>
            <label class="form-check-label" for="rolePermission_{{ $rolePermission->id }}">
                {{ $rolePermission->name }}
            </label>


    </div>
        @endforeach

        </div>

      <button  type="submit" class="btn btn-primary my-3">Update</button>
    </form>

</x-layout>
