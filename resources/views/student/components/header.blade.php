
<!-- This navbar is for pages for unauthorized users -->

<header>
    <nav class="navbar bg-dark navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Campus Recruitment</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Profile</a>
              </li>
              @if ($user->email_verified_at == null)    
                <li class="nav-item dropdown mx-2">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Placement Drives
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Upcoming</a></li>
                    <li><a class="dropdown-item" href="#">Applied</a></li>
                  </ul>
                </li>
              @endif
            </ul>
            <form class="d-flex" action="{{route('doLogout')}}" method="POST">
              <button class="btn btn-outline-success">Logout</button>
            </form>
          </div>
        </div>
      </nav>
</header>