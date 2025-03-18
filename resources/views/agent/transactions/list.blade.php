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
					  <th>Action</th>
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
						<td><button class="btn btn-danger btn-sm btn-delete" data-id="{{ $transaction->id }}">Delete</button></td>

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

<form method="post" name="delform" action="{{ url('agent/transactions/destroy') }}">
	@csrf
	@method('DELETE')
	<input type="hidden" name="id">
</form>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
<script>
document.querySelectorAll(".btn-delete").forEach(function(button){
	button.addEventListener("click", function() {
		Swal.fire({
			title: "Are you sure?",
			text: "Yon won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!"
		}).then((result) => {
			if (result.isConfirmed) {
				const f = document.delform;
				f.id.value = this.dataset.id;
				f.submit();
			}
		});
	});
});	
</script>
@endsection

