<x-layout>
    <div class="container py-5">
        {{-- Header row: title + add button --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-1">
                    Trainers
                </h1>
                <p class="text-secondary mb-0">
                    Manage trainers and sports staff.
                </p>
            </div>
            <a href="{{ route('trainers.create') }}"
            class="btn btn-primary">
                Add Trainer
            </a>
        </div>
        <div class="card auth-card border-0 shadow-sm mb-5">
            <div class="card-header bg-transparent border-bottom border-secondary py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 fw-bold">
                            Filter Trainers
                        </h4>
                        <small class="text-secondary">
                            Search and filter trainers by different criteria.
                        </small>
                    </div>
                    <button class="btn btn-outline-secondary"
                            id="clearFilters">
                        Clear Filters
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- Search --}}
                <div class="row mb-4">
                    <div class="col-lg-8 col-xl-7">
                        <label class="form-label">
                            Name
                        </label>
                        <input
                            type="text"
                            id="nameSearchInput"
                            class="form-control filter-input"
                            placeholder="Search by first or last name"
                            value="{{ request('search') }}">
                    </div>
                </div>
                {{-- Filters --}}
                <div class="row g-4">
                    <div class="col-lg-4">
                        <label class="form-label">
                            Employment Status
                        </label>
                        <select
                            id="statusSelect"
                            class="form-select filter-input">
                            <option value="">All Statuses</option>
                            @foreach($trainerStatuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">
                            Minimum Experience
                        </label>
                        <input
                            type="number"
                            id="experienceInput"
                            class="form-control filter-input"
                            placeholder="Years">
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">
                            Sports Type
                        </label>
                        <select
                            id="specialtySelect"
                            class="form-select filter-input">
                            <option value="">All Sports Types</option>
                            @foreach($sportsTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        {{-- Trainer grid (AJAX target) --}}
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

            });});
    </script>
</x-layout>
