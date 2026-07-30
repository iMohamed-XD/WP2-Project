<x-layout>
    <x-user-badge :name="auth()->user()->name"></x-user-badge>

    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .filter-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .filter-card-header h4 {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #3b82f6;
            padding-left: 12px;
            margin-bottom: 4px;
        }

        .filter-card-header h4 i { color: #60a5fa; }

        /* --- Trainer cards (used by _trainer_grid partial) --- */
        .trainer-card {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,.3);
            transition: .25s;
            display: flex;
            flex-direction: column;
        }

        .trainer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 45px rgba(59,130,246,.15);
        }

        .trainer-card-photo {
            position: relative;
            height: 240px;
        }

        .trainer-card-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-pill {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: .72rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(6px);
        }

        .status-pill i { font-size: .5rem; }

        .status-pill-green { background: rgba(34,197,94,.18); color: #4ade80; border: 1px solid rgba(34,197,94,.4); }
        .status-pill-amber { background: rgba(245,158,11,.18); color: #fbbf24; border: 1px solid rgba(245,158,11,.4); }
        .status-pill-blue  { background: rgba(59,130,246,.18); color: #93c5fd; border: 1px solid rgba(59,130,246,.4); }
        .status-pill-red   { background: rgba(239,68,68,.18); color: #f87171; border: 1px solid rgba(239,68,68,.4); }
        .status-pill-gray  { background: rgba(148,163,184,.15); color: #cbd5e1; border: 1px solid rgba(148,163,184,.35); }

        .trainer-card-body {
            padding: 18px 20px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .trainer-name {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .trainer-specialty {
            color: #93c5fd;
            font-size: .85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .trainer-stats {
            display: flex;
            justify-content: space-between;
            color: #94a3b8;
            font-size: .82rem;
            border-top: 1px solid #1e293b;
            padding-top: 12px;
        }

        .trainer-stats span { display: flex; align-items: center; gap: 6px; }

        .empty-box {
            background: #020617;
            border: 1px dashed #334155;
            border-radius: 12px;
            padding: 48px;
            text-align: center;
            color: #64748b;
        }
    </style>

    <div class="container py-5">

        <div class="page-header">
            <div>
                <h1>Trainers</h1>
                <p class="text-body mb-0">Manage trainers and sports staff.</p>
            </div>
            <a href="{{ route('trainers.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus-fill me-1"></i> Add Trainer
            </a>
        </div>

        <div class="card auth-card border-0 mb-5">
            <div class="card-header bg-transparent border-bottom border-secondary py-3">
                <div class="filter-card-header">
                    <div>
                        <h4><i class="bi bi-funnel-fill"></i> Filter Trainers</h4>
                        <small class="text-body">Search and filter trainers by different criteria.</small>
                    </div>
                    <button class="btn btn-outline-light" id="clearFilters">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Clear Filters
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-8 col-xl-7">
                        <label class="form-label"><i class="bi bi-search"></i> Name</label>
                        <input
                            type="text"
                            id="nameSearchInput"
                            class="form-control filter-input"
                            placeholder="Search by first or last name"
                            value="{{ request('search') }}">
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4">
                        <label class="form-label"><i class="bi bi-person-badge"></i> Employment Status</label>
                        <select id="statusSelect" class="form-select filter-input">
                            <option value="">All Statuses</option>
                            @foreach($trainerStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label"><i class="bi bi-graph-up"></i> Minimum Experience</label>
                        <input type="number" id="experienceInput" class="form-control filter-input" placeholder="Years">
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label"><i class="bi bi-award"></i> Sports Type</label>
                        <select id="specialtySelect" class="form-select filter-input">
                            <option value="">All Sports Types</option>
                            @foreach($sportsTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div id="trainerGridContainer">
            @include('trainers._trainer_grid')
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {

                function loadTrainers(page = 1) {
                    let specialty = $('#specialtySelect').val();
                    let experience = $('#experienceInput').val();
                    let status = $('#statusSelect').val();
                    let search = $('#nameSearchInput').val();

                    $.ajax({
                        url: "{{ route('trainers.index') }}",
                        type: "GET",
                        data: {
                            specialty: specialty,
                            experience: experience,
                            status: status,
                            page: page,
                            search: search
                        },
                        success: function(data) {
                            $('#trainerGridContainer').html(data);

                            let newUrl = new URL(window.location.href);

                            if (specialty) newUrl.searchParams.set('specialty', specialty);
                            else newUrl.searchParams.delete('specialty');

                            if (experience) newUrl.searchParams.set('experience', experience);
                            else newUrl.searchParams.delete('experience');

                            if (status) newUrl.searchParams.set('status', status);
                            else newUrl.searchParams.delete('status');

                            if (page > 1) newUrl.searchParams.set('page', page);
                            else newUrl.searchParams.delete('page');

                            if (search) newUrl.searchParams.set('search', search);   
                            else newUrl.searchParams.delete('search');

                            history.pushState({}, '', newUrl);
                        }
                    });
                }

                $('.filter-input').on('change keyup', function() {
                    loadTrainers(1);
                });

                let searchTimer;
                $('#nameSearchInput').off('keyup').on('keyup', function() {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(() => loadTrainers(1), 350);
                });

                $('#clearFilters').click(function () {
                    $('#nameSearchInput').val('');
                    $('#specialtySelect').val('');
                    $('#experienceInput').val('');
                    $('#statusSelect').val('');
                    loadTrainers(1);
                });

                $(document).on('click', '#trainerGridContainer .pagination a', function(e) {
                    e.preventDefault();
                    let url = new URL($(this).attr('href'));
                    let page = url.searchParams.get('page');
                    loadTrainers(page);
                });

                window.addEventListener('popstate', function() {
                    let params = new URL(window.location.href).searchParams;

                    $('#specialtySelect').val(params.get('specialty') || '');
                    $('#experienceInput').val(params.get('experience') || '');
                    $('#statusSelect').val(params.get('status') || '');
                    $('#nameSearchInput').val(params.get('search') || '');

                    loadTrainersFromUrl(params.get('page') || 1);
                });

                function loadTrainersFromUrl(page = 1) {
                    let specialty = $('#specialtySelect').val();
                    let experience = $('#experienceInput').val();
                    let status = $('#statusSelect').val();
                    let search = $('#nameSearchInput').val();

                    $.ajax({
                        url: "{{ route('trainers.index') }}",
                        type: "GET",
                        data: { specialty, experience, status, page, search },
                        success: function(data) {
                            $('#trainerGridContainer').html(data);
                        }
                    });
                }

            });
        });
    </script>
</x-layout>