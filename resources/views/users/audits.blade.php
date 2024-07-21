@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-8 main-content">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">Auditorías de {{ $user->name }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Cambio</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($audits as $audit)
                                <tr>
                                    <td>{{ $audit->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ ucfirst($audit->event) }}</td>
                                    <td>{{ $audit->user->name ?? 'Sistema' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#details-{{ $audit->id }}" aria-expanded="false" aria-controls="details-{{ $audit->id }}">
                                            <i class="fas fa-eye"></i> Ver Detalles
                                        </button>
                                        <div class="collapse mt-2" id="details-{{ $audit->id }}">
                                            <div class="card card-body">
                                                <strong>Valores Anteriores:</strong>
                                                <pre>{{ json_encode($audit->old_values, JSON_PRETTY_PRINT) }}</pre>
                                                <strong>Valores Nuevos:</strong>
                                                <pre>{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay registros de auditorías disponibles</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 sidebar-right">
            <div class="accordion mt-4" id="sidebarAccordion">
                <div class="card">
                    <div class="card-header bg-primary text-white" id="headingSuggestions">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSuggestions" aria-expanded="true" aria-controls="collapseSuggestions">
                                Información adicional
                            </button>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
