
<div class="modal fade" id="uploadModuleModal" tabindex="-1" aria-labelledby="uploadModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModuleModalLabel">Upload New Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.modules.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="moduleZip" class="form-label">Module ZIP File</label>
                        <input type="file" name="file" id="moduleZip" class="form-control" accept=".zip" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">Upload Module</button>
                </div>
            </form>
        </div>
    </div>
</div>
