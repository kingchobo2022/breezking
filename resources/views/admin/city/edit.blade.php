@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/city') }}">City</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit City</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Edit City</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/city/edit/'. $city->id) }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Countries Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="countries_id" id="country" class="form-control" required>
                  <option value="">Select Countries Name</option>
                  @foreach ($countries as $country)
                      <option value="{{ $country->id }}" {{ ($country->id == $city->countries_id) ? 'selected' : '' }}>{{ $country->country_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">State Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                  <select name="state_id" id="state" class="form-control" required>
                    <option value="">Select State Name</option>
                    @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ ($state->id == $city->state_id) ? 'selected' : '' }}>{{ $state->state_name }}</option>    
                    @endforeach
                  </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">City Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="city_name" value="{{ $city->city_name }}" class="form-control" placeholder="City Name" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/city') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
<script>
  const country = document.getElementById('country');
  country.addEventListener('change', function(){
    const countryId = this.value;
    const stateSelect = document.getElementById('state');

    const url = "{{ url('admin/get-states-name') }}" + "/" + countryId;

    fetch(url)
      .then(response => response.json())
      .then( data => {
        stateSelect.innerHTML = '<option value="">Select State Name</option>';
        data.forEach(item => {
          const option = document.createElement('option');
          option.value = item.id;
          option.textContent = item.state_name;
          stateSelect.appendChild(option);
          // stateSelect.innerHTML += '<option value="' + item.id + '">' + item.state_name + '</option>';
        });
      })
      .catch(error => console.error('Error fetching data: ', error));
    
  });
</script>    
@endsection

