<div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deactivateModalLabel">Deactivate Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deactivateForm" method="POST" action="{{ route('admin.modules.deactivate', ':module') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p class="mb-3">Are you sure you want to deactivate this module?</p>
                    <div class="form-check">
                        <input type="checkbox" name="remove_tables" id="removeTables" class="form-check-input">
                        <label for="removeTables" class="form-check-label">
                            Remove database tables?
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-page-block-overlay waves-effect waves-light">
                        <i class="bi bi-pause-circle"></i> Deactivate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const deactivateModal = document.getElementById('deactivateModal');
    deactivateModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const module = button.getAttribute('data-module');
        const form = document.getElementById('deactivateForm');
        const action = form.getAttribute('action').replace(':module', module);
        form.setAttribute('action', action);
    });
</script>
