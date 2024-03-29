@extends('layouts/layout-no-sidebar')

@section('content')

<section id="main" class="container medium">
    <header>
        <h2>Consultar Resultado</h2>
        <p>Informe o código do exame e o seu prontuário.</p>
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
        <form method="post" action="{{ route('resultados.procurar') }}">
            @csrf
            <div class="row gtr-50 gtr-uniform">
                <div class="col-6 col-12-mobilep">
                    <label for="accession_number">Nº de Acesso</label>
                    <input type="text" name="accession_number" id="accession_number" value="{{old('accession_number', '')}}" placeholder="Ex: 09132184" required>
                </div>
                <div class="col-6 col-12-mobilep">
                    <label for="birthdate">Prontuário</label>
                    <input type="text" name="patient_id" id="patient_id" value="" placeholder="Ex: 694123" required>
                </div>
                <div class="col-12">
                    <ul class="actions special">
                        <li><input class="bt-primary" type="submit" value="Visualizar"></li>
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