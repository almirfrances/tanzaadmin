<div class="modal fade" id="cronJobModal" tabindex="-1" aria-labelledby="cronJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white mb-2" id="cronJobModalLabel"><i class="ti ti-clock"></i> Cron Job Setup</h5>
                <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="fs-5 text-muted">
                        For email notifications to function correctly, a background process must run continuously.
                        Use the following cron job command to ensure this:
                    </p>
                </div>
                <div class="bg-light border rounded p-3 d-flex align-items-center justify-content-between">
                    <code id="cronCommand" class="text-primary fw-bold"></code>

                </div>
                <div class="mt-3">
                    <p class="text-muted">
                        <strong>Note:</strong> Update your server's crontab with the above command. After making the changes, refresh this page to verify the setup.
                    </p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch queue status and dynamically display the cron command
        fetch('{{ route("admin.email.queue-status") }}')
            .then(response => response.json())
            .then(data => {
                if (!data.isQueueRunning) {
                    const cronCommandElement = document.getElementById('cronCommand');
                    const cronJobModal = new bootstrap.Modal(document.getElementById('cronJobModal'));

                    // Populate and display modal
                    cronCommandElement.innerText = data.cronCommand;
                    cronJobModal.show();

                    // Add copy-to-clipboard functionality
                    document.getElementById('copyCronCommand').addEventListener('click', function () {
                        navigator.clipboard.writeText(data.cronCommand).then(() => {
                            alert('Cron command copied to clipboard!');
                        }).catch(err => {
                            console.error('Failed to copy:', err);
                        });
                    });
                }
            })
            .catch(error => console.error('Error fetching queue status:', error));
    });
</script>
