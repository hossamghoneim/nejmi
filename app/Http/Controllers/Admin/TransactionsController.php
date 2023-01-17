<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }
}
