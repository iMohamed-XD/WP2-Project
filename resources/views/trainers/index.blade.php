<x-layout>
<div class="container py-5">

    {{-- Header row: title + add button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Trainers</h1>
            <p class="text-secondary mb-0">Sports Staff Management</p>
        </div>
        <a href="{{ route('trainers.create') }}" class="btn btn-success">
            + Add Trainer
        </a>
    </div>

    {{-- Search / filter bar --}}
    <div class="card auth-card border-0 mb-5 p-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold">Specialization</label>
                <select id="specialtySelect" class="form-select filter-input">
                    <option value="">All Specializations</option>
                    @foreach($sportsTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="small fw-bold">Min. Experience (Years)</label>
                <input type="number" id="experienceInput" class="form-control filter-input" placeholder="e.g. 5">
            </div>
            <div class="col-md-4">
                <label class="small fw-bold">Employment Status</label>
                <select id="statusSelect" class="form-select filter-input">
                    <option value="">All Statuses</option>
                    @foreach($trainerStatuses as $status)
                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                    @endforeach
                </select>
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

                $.ajax({
                    url: "{{ route('trainers.index') }}",
                    type: "GET",
                    data: {
                        specialty: specialty,
                        experience: experience,
                        status: status,
                        page: page
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

                        history.pushState({}, '', newUrl);
                    }
                });
            }

            $('.filter-input').on('change keyup', function() {
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

                loadTrainersFromUrl(params.get('page') || 1);
            });

            function loadTrainersFromUrl(page = 1) {
                let specialty = $('#specialtySelect').val();
                let experience = $('#experienceInput').val();
                let status = $('#statusSelect').val();

                $.ajax({
                    url: "{{ route('trainers.index') }}",
                    type: "GET",
                    data: { specialty, experience, status, page },
                    success: function(data) {
                        $('#trainerGridContainer').html(data);
                    }
                });
            }

        });});
</script>
</x-layout>
