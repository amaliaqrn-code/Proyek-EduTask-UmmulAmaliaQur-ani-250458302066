@extends('mahasiswa.layout')

@section('mahasiswa-content')
    <livewire:mahasiswa.course-detail :course="$course" />
@endsection
