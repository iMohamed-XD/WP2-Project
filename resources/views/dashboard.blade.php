<x-layout>
    <h1>Dashboard</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</x-layout>
