<x-layout>
    <div class="container my-3">
  <form action="{{route('user.update', [$user->id])}}" method="POST">
    @csrf
    <div class="row">
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="text" value="{{$user->name}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
      @error('name')
      <p class="text-danger">{{$message}}</p>
       @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" value="{{$user->email}}" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      @error('email')
      <p class="text-danger">{{$message}}</p>
       @enderror
    </div>
    <div class="form-group my-2">
        <select class="form-select" id="selectedRole" name="role_id" aria-label="Default select example">
            <option selected>Select Role</option>

            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{$role->name}}</option>
            @endforeach


          </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" value="{{$user->username}}" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
    @error('username')
      <p class="text-danger">{{$message}}</p>
       @enderror
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" value="" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        @error('password')
        <p class="text-danger">{{$message}}</p>
         @enderror
      </div>
    </div>
    <div class="form-group my-3">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

  </div>
  <script>
    document.getElementById('selectedRole').addEventListener('change', function () {
        document.getElementById('selectedRoleId').value = this.value;
    });
</script>
  </x-layout>
