@extends('agent.agent_dashboard')
@section('agent')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Transactions</a></li>
		<li class="breadcrumb-item active" aria-current="page">Transactions List</li>
	  </ol>
	</nav>


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
					  <th>Updated At</th>
					</tr>
				  </thead>
				  <tbody>
					@php
						$totalPrice = 0;
					@endphp
					@foreach ($transactions as $transaction)
						@php
							$totalPrice += $transaction->amount;
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
					<tr>
						<td colspan="4">Total Amount</td>
						<td class="text-end">{{ number_format($totalPrice) }}</td>
						<td colspan="3"></td>
					</tr>
				  </tbody>
				</table>
			  </div>
			  <div class="mt-3">
				{{ $transactions->appends(Request::except('page'))->links() }}
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	


</div>	  
	
@endsection