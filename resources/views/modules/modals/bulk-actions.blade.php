<div class="modal fade" id="bulkActivateModal" tabindex="-1" aria-labelledby="bulkActivateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkActivateModalLabel">Activate Selected Modules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to activate the selected modules?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success btn-page-block-overlay waves-effect waves-light" onclick="submitBulkAction('{{ route('admin.modules.bulkActivate') }}', 'POST')">Activate</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="bulkDeactivateModal" tabindex="-1" aria-labelledby="bulkDeactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkDeactivateModalLabel">Deactivate Selected Modules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you want to deactivate the selected modules? You can also choose to remove database tables.</p>
                <div class="form-check">
                    <input type="checkbox" id="removeTablesCheckbox" class="form-check-input" onchange="toggleRemoveTables(this)">
                    <label for="removeTablesCheckbox" class="form-check-label">Remove database tables?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning btn-page-block-overlay waves-effect waves-light" onclick="submitBulkAction('{{ route('admin.modules.bulkDeactivate') }}', 'POST')">Deactivate</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-labelledby="bulkDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkDeleteModalLabel">Delete Selected Modules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the selected modules? This action is irreversible. Optionally, remove database tables as well.</p>
                <div class="form-check">
                    <input type="checkbox" id="deleteRemoveTablesCheckbox" class="form-check-input" onchange="toggleRemoveTables(this)">
                    <label for="deleteRemoveTablesCheckbox" class="form-check-label">Remove database tables?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-page-block-overlay waves-effect waves-light" onclick="submitBulkAction('{{ route('admin.modules.bulkDelete') }}', 'POST')">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    const selectAllCheckbox = document.getElementById('selectAllModules');
    const moduleCheckboxes = document.querySelectorAll('.moduleCheckbox');
    const bulkSelectedModules = document.getElementById('bulkSelectedModules');

    // Function to update the selected modules in the form
    function updateSelectedModules() {
        bulkSelectedModules.innerHTML = ''; // Clear existing selections
        moduleCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'modules[]';
                input.value = checkbox.value;
                bulkSelectedModules.appendChild(input);
            }
        });
    }

    // "Select All" functionality
    selectAllCheckbox.addEventListener('change', function () {
        moduleCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedModules(); // Update hidden inputs when "Select All" is toggled
    });

    // Individual checkbox change
    moduleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedModules);
    });

    // Set form action dynamically for bulk actions
    function submitBulkAction(action, method) {
        const selectedModules = document.querySelectorAll('.moduleCheckbox:checked');
        if (selectedModules.length === 0) {
            alert('Please select at least one module.');
            return;
        }
        const form = document.getElementById('bulkActionForm');
        form.action = action;
        form.querySelector('input[name="_method"]').value = method;
        form.submit();
    }

    // Toggle database removal checkbox
    function toggleRemoveTables(checkbox) {
        const form = document.getElementById('bulkActionForm');
        form.querySelector('input[name="remove_tables"]').value = checkbox.checked ? 1 : 0;
    }
</script>
