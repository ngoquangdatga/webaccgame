@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Liên kết danh mục game
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
                        <a href="{{route('category.create')}}" class="bbt btn-success">Thêm Danh Mục</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Slug danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($category as $key =>$cate)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$cate->title}}</td>
                                    <td>{{$cate->slug}}</td>
                                    <td>{{$cate->description}}</td>
                                    <td>
                                        @if($cate->atatus==0)
                                        Không hiển thị
                                        @else
                                        Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{asset('uploads/category/'.$cate->images)}}" height="50%" weight="50%"></td>
                                    <td>
                                        <form action="{{route('category.destroy',$cate->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa danh muc game nay khong?');" class="btn btn-danger">Delete</button>
                                        </form>

                                        <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$category->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>