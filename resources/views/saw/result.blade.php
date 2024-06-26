@extends('_Layouts.master')

@section('content')
<div class="container">
    <h2>Hasil Perankingan Alternatif Menggunakan Metode SAW</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach ($criterias as $criteria)
                <th>{{ $criteria->criteriaName }}</th>
                @endforeach
                <th>Nilai Vi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankedFoods as $rank => $food)
            <tr>
                <td>{{ $food->foodName }}</td>
                @foreach ($criterias as $criteria)
                <td>{{ $food->{'food' . ucfirst($criteria->criteriaCode) . 'Rating'} }}</td>
                @endforeach
                <td>{{ $weightedSum[$rank] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <h3>Ranking</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Alternatif</th>
                <th>Nilai Vi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankedFoods as $rank => $food)
            <tr>
                <td>{{ $rank + 1 }}</td>
                <td>{{ $food->foodName }}</td>
                <td>{{ $weightedSum[$rank] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection