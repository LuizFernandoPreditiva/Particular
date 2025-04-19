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
            <h2>Natália Cabette Lanini Duarte</h2>
            <p>Psicologa.</p>
            <p>CRP-04/60423</p>
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
                    <a href="https://wa.me/+5532984058068?text=
                        Olá%20Natália,%20gostaria%20de%20agendar%20uma%20sessão%20Online%20com%20você!" 
                        class="btn-agendar btn-overlay" target="_blank">Agendar Sessão</a>
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
                    <a href="https://wa.me/+5532984058068?text=
                    Olá%20Natália,%20gostaria%20de%20agendar%20uma%20sessão%20Presencial%20com%20você!"
                    class="btn-agendar btn-overlay" target="_blank">Agendar Sessão</a>
                </div>
                <h2>Presencial</h2>
                <p>
                    Atendimento Presencial, em clinica propria com ambiente seguro e confortavel.
                </p>
            </div>
        </div>
    </section>

    <section class="cursos" id="cursos">
        <p class="title">Cursos disponiveis</p>
        <p class="subtitle">Cursos desenvolvidos por mim com foco em melhorias diretivas.</p>

        <div class="slider">
            <input checked id="slider-1" name="slider" type="radio">
            <!--<input id="slider-2" name="slider" type="radio">-->
            <div class="slider-area">
                <div class="slider-item">
                    <img src="{{ asset('images/Curso01.png') }}" alt="" />
                    <p class="name">Tomando as rédeas da sua vida de volta</p>
                    <p class="description">"Curso gravado para mulheres que desejam gerenciar seu tempo, com o objetivo de terem, minimamente, 7h de sobra na sua semana para fazerem o quiserem. Voltado para procrastinação, com técnicas, ferramentas e estratégias rápidas e funcionais, além de psicoeducação. Curso baseado na abordagem da psicologia TCC."</p>
                    <a href="https://hotmart.com/pt-br/marketplace/produtos/tomando-as-redeas-da-sua-vida-de-volta/F96705165Y" class="btn-agendar">Saiba mais</a>
                    <!--<p class="role"></p>-->
                </div>
                <!-- <div class="slider-item">
                    <img src="{/{ asset('images/online.png') }}" alt="" />
                    <p class="description">"Curso em gerenciamento de tempo voltado as mulhes"</p>
                    <p class="name">Gerenciamento de tempo</p>
                    <p class="role"></p>
                </div> -->
            </div>
            <!--<div class="slider-nav">
                <label class="n1" for="slider-1"></label>
                <label class="n2" for="slider-2"></label>
            </div>-->
        </div>
    </section>


    <section class="contato-section" id="contato">
        <h2>Meus Contatos:</h2>
        <div class="contato-wrapper">
            <div class="contato-content">
                <div class="contato-image">
                    <a href="https://wa.me/+5532984058068">
                        <img src="images/whatsapp_icon.png" alt="WhatsApp" title="WhatsApp"/>
                    </a>
                </div>
                <div class="contato-texto">
                    <p>WhatsApp: (32) 9 8405-8068</p>
                </div>
            </div>
            <div class="contato-content">
                <div class="contato-image">
                    <a href="https://www.instagram.com/nataliacabettepsi">
                        <img src="images/instagram_icon.png" alt="instagram" title="instagram"/>
                    </a>
                </div>
                <div class="contato-texto">
                    <p>Instagram: @nataliacabettepsi</p>
                </div>
            </div>
            <div class="contato-content">
                <div class="contato-image">
                    <a href="mailto:luiz.fernando@viannasempre.com.br">
                        <img src="images/email_icon.png" alt="email" title="email"/>
                    </a>
                </div>
                <div class="contato-texto">
                    <p>Email: nataliacabette@psicologiaweb.com.br</p>
                </div>
            </div>
        </div>
    </section>


@endsection
