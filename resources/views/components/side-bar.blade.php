@if (!request()->routeIs('login', 'welcome'))
<aside class="app-sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-lightning-charge-fill"></i>
        <span>AIU GYM</span>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('trainers.index') }}"
           class="sidebar-link {{ request()->routeIs('trainers.index') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Trainers</span>
        </a>

        <a href="{{ route('trainers.create') }}"
           class="sidebar-link {{ request()->routeIs('trainers.create') ? 'active' : '' }}">
            <i class="bi bi-person-plus-fill"></i>
            <span>Create Trainer</span>
        </a>

        @can('viewAny', \App\Models\SportsType::class)
        <a href="{{ route('trainers.specialties') }}"
           class="sidebar-link {{ request()->routeIs('trainers.specialties') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i>
            <span>Specialties</span>
        </a>
        @endcan
    </nav>
</aside>
@endif

<style>
    .app-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 240px;
        background: rgba(15, 23, 42, 0.9);
        backdrop-filter: blur(12px);
        border-right: 1px solid #334155;
        display: flex;
        flex-direction: column;
        padding: 20px 14px;
        z-index: 1030;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
        font-weight: 700;
        font-size: 1.05rem;
        padding: 6px 12px 22px;
        border-bottom: 1px solid #1e293b;
        margin-bottom: 18px;
    }

    .sidebar-brand i {
        color: #60a5fa;
        font-size: 1.3rem;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        color: #94a3b8;
        text-decoration: none;
        font-size: .9rem;
        font-weight: 500;
        transition: .2s;
    }

    .sidebar-link i {
        font-size: 1.05rem;
        width: 20px;
        text-align: center;
    }

    .sidebar-link:hover {
        background: rgba(59, 130, 246, .08);
        color: white;
    }

    .sidebar-link.active {
        background: rgba(59, 130, 246, .15);
        color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, .3);
    }

    @media (max-width: 768px) {
        .app-sidebar {
            width: 72px;
            padding: 20px 10px;
        }

        .sidebar-brand span,
        .sidebar-link span {
            display: none;
        }

        .sidebar-brand {
            justify-content: center;
        }

        .sidebar-link {
            justify-content: center;
        }
    }
</style>