@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Liên kết blogs game
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
                        <a href="{{route('blogs.create')}}" class="bbt btn-success">Thêm blogs game</a>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên tiêu đề</th>
                                    <th>Slug </th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <!-- <th>Loại bài viết</th> -->
                                    <th>Quản lý</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($blogs as $key =>$blogs)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$blogs->title}}</td>
                                    <td>{{$blogs->slug}}</td>
                                    <td>{{$blogs->description}}</td>
                                    <td>
                                        @if($blogs->atatus==0)
                                        Không hiển thị
                                        @else
                                        Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{asset('/uploads/blogs/'.$blogs->images)}}" height="50%" weight="50%"></td>
                                    <!-- @if($blogs->kind_of_blog == 'blogs')
                                        Blogs
                                        @else
                                        Hướng dẫn sử dụng
                                        @endif -->
                                    <td>
                                        <form action="{{route('blogs.destroy',$blogs->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa blogs game nay khong?');" class="btn btn-dark">Delete</button>
                                        </form>

                                        <a href="{{route('blogs.edit',$blogs->id)}}" class="btn btn-warning">Sửa</a>
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