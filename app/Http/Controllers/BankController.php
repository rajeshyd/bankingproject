<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class BankController extends Controller
{
    public function home()
    {

      $email=Auth::user()->email;
      $name=Auth::user()->name;
      $balance=$this->balance($email);
        return view('home',['email'=>$email,'name'=>$name,'balance'=>$balance]);

    }
    public function deposit(Request $request)
    {

        //dd($request->all());
        $email=Auth::user()->email;
       // dd($email);
       $balance=$this->balance($email)+$request->amount;
     //  dd($balance);
        DB::table('banks')->insert([
            'amount'=>$request->amount,
            'type'=>'credit',
            'to_account'=>$email,
            'from_account'=>$email,
            'balance'=>$balance,
            'created_at'=>now(),
            'updated_at'=>now()

        ]);
        return redirect()->back();

    }
    public function withdraw(Request $request)
    {

        //dd($request->all());
        $email=Auth::user()->email;

        $balance=$this->balance($email)-$request->amount;
        if($balance >=0){
        DB::table('banks')->insert([
            'amount'=>$request->amount,
            'type'=>'debit',
            'to_account'=>$email,
            'from_account'=>$email,
            'balance'=>$balance,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        return redirect()->back();
    }
    else{
        return redirect()->back();

    }


    }
    public function transfer(Request $request)
    {

        $email=Auth::user()->email;
        //dd($request->all());
        $balance=$this->balance($request->email)+$request->amount;
        if($balance >=0){
        DB::table('banks')->insert([
            'amount'=>$request->amount,
            'type'=>'credit',
            'to_account'=>$request->email,
            'from_account'=>$email,
            'balance'=>$balance,
            'created_at'=>now(),
            'updated_at'=>now()

        ]);
        $balanceadd=$this->balance($email)-$request->amount;
        DB::table('banks')->insert([
            'amount'=>$request->amount,
            'type'=>'debit',
            'to_account'=>$email,
            'from_account'=>$request->email,
            'balance'=>$balanceadd,
            'created_at'=>now(),
            'updated_at'=>now()

        ]);
    }
    else{

    }
        return redirect()->back();

    }
    public function statementreport(Request $request)
    {

        //dd($request->all());

        $email=Auth::user()->email;
        //dd($request->all());
        $outputs=DB::table('banks')->where('to_account',$email)->Paginate(5);
//dd($outputs->);

        return view('statement')->with('datas',$outputs);


//dd($data);


    }
    public function credit($account):float
    {
        $val= DB::table('banks')
        ->select(DB::raw("SUM(amount) as count"))
        ->where('to_account',$account)
        ->where('type','credit')
        ->get();
       // dd($val);
        return (float)$val[0]->count;

    }
    public function debit($account):float
    {
        $val= DB::table('banks')
        ->select(DB::raw("SUM(amount) as count"))
        ->where('to_account',$account)
        ->where('type','debit')
        ->get();
        return (float)$val[0]->count;

    }
    public function balance($account):float
    {
      return  (float)$this->credit($account)-(float)$this->debit($account);
    }

}
