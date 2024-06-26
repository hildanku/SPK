@extends('_Layouts.master')


@section('content')
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Food Data - {{ $data->foodName }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="/food/update/{{ $data->foodId }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Food Name</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" class="form-control" name="foodName" value="{{ $data->foodName }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Food Description</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <textarea class="form-control" name="foodDesc" required>{{ $data->foodDesc }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Food Taste Rating</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="foodTasteRating" value="{{ $data->foodTasteRating }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Food Risk Disease Rating</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="foodRiskRating" value="{{ $data->foodRiskRating }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Food Age Suitability</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="foodAgeRating" value="{{ $data->foodAgeRating }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Food Price</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="foodPriceRating" value="{{ $data->foodPriceRating }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Food Distance</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="foodDistanceRating" value="{{ $data->foodDistanceRating }}" required>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection