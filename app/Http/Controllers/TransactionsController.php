<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class TransactionsController extends Controller
{
    public function TransactionsList(Request $request) {
        $transactions = Transactions::select('transactions.*', 'users.name')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->orderBy('transactions.id', 'desc');
        if(!empty($request->id)) {
            $transactions = $transactions->where('transactions.id', '=', $request->id);
        }
        if(!empty($request->user_name)) {
            $transactions = $transactions->where('users.name', 'like', '%'. $request->user_name .'%');
        }
        if($request->is_payment == '1' || $request->is_payment == '0') {
            $transactions = $transactions->where('transactions.is_payment', '=', $request->is_payment);
        }

        $transactions = $transactions->where('transactions.is_delete' , '=', 0)->get();
        
        return view('admin.transactions.list', compact('transactions'));        
    }

    public function TransactionsDelete($id) {
        $transaction = Transactions::findOrFail($id);
        $transaction->is_delete = 1;
        $transaction->save();
        
        return redirect()->back()->with('success', 'Transaction Successfully Soft Deleted');
    }

    public function TransactionsEdit($id) {
        $transaction = Transactions::findOrFail($id);

        return view('admin.transactions.edit', compact('transaction'));
    }

    public function TransactionsUpdate($id, Request $request) {
        $transaction = Transactions::findOrFail($id);
        $transaction->order_number = trim($request->order_number);
        $transaction->transaction_id = trim($request->transaction_id);
        $transaction->amount = trim($request->amount);
        $transaction->is_payment = $request->is_payment;
        $transaction->save();

        return redirect('admin/transactions')->with('success', 'Transaction Successfully Update');
    }

    public function AgentTransactionsAdd() {
        return view('agent.transactions.add');
    }

    public function AgentTransactionsStore(Request $request) {
        $transaction = new Transactions;
        $transaction->user_id = Auth::user()->id; // 현재 로그인한 세션의 아이디
        $transaction->order_number = trim($request->order_number);
        $transaction->transaction_id = trim($request->transaction_id);
        $transaction->amount = trim($request->amount);
        $transaction->is_payment = $request->is_payment;
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction Successfully Add');
    }

    public function AgentTransactionsList() {
        $transactions = Transactions::getData(Auth::user()->id);

        return view('agent/transactions/list', compact('transactions'));
    }
}
