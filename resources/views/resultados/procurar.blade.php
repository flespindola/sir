@extends('layouts/layout-no-sidebar')

@section('content')

<section id="main" class="container medium">
    <header>
        <h2>Consultar Resultado</h2>
        <p>Informe o código do exame e sua data de nascimento.</p>
    </header>
    <div class="box">
        <form method="post" action="{{ route('resultados.procurar') }}">
            @csrf
            <div class="row gtr-50 gtr-uniform">
                <div class="col-6 col-12-mobilep">
                    <label for="accession_number">Código do Exame</label>
                    <input type="text" name="accession_number" id="accession_number" value="{{old('accession_number', '')}}" placeholder="Ex: 09132184" required>
                </div>
                <div class="col-6 col-12-mobilep">
                    <label for="birthdate">Data de Nascimento</label>
                    <input type="text" name="birthdate" id="birthdate" value="" placeholder="Ex: 20/03/1987" required>
                </div>
                <div class="col-12">
                    <ul class="actions special">
                        <li><input class="bt-primary" type="submit" value="Enviar"></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
