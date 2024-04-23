@extends('layouts.services.layout')

@section('title', 'Our Services')

@section('content')
    <h1 class="heading">Услугите които предлагаме</h1>
    <table class="services-table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Web Development</td>
                <td>Complete web design and development services.</td>
                <td>$1000</td>
            </tr>
            <tr>
                <td>SEO Optimization</td>
                <td>Improve your site's visibility with our SEO services.</td>
                <td>$800</td>
            </tr>
            <tr>
                <td>Technical Support</td>
                <td>24/7 support for all your technical needs.</td>
                <td>$500</td>
            </tr>
        </tbody>
    </table>
@endsection
