<x-layout>

<div class="card auth-card text-center text-light">
    <div class="card-body p-5">

        <h1 class="display-5 fw-bold mb-3">
            AIU GYM
        </h1>

        <p class="text-secondary mb-4">
            Welcome! Please login or create a new account.
        </p>

        <div class="d-grid gap-3">

            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                Register
            </a>

        </div>

    </div>
</div>

</x-layout>
