<x-layout>
    <div style="padding: 20px  20px; max-width: 1200px; margin: 0 auto; border: solid black 1px;">
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(session('fail_message'))
        <div class="alert alert-danger">
            {{ session('fail_message') }}
        </div>
    @endif
    <table class="table">
       <a href="{{route("role.create")}}"> <button class="btn btn-primary">Create Role</button> </a>

        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Role</th>
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
          <tr>
            <th scope="row">1</th>
            <td>{{$role->name}}</td>
            <td><a href="{{route('role.edit', [$role->id])}}">
                <button class="btn btn-primary">Edit</button>
                </a></td>
                <form action="{{route('role.delete', [$role->id])}}" method="POST">
                    @csrf
                    @method('delete')
           <td><button class="btn btn-danger">Delete</button></td>
                </form>

        </tr>
          @endforeach
        </tbody>

      </table>
    </div>



</x-layout>
