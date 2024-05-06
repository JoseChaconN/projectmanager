<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de Actividades</h6>
                        </div>
                        <div class="col-md-3">
                            <a class=" float-right btn btn-primary btn-sm" href="{{ route('activity.create') }}">Nueva Actividad</a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-left-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>Actividad</th>
                                        <th>Creado</th>
                                        <th>Etapas</th>
                                        <th>Proyectos</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                                            <td>
                                                @forelse($item->projects as $project)
                                                    <li>{{ $project->name }}</li>
                                                @empty
                                                    <li>No hay proyectos asociados a esta etapa.</li>
                                                @endforelse
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('stage.edit',$item->id ) }}">Editar</a>
                                                <button type="button" onclick="confirmDelete('{{ route('stage.destroy', $item->id) }}','{{  $item->id }}')" class="btn btn-danger btn-sm">Eliminar</button>
                                                {{-- <a href="{{ route('stage.create',$item->id) }}" class="btn btn-success btn-sm">Etapas</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>