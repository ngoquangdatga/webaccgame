@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Liên kết phụ kiện game
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
                        <a href="{{route('phukien.create')}}" class="bbt btn-success">Thêm phụ kiện</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề phụ kiện</th>
                                    <th>Hiển thị</th>
                                    <th>Thuộc danh mục</th>
                                    <th>Quản lý</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($phukien as $key =>$phukien)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$phukien->title}}</td>
                                    <td>
                                        @if($phukien->atatus==0)
                                        Không hiển thị
                                        @else
                                        Hiển thị
                                        @endif
                                    </td>
                                    
                                    <td>{{$phukien->category->title}}</td>
                                    <td>
                                        <form action="{{route('phukien.destroy',$phukien->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa phu kien game nay khong?');" class="btn btn-danger">Delete</button>
                                        </form>

                                        <a href="{{route('phukien.edit',$phukien->id)}}" class="btn btn-warning">Sửa</a>
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