@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <h1>Modifica: {{ $project->titolo }}</h1>
    </div>

    <div class="container">
        <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

            <div class="form-group">
                <label for="titolo">Titolo</label>
                <input type="text" class="form-control @error('titolo') is-invalid @enderror"
                 id="titolo"
                 name="titolo"
                 value="{{old('titolo', $project->titolo)}}" 
                >
                <!-- genera errore sotto input -->
                @error('titolo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type-id" class="form-label">Tipo</label>
                <select class="form-select @error('type_id') is-invalid @enderror" id="type-id" name="type_id">
                    <option value="" selected>Seleziona tipologia</option>
                    @foreach ($types as $type)
                        <option @selected( old('type_id', $project->type_id) == $type->id ) value="{{ $type->id }}">{{ $type->nome }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="technologies" class="form-label">Technology</label>
                <div class="d-flex @error('technologies') is-invalid @enderror flex-wrap gap-3">

                    @foreach($technologies as $key => $technology)
                        <div class="form-check">
                            <input name="technologies[]"
                            @checked( in_array($technology->id, old('technologies',$project->getTechIds()) ) ) 
                            class="form-check-input"
                            type="checkbox"
                            value="{{ $technology->id }}" 
                            id="flexCheckDefault"
                            >
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $technology->nome }}
                            </label>
                        </div>
                    @endforeach
                </div>

                @error('technologies')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cliente">Cliente</label>
                <input type="text" class="form-control @error('cliente') is-invalid @enderror"
                 id="cliente"
                 name="cliente"
                 value="{{ old('cliente', $project->cliente) }} "
                >
                <!-- genera errore sotto input -->
                @error('cliente')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" 
                id="link"
                name="link"
                value="{{ old('link', $project->link)}} "
                >
                 <!-- genera errore sotto input -->
                @error('link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="descrizione">Descrizione</label>
                <textarea class="form-control @error('descrizione') is-invalid @enderror"
                id="descrizione"
                name="descrizione"
                rows="3"
                >{{ old('descrizione', $project->descrizione) }}</textarea>
                <!-- genera errore sotto input -->
                @error('descrizione')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salva</button>
        </form>

    </div>
@endsection