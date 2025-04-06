@extends('layouts.principal')

@section('header')
    <x-headerDeslogado></x-headerDeslogado>
@endsection

@section('main')

    <section class="info-section" id="home">
        <div class="info-content">
            <div class="info-image">
                <img src="{{ asset('images/info-mhanational.png') }}" alt="Limbic System" title="Limbic System">
            </div>
            <div class="info-texto">
                <h2>Abordagem TCC:</h2>
                <p>
                    A Terapia Cognitivo-Comportamental (TCC) é uma abordagem psicoterapêutica focada na 
                    identificação e modificação de pensamentos, emoções e comportamentos disfuncionais. 
                    Seu principal objetivo é ajudar o paciente a desenvolver estratégias 
                    práticas para lidar com problemas emocionais e comportamentais.
                </p>
                <p>A TCC é baseada na colaboração entre o terapeuta e o paciente.</p>
                <p>
                    <strong>Ciência por trás da terapia</strong><br>
                    Fonte: <a href="https://www.mhanational.org/science-behind-therapy" target="_blank">www.mhanational.org</a>
                </p>
            </div>
        </div>
    </section>

    <div class="sobre">
        <p>Sobre</p>
        <br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>
    </div>

    <div class="contato">
        <p>Contato</p>
        <br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>
    </div>


@endsection
