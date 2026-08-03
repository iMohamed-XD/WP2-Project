@extends('workouts.layouts.app')

@section('title', 'البحث المتقدم عن الحصص')

@section('content')
<h2 class="mb-4"><i class="bi bi-search"></i> البحث المتقدم عن الحصص</h2>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form id="searchForm" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">التخصص الرياضي</label>
                <select name="sports_type_id" id="sports_type_id" class="form-select">
                    <option value="">-- الكل --</option>
                    @foreach($sportsTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">المستوى</label>
                <select name="workout_level_id" id="workout_level_id" class="form-select">
                    <option value="">-- الكل --</option>
                    @foreach($workoutLevels as $level)
                        <option value="{{ $level->id }}">{{ $level->level }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">الحد الأقصى للسعر</label>
                <input type="number" min="0" step="0.01" name="max_price" id="max_price" class="form-control" placeholder="مثال: 200">
            </div>

            <div class="col-12">
                <button type="button" id="btnSearch" class="btn btn-primary">
                    <i class="bi bi-search"></i> بحث
                </button>
                <button type="reset" id="btnReset" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> إعادة تعيين
                </button>
            </div>
        </form>
    </div>
</div>

<!-- منطقة النتائج -->
<div id="resultsInfo" class="mb-3 text-muted"></div>
<div class="row" id="resultsContainer">
    <div class="col-12 text-center text-muted py-5">
        <i class="bi bi-funnel fs-1"></i>
        <p class="mt-2">استخدم الفلاتر أعلاه ثم اضغط "بحث" لعرض النتائج.</p>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    function performSearch() {
        const params = {
            sports_type_id: $('#sports_type_id').val(),
            workout_level_id: $('#workout_level_id').val(),
            max_price: $('#max_price').val(),
        };

        $('#resultsContainer').html('<div class="col-12 text-center py-5"><div class="spinner-border text-primary"></div></div>');

        $.ajax({
            url: "{{ route('workouts.search') }}",
            method: 'GET',
            data: params,
            dataType: 'json',
            success: function (response) {
                $('#resultsContainer').html(response.html);
                $('#resultsInfo').html('<i class="bi bi-info-circle"></i> تم العثور على ' + response.count + ' حصة/حصص.');
            },
            error: function () {
                $('#resultsContainer').html('<div class="col-12"><div class="alert alert-danger">حدث خطأ أثناء البحث، يرجى المحاولة مجدداً.</div></div>');
            }
        });
    }

    $('#btnSearch').on('click', function (e) {
        e.preventDefault();
        performSearch();
    });

    $('#btnReset').on('click', function () {
        setTimeout(function () {
            $('#resultsContainer').html(
                '<div class="col-12 text-center text-muted py-5">' +
                '<i class="bi bi-funnel fs-1"></i>' +
                '<p class="mt-2">استخدم الفلاتر أعلاه ثم اضغط "بحث" لعرض النتائج.</p>' +
                '</div>'
            );
            $('#resultsInfo').html('');
        }, 10);
    });

});
</script>
@endpush
