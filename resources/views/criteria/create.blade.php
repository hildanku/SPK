@extends('_Layouts.master')

@section('content')
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create New Criteria</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form form-horizontal" method="POST" action="/criteria/store">
              @csrf
              <div class="form-body">
                <div class="row">
                  <div class="col-md-4">
                    <label for="criteriaCode">Criteria Code</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="text" class="form-control" id="criteriaCode" name="criteriaCode" placeholder="Enter Criteria Code" required>
                  </div>
                  <div class="col-md-4">
                    <label for="criteriaName">Criteria Name</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="text" class="form-control" id="criteriaName" name="criteriaName" placeholder="Enter Criteria Name" required>
                  </div>
                  <div class="col-md-4">
                    <label for="criteriaDesc">Criteria Description</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <textarea class="form-control" id="criteriaDesc" name="criteriaDesc" rows="3" placeholder="Describe the Criteria" required></textarea>
                  </div>
                  <div class="col-md-4">
                    <label for="criteriaWeight">Criteria Weight</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="number" class="form-control" id="criteriaWeight" name="criteriaWeight" placeholder="Enter Weight" required>
                  </div>
                  <div class="col-md-4">
                    <label for="criteriaType">Criteria Type</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <select class="form-select" id="criteriaType" name="criteriaType" required>
                      <option value="benefit">Benefit</option>
                      <option value="cost">Cost</option>
                    </select>
                  </div>
                  <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Create Criteria</button>
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
