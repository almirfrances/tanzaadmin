
@props(['type' => 'primary', 'message' => '', 'dismissible' => true])

<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    @if($type == 'success')
        <i class="ti ti-check-circle"></i>
    @elseif($type == 'error')
        <i class="ti ti-error"></i>
    @elseif($type == 'warning')
        <i class="ti ti-alert-circle"></i>
    @endif
    {{ $message }}

    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
