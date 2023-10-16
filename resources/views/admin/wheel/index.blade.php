@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Vòng Quay May Mắn
                    </h1>
                    <style>
                        .wheel_box {
                            position: relative;
                        }
                        img.quay_style {
                            position: absolute;
                            top: 37%;
                            left: 21%;
                            opacity:0.5;
                        }
                        img.maker_style :hover{
                            opacity: 1;
                            transition: 1s all ease;
                        }
                    </style>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="wheel_box">
                            < <img class="wheel_style" src="{{asset('frontend/images/4Dh7tu4.png')}}" height="600" width="600">
                             <a style="cursor:pointers"> 
                              <img onclick="return spin_wheel()" class="quay_style" src="{{asset('frontend/images/quay.png')}}">
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>