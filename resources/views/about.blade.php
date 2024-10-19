@extends('layouts.main')

@section('container')

    <h1>About Me</h1>
    <p>Nama saya {{ $name }}</p>
    <p>Email {{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200">   
    
@endsection
