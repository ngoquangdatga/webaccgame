@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Liên kết slider game
                    </h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{route('slider.create')}}" class="bbt btn-success">Thêm slider game</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên slider</th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($slider as $key =>$sli)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$sli->title}}</td>
                                    <td>{{$sli->description}}</td>
                                    <td>
                                        @if($sli->atatus==0)
                                        Không hiển thị
                                        @else
                                        Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{asset('uploads/slider/'.$sli->images)}}" height="50%" weight="50%"></td>
                                    <td>
                                        <form action="{{route('slider.destroy',$sli->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa slider game nay khong?');" class="btn btn-dark">Delete</button>
                                        </form>

                                        <a href="{{route('slider.edit',$sli->id)}}" class="btn btn-warning">Sửa</a>
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$slider ->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>