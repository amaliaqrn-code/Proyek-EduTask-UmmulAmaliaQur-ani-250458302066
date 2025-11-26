@extends('mahasiswa.layout')

@section('mahasiswa-content')
    <livewire:mahasiswa.assignment-detail :id="$assignment->id" />
@endsection
