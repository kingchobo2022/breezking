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
                            <a href="#">{{ $support->user->name }}</a>
                            <span class="date">{{ $support->created_at }}</span>
                        </div>
                        <div>
                            <strong>Title: </strong> {{ $support->title }} <br>
                            <strong>Description: </strong> {{ $support->description }}
                        </div>
                    </div>
                </div>

                @foreach($support->getSupportReply as $reply)

                @if(Auth::user()->id == $reply->user_id)
                <div class="item">
                  <div class="text">
                    <div class="heading">
                      <a href="#">{{ $reply->user->name }}</a>
                      <span class="date">{{ $reply->created_at }}</span>
                    </div>
                    {{ $reply->description }}
                  </div>
                </div>
               @else
                <div class="item in">
                  <div class="text">
                    <div class="heading">
                    <a href="#">{{ $reply->user->name }}</a>
                      <span class="date">{{ $reply->created_at }}</span>
                    </div>
                    {{ $reply->description }}
                  </div>
                </div>
                @endif
                
                @endforeach
            </div>
            @if($support->status == '0') 
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
            @endif
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

