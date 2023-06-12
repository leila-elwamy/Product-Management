{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un produit</h2>

        <product-form></product-form>
    </div>
@endsection --}}


@extends('layouts.app')


    <div class="container">
        <h2>Ajouter un produit</h2>
        <product-form></product-form>
    </div>


@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
