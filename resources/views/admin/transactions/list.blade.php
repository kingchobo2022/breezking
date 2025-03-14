@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Transactions</a></li>
		<li class="breadcrumb-item active" aria-current="page">Transactions List</li>
	  </ol>
	</nav>

	<div class="row mb-2">
		<div class="col-lg-12 stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Search Transactions</h6>
					<form action="" method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="mb-3">
									<label for="" class="form-label">Id</label>
									<input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter id">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">User Name</label>
									<input type="text" name="user_name" value="{{ Request()->user_name }}" class="form-control" placeholder="Enter User Name">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="mb-3">
									<label for="" class="form-label">Transaction Status</label>
									<select name="is_payment" class="form-select">
										<option value="">Select Payment Status</option>
										<option value="1" {{ Request()->is_payment == '1' ? 'selected' : '' }}>Completed</option>
										<option value="0" {{ Request()->is_payment == '0' ? 'selected' : '' }}>Pending</option>
									</select>
								</div>
							</div>

						</div>
						<button type="submit" class="btn btn-primary me-1">Search</button>
						<a href="{{ url('admin/transactions') }}" class="btn btn-danger">Reset</a>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-12 stretch-card">
		  <div class="card">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center flex-wrap">
				<h4 class="card-title">Transactions List</h4>
				<div class="d-flex align-items-center">

				</div>
			  </div>
			  
	
			  <div class="table-responsive pt-3">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th>ID</th>
					  <th>User Name</th>
					  <th>Order Number</th>
					  <th>Transaction ID</th>
					  <th>Amount</th>
					  <th>Payment Status</th>
					  <th>Created At</th>
					  <th>updated_at</th>
					</tr>
				  </thead>
				  <tbody>
					@php
						$totalPrice = 0;
					@endphp
					@foreach ($transactions as $transaction)
						@php
							$totalPrice = $totalPrice + $transaction->amount;
						@endphp
					<tr>
						<td>{{ $transaction->id }}</td>
						<td>{{ $transaction->name }}</td>
						<td>{{ $transaction->order_number }}</td>
						<td>{{ $transaction->transaction_id }}</td>
						<td class="text-end">{{ number_format($transaction->amount) }}</td>
						<td class="text-center">
							@if ($transaction->is_payment)
								<span class="badge bg-info">Completed</span>
							@else	
								<span class="badge bg-danger">Pending</span>
							@endif

						</td>
						<td>{{ $transaction->created_at }}</td>
						<td>{{ $transaction->updated_at }}</td>
					</tr>
					@endforeach  

					@if ($totalPrice)
					<tr>
						<th colspan="4" class="text-end">Total Amount</th>
						<th class="text-end">{{ number_format($totalPrice) }}</th>
						<th colspan="4"></th>
					</tr>	
					@endif
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
@endsection