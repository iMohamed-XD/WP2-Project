<x-layout>
<div class="d-flex justify-content-center align-items-center vh-100">
<div class="card auth-card text-light m-4 w-50 mx-auto">
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

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="loginUsername"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter username">
                <label for="loginUsername">Username</label>
            </div>

            <div class="form-floating mb-4">
                <input
                    type="password"
                    class="form-control"
                    id="loginPassword"
                    name="password"
                    placeholder="Enter password">
                <label for="loginPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 mb-3">
                Login
            </button>

        </form>

        {{-- <div class="text-center text-secondary">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </div> --}}

    </div>
</div>
</div>
</x-layout>