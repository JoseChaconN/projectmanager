<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Proyecto {{ $project->name }}</h6>
                    </div>
                </div>
                <div class="card-body border-left-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nombre:</label>
                                        <input type="text" name="name" disabled class="form-control" value="{{ old('name' , $project->name)}}" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Descripción:</label>
                                        <textarea class="form-control" disabled rows="3" name="description">{{ old('obs' , $project->description)}}</textarea>
                                    </div>
                                </div>
                            </div>                               
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Actividades
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="activity-div col-md-12">
                                    <table class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th>Estado</th>
                                                <th>Actividad</th>
                                                <th>Descripción</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Termino</th>
                                                <th>Adjunto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($project->tasks as $item)
                                                <tr>
                                                    <td>{{($item->finished == 1) ? 'Finalizada' : 'Proceso'}}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->start_date }}</td>
                                                    <td>{{ $item->end_date }}</td>
                                                    <td>
                                                        @if (!empty($item->getMedia('project-task-file')->last()))
                                                            <a class="btn btn-primary btn-sm mt-1" download="" href="{{$item->getMedia('project-task-file')->last()->getUrl()}}" target="_blank">Descargar
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Sin actividades asignadas</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>