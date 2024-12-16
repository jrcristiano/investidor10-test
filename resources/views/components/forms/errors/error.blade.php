@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        <strong>Erro ao enviar dados:</strong> {{ $error }}
    </div>
@endforeach
