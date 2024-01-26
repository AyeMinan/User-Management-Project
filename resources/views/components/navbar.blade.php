    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              @can('userViewPermission')
                <li class="nav-item">
                <a class="nav-link" href="{{ route('main.index') }}">User</a>
                </li>
            @endcan
            @can('roleViewPermission')
              <li class="nav-item">
                <a class="nav-link" href="{{route("main.show")}}">Role</a>
              </li>
              @endcan
              @can('productViewPermission')
              <li class="nav-item">
                <a class="nav-link" href="/product">Product</a>
              </li>
              @endcan
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            @if (auth()->check())
            <a style="margin-right: 12px" class="nav-link" href="{{route("main.index")}}">{{auth()->user()->name}}</a>
            <form action="/logout" method="POST">
                @csrf
           <a  class="nav-item"><button class="btn btn-danger" type="submit" style="margin-bottom: 12px">Logout</button></a>
            </form>

            @else
            <a  class="nav-link" href="/login">Login</a>
            <a style="padding-right: 20px; padding-left: 20px;"class="nav-link" href="{{route("register.create")}}">Register</a>
            @endif




          </div>
        </div>
      </nav>


