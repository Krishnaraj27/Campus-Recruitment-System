
<header>
    <nav class="navbar bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Campus Recruitment System</span>
            
            <form class="d-flex" action="{{route('doLogout')}}" method="post">
                @csrf
                <button class="btn btn-light">Logout</button>
            </form>
        </div>
    </nav>
</header>