@extends('layouts/layout-no-sidebar')

@section('content')

<section id="banner">
    <h2>Sir Diagnóstico</h2>
    <p>Compromisso com a sua saúde há mais de 25 anos.</p>
    <ul class="actions special">
        <li><a href="{{ route('resultados') }}" class="button primary">Resultados</a></li>
        <li><a class="button go-to-unidades" href="#unidades-top">Unidades</a></li>
    </ul>
</section>

<section id="main" class="container">

    <section class="box special">
        <header class="major">
            <h2>Variedade de diagnósticos e equipamentos
            <br />
            avançados para atender você e sua família.</h2>
            <p>O SIR Diagnóstico realiza diagnósticos por imagem com qualidade e segurança, utilizando equipamentos de alta tecnologia e profissionais experientes. Os exames são indolores e possuem baixa exposição à radiação. Em caso de dúvida, consulte o seu médico</p>
        </header>
    </section>

    <header class="align-center">
        <h2>Exames</h2>
        <p>Saiba mais sobre todos os tipos de exames que realizamos</p>
    </header>
    <section id="exames" class="box special features">
        <div class="features-row">
            <section>
                <span class="icon solid major fa-check accent6"></span>
                <h3>Raio-x</h3>
                <p>É um tipo de exame muito importante no diagnóstico de várias <strong>alterações vasculares</strong>, <strong>fraturas</strong> e <strong>vários tipos de alterações da coluna vertebral</strong>.</p>
            </section>
            <section>
                <span class="icon solid major fa-check accent6"></span>
                <h3>Tomografia Computadorizada</h3>
                <p>É mais usada para identificar <strong>tumores</strong>, <strong>alterações vasculares</strong>, <strong>fraturas</strong>, <strong>alterações orgânicas</strong> e <strong>outras anomalias teciduais</strong>, além de ser também muito eficiente a sua atuação no cérebro humano.</p>
            </section>
        </div>
        <div class="features-row">
            <section>
                <span class="icon solid major fa-check accent6"></span>
                <h3>Ressonância Magnética</h3>
                <p>Indicado para identificar <strong>lesões cerebrais</strong>, <strong>hérnias de disco e outras alterações da coluna vertebral</strong>. Também auxilia no diagnóstico dos diversos tipos de <strong>lesões das articulações</strong>, principalmente dos <strong>ombros e dos joelhos</strong>. Tem importância na captação de imagens para qualquer parte do corpo. Dependendo do objetivo do exame o paciente pode escutar sons, ver filmes, sentir odores, apertar botões, realizar tarefas cognitivas ou fazer outras coisas. Produz imagens de alta definição de qualquer parte do corpo humano</p>
            </section>
            <section>
                <span class="icon solid major fa-check accent6"></span>
                <h3>Densitometria Óssea</h3>
                <p>É o exame feito para diagnosticar a <strong>Osteoporose</strong> e a <strong>Osteopenia</strong>. É recomendada para mulheres acima de 65 anos, homens acima de 70 anos, mulheres na <strong>pós-menopausa</strong>, pacientes com doenças da <strong>tireoide</strong>, pessoas que possuem<strong> fratura</strong> e osteoporose no histórico familiar, fumantes, sedentários, pacientes com <strong>doenças reumáticas</strong>, <strong>cálculo renal</strong> e <strong>doença gastrointestinal</strong>.</p>
            </section>
        </div>
        <div class="features-row d-flex justify-content-center">
            <section style="padding: 3em 0;">
                <span class="icon solid major fa-check accent6"></span>
                <h3>Ultra-sonografia</h3>
                <p>é um exame que serve para observar e detectar alterações na estrutura anatômica e no<strong> funcionamento dos órgãos</strong>, para <strong>diagnosticar gravidez</strong>, avaliar o<strong> desenvolvimento do feto</strong>, diagnosticar <strong>doenças do útero</strong>, <strong>trompa</strong> e <strong>ovários</strong>.</p>
            </section>
        </div>
    </section>

    <header id="unidades-top" class="align-center">
        <h2>Unidades</h2>
        <p>Escolha a unidade mais próxima de você. Para ficar mais fácil de chegar, em um clique você pode ir direto para o Waze ou pedir um Uber.</p>
    </header>
    <section id="unidades">
        <div class="row">
            <div class="col-12 col-12-narrower">

                <section class="box special">
                    <h3>Rua Guilherme Pinto 100, Graças, Recife - PE</h3>
                    <p></p>
                    <div class="map-responsive">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.4891599922303!2d-34.904538385220235!3d-8.051481594202587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18e114fdd459%3A0x756a6862175393a0!2sR.%20Guilherme%20Pinto%2C%20100%20-%20Gra%C3%A7as%2C%20Recife%20-%20PE%2C%2052011-210!5e0!3m2!1spt-BR!2sbr!4v1646967431935!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <ul class="actions special">
                        <li><a class="button bt-blue" href="https://ul.waze.com/ul?preview_venue_id=213059255.2130592555.15474029&navigate=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location">Ir no Waze</a></li>
                        <li><a class="button bt-black" href="https://m.uber.com/ul/?action=setPickup&dropoff[latitude]=-8.051210705632553&dropoff[longitude]=-34.90235506720347&dropoff[nickname]=Sir%20Diagnostico&dropoff[formatted_address]=Rua%20Guilherme%20Pinto%20100%20Gracas%20Recife%20Pernambuco%2094133&product_id=a1111c8c-c720-46c3-8534-2fcdd730040d">Pedir Uber</a></li>
                    </ul>
                </section>

            </div>
            <div class="col-12 col-12-narrower">

                <section class="box special">
                    <h3>Rua das Pernambucanas 244, Graças, Recife - PE</h3>
                    <p></p>
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.4970968618536!2d-34.903439585220404!3d-8.05066779420318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18e153a26537%3A0xed27a470a0b5fcdf!2sR.%20das%20Pernambucanas%2C%20244%20-%20Gra%C3%A7as%2C%20Recife%20-%20PE%2C%2052011-010!5e0!3m2!1spt-BR!2sbr!4v1646967028721!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <ul class="actions special">
                        <li><a class="button bt-blue" href="#">Ir no Waze</a></li>
                        <li><a class="button bt-black" href="https://m.uber.com/ul/?action=setPickup&dropoff[latitude]=-8.050407528194844&dropoff[longitude]=-34.90122408069725&dropoff[nickname]=Sir%20Diagnostico&dropoff[formatted_address]=Rua%20das%20Pernambucanas%20244%20Gracas%20Recife%20Pernambuco%2094133&product_id=a1111c8c-c720-46c3-8534-2fcdd730040d">Pedir Uber</a></li>
                    </ul>
                </section>

            </div>

            <div class="col-12 col-12-narrower">

                <section class="box special">
                    <h3>Rua Monsenhor Ambrosino Leite 68, Graças, Recife - PE</h3>
                    <p></p>
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d802.4349717558554!2d-34.902080597040616!3d-8.05123142958045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18e136106aa9%3A0x8e9431035d19717e!2sR.%20Monsenhor%20Ambrosino%20Leite%2C%2068%20-%20Gra%C3%A7as%2C%20Recife%20-%20PE%2C%2052011-230!5e0!3m2!1spt-BR!2sbr!4v1647045658571!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <ul class="actions special">
                        <li><a class="button bt-blue" href="https://ul.waze.com/ul?ll=-8.05128364%2C-34.90145087&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location">Ir no Waze</a></li>
                        <li><a class="button bt-black" href="https://m.uber.com/ul/?action=setPickup&dropoff[latitude]=-8.051258990284689&dropoff[longitude]=-34.90140184498042&dropoff[nickname]=Sir%20Diagnostico&dropoff[formatted_address]=1%20Rua%20Monsenhor%20Ambrosino%20Leite%2068%20Gracas%20Recife%20Pernambuco&product_id=a1111c8c-c720-46c3-8534-2fcdd730040d">Pedir Uber</a></li>
                    </ul>
                </section>

            </div>
        </div>
    </section>

</section>

<section id="cta">

    <h2>Atendimento</h2>
    <p>Ligue agora para a nossa central ou fale conosco no WhatsApp</p>

    <div class="row gtr-50 gtr-uniform">
        <div class="col-12 col-12-mobilep">
            <a href="https://api.whatsapp.com/send?phone=8134451220" class="button mw-220">Chamar no WhatsApp</a>
        </div>
        <div class="col-12 col-12-mobilep">
            <a href="tel:558134451220" class="button mw-220">Ligar agora</a>
        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
$("#go-to-quem-somos").on("click", function() {
    $('html, body').animate({
        scrollTop: $("#main").offset().top
    }, 2000);
});

$(".go-to-unidades").on("click", function() {
    $('html, body').animate({
        scrollTop: $("#unidades-top").offset().top
    }, 2000);
});

$("#go-to-atendimento").on("click", function() {
    $('html, body').animate({
        scrollTop: $("#cta").offset().top
    }, 2000);
});
</script>
@endpush
