@if (session('success'))
    <div
        id="alertMessage"
        class="alert alert-success fw-500 position-fixed top-0 end-0 m-3"
        role="alert"
    >
    <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
    </div>
@endif
