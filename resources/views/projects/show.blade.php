@extends('layouts.app')

@section('content')
@if(request()->session()->exists('message'))

<div class="alert alert-primary" role="alert">
    {{ request()->session()->pull('message') }}
</div>
@endif
<div class="container py-5">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h1>{{ $project->titolo }}</h1>
                <h4>Type: {{ $project->type ? $project->type->nome : '/' }}</h4>
            </div>

            <div>
                <a class="btn btn-sm btn-primary" href="{{ route('projects.edit',$project) }}">Modifica</a>
                @if($project->trashed())
                    <form action="{{ route('projects.restore',$project) }}" method="POST">
                      @csrf
                      <input class="btn btn-sm btn-success" type="submit" value="Ripristina">
                    </form>
                @endif
            </div>

        </div>
    </div>
    <div class="container">
        <div class="descrioption">
            <h5>Descrizione progetto: </h5>
            <p>{{ $project->descrizione }}</p>
        </div>
        <div class="client">
            <h5>Cliente: </h5>
            <p>{{ $project->cliente }}</p>
        </div>
    </div>
@endsection