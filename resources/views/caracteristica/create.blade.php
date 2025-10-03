<div class="container mt-4">
    <form action="{{url('/caracteristicas')}}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-white shadow rounded">
        @csrf
        @include('forms', ['Modo' => 'crearCarac'])
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
        </div>
    </form>
</div>