@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Liên kết nick game
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
                        <a href="{{route('nick.create')}}" class="bbt btn-success">Thêm nick game</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Mã số</th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>Thuộc nick</th>
                                    <th>Quản lý</th>
                                    <th></th>
                            </tr>

                            </thead>
                            <tbody>
                                @foreach($nicks as $key =>$nick)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$nick->title}}</td>
                                    <td>#{{$nick->ms}}</td>
                                    <td>{{$nick->description}}</td>
                                    <td>
                                        @if($nick->atatus==0)
                                        Không hiển thị
                                        @else
                                        Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{asset('uploads/nick/'.$nick->images)}}" height="50%" weight="50%"></td>
                                    <td>{{$nick->category->title}}</td>
                                    <td>
                                        <form action="{{route('nick.destroy',$nick->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa nick game nay khong?');" class="btn btn-danger">Delete</button>
                                        </form>

                                        <a href="{{route('nick.edit',$nick->id)}}" class="btn btn-warning">Sửa</a>
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>