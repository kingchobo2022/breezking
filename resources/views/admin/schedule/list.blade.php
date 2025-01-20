@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Schedule</a></li>
		<li class="breadcrumb-item active" aria-current="page">Schedule List</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Schedule List</h4>
				<div class="d-flex align-items-center">
				  <a href="{{ url('admin/schedule/add') }}" class="btn btn-primary">Add Schedule</a>
				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>Week</th>
					  <th>Open/Close</th>
					  <th>Start Time</th>
					  <th>End Time</th>
					</tr>
				  </thead>
				  <tbody>

					@foreach ($weeks as $week)	
						@php
							$getuserweek = App\Models\UserTime::getDetail($week->id);
							$open_close = !empty($getuserweek->status) ? 'checked' : '';
							$start_time = !empty($getuserweek->start_time) ? $getuserweek->start_time : '';
							$end_time   = !empty($getuserweek->end_time) ? $getuserweek->end_time : '';

						@endphp
					<tr class="table-info text-dark">
					  <td>{{ $week->name }}</td>
					  <td>
							<input type="hidden" value="{{ $week->id }}" name="week[{{ $week->id }}][week_id]">							
						<label class="switch">
							<input type="checkbox" name="week">
						</label>
					  </td>
					  <td>
						<select name="week[{{ $week->id }}][start_time]" class="form-control" style="{{ $open_close == 'checked' ? '' : 'display:none'}}">
							@foreach ($weektimes as $weektime)
								<option value="{{ $weektime->id }}">{{ $weektime->name }}</option>
							@endforeach
						</select>
					  </td>
					  <td>
						<select name="week[{{ $week->id }}][end_time]" class="form-control" style="{{ $open_close == 'checked' ? '' : 'display:none'}}">
							@foreach ($weektimes as $weektime)
								<option value="{{ $weektime->id }}">{{ $weektime->name }}</option>
							@endforeach
						</select>
					  </td>
					  <td>
						<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/schedule/edit/') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">수정</span></a>
						<a class="dropdown-item d-flex align-items-center" href="{{ url('admin/schedule/delete/') }}" onclick="return confirm('삭제하시겠습니까?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">삭제</span></a>                    
					  </td>
					</tr>
					@endforeach	
					
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
				{{-- pagination --}}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection