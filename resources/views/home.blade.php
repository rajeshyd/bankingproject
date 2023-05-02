@extends('layouts.mainlayout')
@include('layouts.menu')
@section('body')

<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-20">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">ABC Bank</h1>
      </div>
      <div class="flex flex-wrap -m-4">
        <div class="p-4 md:w-full">
          <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
            <div class="flex items-center mb-3">
              <h2 class="text-gray-900 text-lg title-font font-medium">
               Welcome {{ucfirst($name)}}
              </h2>
            </div>
            <div class="flex-grow">
              <p class="leading-relaxed text-base">User Id: {{$email}}</p>
              <a class="mt-3 text-indigo-500 inline-flex items-center">Your Account Balance: {{$balance}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
