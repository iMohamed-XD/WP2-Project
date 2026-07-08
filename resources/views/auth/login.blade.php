<x-layout>

<div class="card auth-card text-light">
    <div class="card-body p-5">

        <h2 class="card-title text-center mb-4">
            Welcome Back
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter username">
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Enter password">
            </div>

            <button class="btn btn-primary w-100 mb-3">
                Login
            </button>

        </form>

        <div class="text-center text-secondary">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </div>

    </div>
</div>

</x-layout>
