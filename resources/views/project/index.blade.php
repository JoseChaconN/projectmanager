<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de Proyectos</h6>
                        </div>
                        <div class="col-md-3">
                            <a class=" float-right btn btn-primary btn-sm" href="{{ route('project.create') }}">Nuevo Proyecto</a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-left-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>Proyecto</th>
                                        <th>Creado</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('project.edit',$item->id ) }}">Editar</a>
                                                <button type="button" onclick="confirmDelete('{{ route('project.destroy', $item->id) }}','{{  $item->id }}')" class="btn btn-danger btn-sm">Eliminar</button>
                                                <a href="{{ route('task.create',$item->id) }}" class="btn btn-success btn-sm">Actividades</a>
                                                <a href="{{ route('project.show',$item->id) }}" class="btn btn-warning btn-sm">Estado</a>
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