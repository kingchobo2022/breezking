@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/city') }}">Reply</a></li>
      <li class="breadcrumb-item active" aria-current="page">Support Reply</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Support Reply</h6>

          <div class="content-frame-body content-frame-body-left w-100">
            <div class="messages messages-img">
                <div class="item in">
                    <div class="text">
                        <div class="heading">
                            <a href="#">Hello</a>
                            <span class="date">2020-11-11</span>
                        </div>
                        <div>
                            <strong>Title: </strong> Title <br>
                            <strong>Description: </strong> Welcome
                        </div>
                    </div>
                </div>

                <div class="item">
                  <div class="text">
                    <div class="heading">
                      <a href="#">Hello</a>
                      <span class="date">YYYY-mm-dd</span>
                    </div>
                    Good work  
                  </div>
                </div>
               
                <div class="item in">
                  <div class="text">
                    <div class="heading">
                      <a href="#">Hello</a>
                      <span class="date">YYYY-mm-dd</span>
                    </div>
                    Good work  
                  </div>
                </div>

            </div>

            <div class="panel panel-default push-up-10">
                <div class="panel-body panel-body-search">
                  <form action="" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="input-group">
                      <div class="btn btn-default">Reply Message</div>
                      <input type="text" name="description" class="form-control" placeholder="Your message" required>
                      <div class="input-group-btn">
                        <button class="btn btn-success" type="submit">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>

          </div>

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

