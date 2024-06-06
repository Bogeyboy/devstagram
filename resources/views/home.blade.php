@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')

    <x-ListarPost :posts="$posts"/>

@endsection