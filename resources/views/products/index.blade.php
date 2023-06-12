@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des produits</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Taille</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->size }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
