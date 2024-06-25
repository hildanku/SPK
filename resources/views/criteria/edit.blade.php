@extends('_Layouts.master')

@section('content')
<section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Change data <strong>{{ $data->criteriaName }}</strong></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="/criteria/update/{{ $data->criteriaCode }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                    {{-- <div class="col-md-4">
                                        <label>Criteria Code</label>
                                    </div> --}}
                                    {{-- <div class="col-md-8 form-group">
                                        <input type="text" class="form-control" name="{{ $data->criteriaCode }}" placeholder="{{ $data->criteriaCode }}" disabled>
                                    </div> --}}
                                    <input type="hidden" name="criteriaCode" value="{{ $data->criteriaCode }}">
                                    <input type="hidden" name="criteriaName" value="{{ $data->criteriaName }}">
                                    <input type="hidden" name="criteriaDesc" value="{{ $data->criteriaDesc }}">

                                    <div class="col-md-4">
                                        <label>Criteria Weight</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="criteriaWeight" placeholder="{{ $data->criteriaWeight }}">
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