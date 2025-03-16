@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	@include('inc_message')
	<nav class="page-breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('admin/transactions') }}">Transactions</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Transactions</li>
	  </ol>
	</nav>
	<div class="row">
	  <div class="col-md-12 grid-margin stretch-card">
		<div class="card">
		  <div class="card-body">
  
			<h6 class="card-title">Edit Transactions</h6>
  
			<form class="forms-sample" method="post" action="{{ route('admin.transactions.update', $transaction->id) }}">
			  @csrf
			  <div class="row mb-3">
				<label class="col-sm-3 col-form-label">Order Number <span style="color: red"> *</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="order_number" value="{{ $transaction->order_number }}" placeholder="Enter Order Number" required>
				</div>
			  </div>
  
			  <div class="row mb-3">
				<label class="col-sm-3 col-form-label">Transaction ID <span style="color: red"> *</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="transaction_id" value="{{ $transaction->transaction_id }}" placeholder="Enter Transaction ID" required>
				</div>
			  </div>
  
			  <div class="row mb-3">
				<label class="col-sm-3 col-form-label">Amount <span style="color: red"> *</span></label>
				<div class="col-sm-9">
				  <input type="number" name="amount" value="{{ $transaction->amount }}" class="form-control" placeholder="Enter Amont" required>
				</div>
			  </div>          

  			  <div class="row mb-3">
				<label class="col-sm-3 col-form-label">Payment Status <span style="color: red"> *</span></label>
				<div class="col-sm-9">
				  <select name="is_payment" class="form-select" required>
					<option value="0" {{ ($transaction->is_payment =='0') ? 'selected' : ''  }}>Pending</option>
					<option value="1" {{ ($transaction->is_payment == '1') ? 'selected' : ''  }}>Completed</option>
				  </select>
				</div>
			  </div>          

			  <button type="submit" class="btn btn-primary me-2">Update</button>
			  <a href="{{ url('admin/transactions') }}" class="btn btn-secondary">Back</a>
			</form>
  
		  </div>
		</div>
	  </div>
	</div>
</div>	
@endsection