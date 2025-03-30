
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" method="POST" action="{{ route('admin.modules.destroy', ':module') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this module? This action cannot be undone.</p>
                    <div class="form-check">
                        <input type="checkbox" name="remove_tables" id="deleteRemoveTables" class="form-check-input">
                        <label for="deleteRemoveTables" class="form-check-label">Remove database tables?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-page-block-overlay waves-effect waves-light">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const module = button.getAttribute('data-module');
        const form = document.getElementById('deleteForm');
        const action = form.getAttribute('action').replace(':module', module);
        form.setAttribute('action', action);
    });
</script>
