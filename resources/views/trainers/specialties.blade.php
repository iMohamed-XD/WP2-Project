<x-layout>

    <style>
        .section-title h3 {
            font-size: 1.35rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #3b82f6;
            padding-left: 12px;
        }

        .section-title h3 i { color: #60a5fa; }

        .badge-count {
            font-size: .75rem;
            font-weight: 600;
            color: #93c5fd;
            background: rgba(59, 130, 246, .12);
            border: 1px solid rgba(59, 130, 246, .35);
            padding: 2px 10px;
            border-radius: 999px;
        }

        .specialty-table {
            --bs-table-bg: transparent;
            --bs-table-color: #e2e8f0;
            --bs-table-border-color: #334155;
            --bs-table-hover-bg: rgba(59, 130, 246, .08);
            --bs-table-hover-color: #ffffff;
        }

        .specialty-table thead th {
            color: #94a3b8;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 600;
            border-bottom: 1px solid #334155;
        }

        .specialty-input { max-width: 280px; }

        .btn-edit {
            background: rgba(34, 197, 94, .12);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, .35);
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-edit:hover { background: #22c55e; color: white; }

        .btn-delete {
            background: rgba(239, 68, 68, .1);
            color: #f87171;
            border: 1px solid #f87171;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete:hover { background: #f87171; color: white; }

        .btn-add-specialty {
            background: #3b82f6;
            color: white;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border: none;
        }

        .btn-add-specialty:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: transparent;
            color: #cbd5e1;
            border: 1px solid #334155;
        }

        .btn-cancel:hover { background: #1e293b; color: white; }

        .empty-icon { font-size: 2rem; color: #334155; }
        .empty-state { color: #64748b; }

        .add-specialty-modal {
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 16px;
        }

        .add-specialty-modal .modal-header,
        .add-specialty-modal .modal-footer { border-color: #1e293b; }
    </style>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <x-user-badge :name="auth()->user()->name"></x-user-badge>
        </div>

        <div class="auth-card p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 section-title mb-4">
                <h3 class="mb-0">
                    <i class="bi bi-tags-fill"></i>
                    Specialties Management
                    <span class="badge-count">{{ $specialties->total() }}</span>
                </h3>

                <button type="button" class="btn btn-add-specialty" data-bs-toggle="modal" data-bs-target="#addSpecialtyModal">
                    <i class="bi bi-plus-lg"></i>
                    Add Specialty
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle specialty-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Specialty Name</th>
                            <th class="text-end" style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($specialties as $specialty)
                        <tr>
                            <td class="text-secondary">{{ $loop->iteration }}</td>
                            <td>
                                <form action="{{ route('trainers.editSpecialties', $specialty->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="type" value="{{ $specialty->type }}"
                                           class="form-control form-control-sm specialty-input" required>
                                    <button class="btn btn-sm btn-edit" type="submit">
                                        <i class="bi bi-check2"></i>
                                        Save
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('trainers.deleteSpecialties', $specialty->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-delete" type="submit" onclick="return confirm('Delete this specialty?')">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state text-center py-5">
                                    <i class="bi bi-tags empty-icon"></i>
                                    <p class="mb-0 mt-2">No specialties yet. Add the first one to get started.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $specialties->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="modal fade" id="addSpecialtyModal" tabindex="-1" aria-labelledby="addSpecialtyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content add-specialty-modal">
                <form action="{{ route('trainers.createSpecialty') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSpecialtyLabel">
                            <i class="bi bi-tags-fill me-2"></i>
                            New Specialty
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newSpecialtyType" class="form-label">Specialty Name</label>
                        <input type="text" id="newSpecialtyType" name="type" class="form-control"
                               placeholder="e.g. Strength & Conditioning" required autofocus>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-add-specialty">
                            <i class="bi bi-plus-lg"></i>
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>