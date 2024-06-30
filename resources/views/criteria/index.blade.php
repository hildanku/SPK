@extends('_Layouts.master')

@section('content')
<section class="section">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Manage Criterias</h4>
                    <div class="d-flex ">
                         <a href="/criteria/create" class="btn btn-primary"> Create n</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class='table mb-0' id="table1">
                            <thead>
                                <tr>
                                    <th>Criteria Code</th>
                                    <th>Criteria Name</th>
                                    <th>Criteria Description</th>
                                    <th>Criteria Weight</th>
                                    <th>Criteria Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->criteriaCode }}</td>
                                    <td>{{ $data->criteriaName }}</td>
                                    <td>{{ $data->criteriaDesc }}</td>
                                    <td>{{ $data->criteriaWeight }}</td>
                                    <td>{{ $data->criteriaType }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="/criteria/{{ $data->criteriaCode }}">Edit</a>
                                        <a class="btn btn-danger" href="/criteria/delete/{{ $data->criteriaCode }}">Delete</a>
                                    </td>
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