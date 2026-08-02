<nav class="navbar-custom">

    <div class="navbar-title">
        Warehouse Management
    </div>

    <div class="navbar-user">

        <i class="bi bi-bell"></i>

        <div class="user-box">
            <i class="bi bi-person-circle"></i>
            {{ Auth::user()->name ?? 'Guest' }}
        </div>

        {{-- Logout Button --}}
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>

    </div>

</nav>