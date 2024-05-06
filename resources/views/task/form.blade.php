<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Actividades del Proyecto {{ $project->name }}</h6>
                    </div>
                </div>
                <form action="{{ route('task.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
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
                                            <button class="btn btn-primary btn-icon-split btn-sm" type="button" onclick="fnAddMoreActivity()">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Agregar Más</span>
                                            </button>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="activity-div col-md-12">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            @forelse ($project->tasks as $item)
                                                <div class="col-md-12" id="activity_{{ $item->id }}">
                                                    <input type="hidden" name="activity_h[]" value="{{ $item->id }}">
                                                    <div class="col-md-12">
                                                        <button class="btn-danger btn-circle btn-sm btn-delete-activity" type="button"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="customCheckboxInline_{{ $item->id }}" name="activity_finished_h[]" {{($item->finished == 1) ? 'checked' : ''}} class="custom-control-input" value="1">
                                                            <label class="custom-control-label" for="customCheckboxInline_{{ $item->id }}">Actividad Terminada</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label font-weight-bold">Actividad:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="activity_name_h[]" placeholder="Actividad" value="{{ $item->name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label font-weight-bold">Descripción:</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" name="activity_description_h[]" rows="3" placeholder="Descripción">{{ $item->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label font-weight-bold">Fecha Inicio:</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control" name="activity_start_h[]" placeholder="Titulo Documento" value="{{ $item->start_date }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label font-weight-bold">Fecha Termino:</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control" name="activity_end_h[]" placeholder="Titulo Documento" value="{{ $item->end_date }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label font-weight-bold">Adjunto:</label>
                                                            <div class="col-sm-8">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="activity_document_h[]">
                                                                    <label class="custom-file-label" >Buscar Archivo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (!empty($item->getMedia('project-task-file')->last()))
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label class="font-weight-bold">Adjunto:</label>
                                                                <a class="btn btn-primary btn-sm mt-1" download="" href="{{$item->getMedia('project-task-file')->last()->getUrl()}}" target="_blank">Descargar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-md-12" id="activity_" style="display: none">
                                    <div class="col-md-12">
                                        <button class="btn-danger btn-circle btn-sm btn-delete-activity" type="button"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label font-weight-bold">Actividad:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control activity_name" placeholder="Actividad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label font-weight-bold">Descripción:</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control activity_description" rows="3" placeholder="Descripción"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label font-weight-bold">Fecha Inicio:</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control activity_start" placeholder="Titulo Documento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label font-weight-bold">Fecha Termino:</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control activity_end" placeholder="Titulo Documento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label font-weight-bold">Adjunto:</label>
                                            <div class="col-sm-8">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input activity_document">
                                                    <label class="custom-file-label" >Buscar Archivo</label>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function fnAddMoreActivity() {
            number= Math.round(Math.random()*(9999999999-1)+parseInt(1));
            clone = $("#activity_").clone().removeClass("hide");
            clone.attr("id", "activity_"+number).removeClass("hide");
            
            clone.find('.activity_name').attr('name','activity_name[]');
            clone.find('.activity_description').attr('name','activity_description[]');
            clone.find('.activity_start').attr('name','activity_start[]');
            clone.find('.activity_end').attr('name','activity_end[]');
            clone.find('.activity_document').attr('name','activity_document[]');
            clone.find('.fotografia').attr('name','fotografia[]');
            clone.find('.btn-delete-activity').attr("onclick","$('#activity_"+number+"').remove()");        
            
            $('.activity-div').append(clone.show());
        }
    </script>
</x-app-layout>