@props(['name' => 'someone'])

<div class="container py-3">
    <div class="d-flex justify-content-start mb-4">
        <div class="user-badge">
            <span class="user-icon">
                <i class="bi bi-person-circle"></i>
            </span>

            <div>
                <small>Logged in as</small>
                <strong>{{ $name }}</strong>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="ms-3">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
