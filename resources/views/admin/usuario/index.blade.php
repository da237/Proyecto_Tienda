@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuarios</div>
                    <div class="card-body">
                        {{-- <a  class="btn btn-warning" href="{{route('usuarios.create')}}">Nuevo</a> --}}
                        @verbatim
                            <example-component></example-component>
                        @endverbatim
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
