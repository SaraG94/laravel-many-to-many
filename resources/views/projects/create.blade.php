@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <h1>Nuovo progetto</h1>
    </div>

    <div class="container">
        <form action="{{ route('projects.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="titolo">Titolo</label>
                <input type="text" class="form-control @error('titolo') is-invalid @enderror"
                 id="titolo"
                 name="titolo"
                 placeholder="Inserisci titolo"
                 value="{{old('titolo')}}" 
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
                        <option @selected( old('type_id') == $type->id ) value="{{ $type->id }}">{{ $type->nome }}</option>
                    @endforeach
                </select>
                @error('type_id')
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
                 placeholder="Inserisci cliente"
                 value="{{ old('cliente') }} "
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
                placeholder="https://..."
                value="{{ old('link') }} "
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
                placeholder="Descrizione"
                rows="3"
                >{{ old('descrizione') }}</textarea>
                <!-- genera errore sotto input -->
                @error('descrizione')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Invia</button>
        </form>

    </div>
@endsection