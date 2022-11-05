@extends('layouts/layout-no-sidebar')

@section('content')

<section id="main" class="container medium">
    <header>
        <h2>Consultar Resultado</h2>
        <p>Confirme sua data de nascimento para visualizar o resultado do exame.</p>
    </header>
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" id="danger">
            {!! session('danger') !!}
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert" id="warning">
            {!! session('warning') !!}
        </div>
    @endif
    <div class="box">
        <form method="post" action="{{ route('resultados.confirmacao') }}">
            @csrf
            <div class="row gtr-50 gtr-uniform">
                <input type="hidden"/>
                <div class="col-12 col-12-mobilep">
                    <label for="birthdate">Data de Nascimento</label>
                    <input type="text" name="birthdate" class="date" id="birthdate" value="" placeholder="Ex: 20/03/1987" required>
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

@push('scripts')
<script src="/assets/js/jquery.mask.min.js"></script>
<script>
    $(".date").mask("99/99/9999");
</script>
@endpush