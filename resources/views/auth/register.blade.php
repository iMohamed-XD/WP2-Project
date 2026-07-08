<x-layout>

<div class="card auth-card text-light">
    <div class="card-body p-5">

        <h2 class="card-title text-center mb-4">
            Create Account
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

        <form action="{{ route('register.post') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Choose username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Password">
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    placeholder="Confirm password">
            </div>

            <button class="btn btn-success w-100 mb-3">
                Register
            </button>

        </form>

        <div class="text-center text-secondary">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>
</div>

</x-layout>
