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

    <section class="sobre-profissional" id="sobre">

        <div class="info-basica"> <!-- Texto informativo fora da div com borda -->   
            <h2>Natalia Cabette Lanini Duarte</h2>
            <p>Psicologa.</p>
            <p>CRP: 00/00000</p>
        </div>

        <div class="container-sobre">
            <div class="descricao">
                <p>
                    Com vasta experiência em psicanálise, a profissional atua com foco no acolhimento
                    humano, ética e escuta ativa. Seu trabalho é pautado em evidências e conexão empática.
                </p>
                <p>
                    Com vasta experiência em psicanálise, a profissional atua com foco no acolhimento
                    humano, ética e escuta ativa. Seu trabalho é pautado em evidências e conexão empática.
                </p>
                <p>
                    Com vasta experiência em psicanálise, a profissional atua com foco no acolhimento
                    humano, ética e escuta ativa. Seu trabalho é pautado em evidências e conexão empática.
                </p>
            </div>
      
            <!-- Imagem ao lado -->
            <img src="{{ asset('images/Profissional.png') }}" alt="Natalia Cabette Lanini Duarte" class="foto-profissional" title="Natalia Cabette Lanini Duarte">
      
        </div>
      </section>

      <section class="atendimento" id="atendimento">
        <div class="atendimento-container">
            <div class="atendimento-card">
                <div class="img-wrapper">
                    <img src="{{ asset('images/online.png') }}" alt="On-line" title="On-line">
                    <a href="#" class="btn-agendar btn-overlay">Agendar Sessão</a>
                </div>
                <h2>Online</h2>
                <p>
                    Atendimento On-line, feito em um ambiente seguro e sigiloso, com toda segurança ao
                    paciente e psicologo.
                </p>
            </div>
            <div class="atendimento-card">
                <div class="img-wrapper">
                    <img src="{{ asset('images/presencial.png') }}" alt="Presencial" title="Presencial">
                    <a href="#" class="btn-agendar btn-overlay">Agendar Sessão</a>
                </div>
                <h2>Presencial</h2>
                <p>
                    Atendimento Presencial, em clinica propria com ambiente seguro e confortavel.
                </p>
            </div>
        </div>
    </section>


@endsection
