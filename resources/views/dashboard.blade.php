<x-layout>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card auth-card border-0">

                <div class="card-body p-5">

                    <h1 class="display-5 fw-bold text-center mb-3">
                        Dashboard
                    </h1>

                    <p class="text-secondary text-center mb-5">
                        Welcome to the Sports Club Management System.
                    </p>

                    <div class="d-grid gap-3">

                        <a href="{{ route('trainers.index') }}"
                        class="btn btn-primary btn-lg">
                            Management of Trainers & Sports Staff
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button class="btn btn-outline-danger btn-lg w-100">
                                Logout
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-layout>
