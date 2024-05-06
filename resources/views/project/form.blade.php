<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Ficha de Proyecto</h6>
                    </div>
                </div>
                <form action="{{ (!empty($data->id)) ? route('project.update',$data)  : route('project.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @if (!empty($data->id))
                        @method('PATCH')
                    @endif
                    <div class="card-body border-left-primary">
                        <div class="row">
                            <div class="col-md-12">
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