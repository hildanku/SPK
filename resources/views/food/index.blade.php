@extends('_Layouts.master')

@section('content')
<section class="section">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Manage Foods</h4>
        <div class="d-flex">
          <a href="/food/create" class="btn btn-primary"> Create Food </a>
        </div>
      </div>
      <div class="card-body px-0 pb-0">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="table-responsive">
          <table class='table mb-0' id="table1">
            <thead>
              <tr>
                <th>Food Name</th>
                <th>Food Description</th>
                <th>Taste Rating</th>
                <th>Risk Disease Rating</th>
                <th>Age Suitability</th>
                <th>Sawn</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datas as $data)
              <tr>
                <td>{{ $data->foodName }}</td>
                <td>{{ $data->foodDesc }}</td>
                <td>{{ $data->foodTasteRating }}</td>
                <td>{{ $data->foodRiskRating }}</td>
                <td>{{ $data->foodAgeRating }}</td>
                <td id="saw-score-{{ $data->foodId }}"> - </td> <td>
                <td>
                  <a class="btn btn-primary" href="/food/edit/{{ $data->foodId }}">Edit</a>
                  <a class="btn btn-danger" href="/food/delete/{{ $data->foodId }}">Delete</a>
                  <button type="button" class="btn btn-danger btn-sm delete-btn" data-food-id="{{ $data->foodId }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->foodId }}">
                    Delete
                  </button>
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

<!-- Modal -->
@foreach ($datas as $data)
<div class="modal fade" id="deleteModal{{ $data->foodId }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->foodId }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel{{ $data->foodId }}">Delete Food</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <strong>{{ $data->foodName }}</strong>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm{{ $data->foodId }}" action="/food/delete/{{ $data->foodId }}" method="POST">
          @csrf
          @method('POST')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $('.delete-btn').click(function() {
          var foodId = $(this).data('food-id');
          var foodName = $(this).closest('tr').find('td:first').text().trim(); // Get food name from the first td of the current row
          $('#deleteModalLabel' + foodId).text('Delete Food');
          $('#deleteModal' + foodId).modal('show');
      });

      // Function to calculate SAW
      function calculateSAW() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              url: '/food/calculateSAW',
              method: 'POST',
              dataType: 'json',
              success: function(response) {
                  if (response.scores) {
                      // Loop through each food data and update SAW score cell
                      $('tbody tr').each(function(index, row) {
                          const foodId = $(row).data('food-id'); // Assuming food ID is stored as data attribute
                          const sawScore = response.scores[foodId];
                          if (sawScore !== undefined) {
                              $(row).find('#saw-score-' + foodId).text(sawScore.toFixed(2)); // Display score with 2 decimal places
                          }
                      });
                  } else {
                      alert('Error calculating SAW scores!');
                  }
              },
              error: function(xhr, status, error) {
                  alert('Failed to fetch SAW scores: ' + error);
              }
          });
      }

      // Call calculate SAW on page load
      calculateSAW();
  });
</script>
@endsection
