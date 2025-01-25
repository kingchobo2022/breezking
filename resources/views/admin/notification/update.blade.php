@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  @include('inc_message')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">Notification</a></li>
      <li class="breadcrumb-item active" aria-current="page">Push notification</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">push notification</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/notification_send') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Name <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <select name="user_id" class="form-control">
					<option value="">Select User</option>
					@foreach ($users as $user)
						<option value="{{ $user->id }}">{{ $user->name  }} {{ $user->username }} ( {{ $user->role }} )</option>
					@endforeach
				</select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Title <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="title" value="" class="form-control" autocomplete="off" placeholder="title" required>

                <span style="color: red;">{{ $errors->first('title') }}</span>

              </div>
            </div>
            <div class="row mb-3">
				<label class="col-sm-3 col-form-label">Message <span style="color: red"> *</span></label>
				<div class="col-sm-9">
					<textarea name="message" class="form-control" placeholder="Message" required></textarea>
				</div>
			  </div>
  
            <button type="submit" class="btn btn-primary me-2">Update</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection