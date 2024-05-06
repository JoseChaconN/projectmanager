<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Ficha de Etapas</h6>
                    </div>
                </div>
                <form action="{{ (!empty($data->id)) ? route('stage.update',$data)  : route('stage.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @if (!empty($data->id))
                        @method('PATCH')
                    @endif
                    <div class="card-body border-left-primary">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="m-0 font-weight-bold text-primary">Proyectos</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($projects as $item)
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" {{ $projects_stage->contains($item->id) ? 'checked' : '' }} id="customCheckboxInline2_{{ $item->id }}" name="project_ids[{{ $item->id }}]" class="custom-control-input" value="{{ $item->id }}">
                                                <label class="custom-control-label" for="customCheckboxInline2_{{ $item->id }}">{{ $item->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nombre:</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name' , $data->name)}}" placeholder="Nombre">
                                            @error('name')
                                                <small class="text-danger">*El campo Nombre es obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Descripción:</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Descripción">{{ old('obs' , $data->description)}}</textarea>
                                        </div>
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
</x-app-layout>