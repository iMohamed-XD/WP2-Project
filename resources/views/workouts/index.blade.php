<x-layout>
    classes
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-outline-danger btn-lg w-100">
            Logout
        </button>
    </form>
</x-layout>