<x-layout>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div style="padding: 20px  20px; max-width: 1200px; margin: 0 auto; border: solid black 1px;">
    <table class="table">
        <a href="{{route("user.create")}}"> <button class="btn btn-primary">Create User</button> </a>
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">User</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user )
            <tr>
                <th scope="row">1</th>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td><a href="{{route('user.edit', [$user->id])}}" >
                    <button class="btn btn-primary">Edit</button>
                </a></td>

                    <form action="{{route('user.delete', [$user->id])}}" method="post">
                        @method('delete')
                        @csrf
                    <td><button class="btn btn-danger" type="submit">Delete</button></td>
                    </form>


              </tr>
            @endforeach


        </tbody>
      </table>
    </div>
</x-layout>
