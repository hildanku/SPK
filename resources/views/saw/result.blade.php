@extends('_Layouts.master')

@section('content')
<section class="section">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Hasil Kalkulasi</h4>
              </div>
                <div class="table-responsive">
                    <table class='table mb-0' id="table1">
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
        </div>
    </div>
</section>
<section class="section">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Hasil Perangkingan</h4>
              </div>
                <div class="table-responsive">
                    <table class='table mb-0' id="table1">
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
            </div>
        </div>
    </div>
</section>
@endsection