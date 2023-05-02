@extends('layouts.mainlayout')
@include('layouts.menu')
@section('body')
  <section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-20">
        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Statement</h1>
      </div>
      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
          <thead>
            <tr>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">S.No</th>
              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Amount</th>
              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Type</th>
              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Details</th>
              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Balance</th>
              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">DATETIME</th>

            </tr>
          </thead>
          <tbody>


            @foreach ($datas as $key=> $data)


            <tr>
              <td class="px-4 py-3">{{$key}}</td>
              <td class="px-4 py-3">{{$data->amount}}</td>
              <td class="px-4 py-3">{{$data->type}}</td>
              <td class="px-4 py-3">
                @if ($data->to_account==$data->from_account && $data->type=='credit' )
                    {{'Deposit'}}
                @elseif ($data->to_account==$data->from_account && $data->type=='debit' )
                    {{'Withdraw'}}
                @elseif ($data->to_account != $data->from_account && $data->type=='credit' )
                    {{'Transfer from '.$data->from_account  }}
                @elseif ($data->to_account != $data->from_account && $data->type=='debit' )
                    {{'Transfer to '.$data->from_account  }}
                @endif

            </td>
              <td class="px-4 py-3 text-lg text-gray-900">{{$data->balance}}</td>
              <td class="px-4 py-3">{{date("d-m-Y",strtotime($data->created_at))}}<br>{{date("H:i A",strtotime($data->created_at))}}</td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="row">

            <div class="col-md-12">

                {{ $datas->links() }}

            </div>

        </div>
      </div>
    </div>
  </section>
@endsection
