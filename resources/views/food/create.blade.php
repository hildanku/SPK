@extends('_Layouts.master')

@section('content')
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create New Food</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form form-horizontal" method="POST" action="/food/store">
              @csrf
              <div class="form-body">
                <div class="row">
                  <div class="col-md-4">
                    <label for="foodName">Food Name</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="text" class="form-control" id="foodName" name="foodName" placeholder="Enter Food Name" required>
                  </div>
                  <div class="col-md-4">
                    <label for="foodDesc">Food Description</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <textarea class="form-control" id="foodDesc" name="foodDesc" rows="3" placeholder="Describe the Food" required></textarea>
                  </div>
                  <div class="col-md-4">
                    <label for="foodTasteRating">Taste Rating </label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="number" class="form-control" id="foodTasteRating" name="foodTasteRating" placeholder="Enter Rating" required>
                  </div>
                  <div class="col-md-4">
                    <label for="foodRiskDiseaseRating">Risk of Disease Rating</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="number"class="form-control" id="foodRiskRating" name="foodRiskRating" placeholder="Enter Rating" required>
                  </div>
                  <div class="col-md-4">
                    <label for="foodAgeSuitability">Age Suitability</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="text" class="form-control" id="foodAgeRating" name="foodAgeRating" placeholder="E.g., All Ages, Adults Only" required>
                  </div>
                  <div class="col-md-4">
                    <label for="foodPrice">Price</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="number" min="0" class="form-control" id="foodPriceRating" name="foodPriceRating" placeholder="Enter Price" required>
                  </div>
                  <div class="col-md-4">
                    <label for="foodDistance">Distance (in meters)</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="number" min="0" class="form-control" id="foodDistanceRating" name="foodDistanceRating" placeholder="Enter Distance" required>
                  </div>
                  <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Create Food</button>
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