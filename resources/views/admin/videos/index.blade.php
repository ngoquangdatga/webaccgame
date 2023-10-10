@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Liên videos videos game
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
                        <a href="{{route('videos.create')}}" class="bbt btn-success">Thêm videos videos game</a>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên tiêu đề</th>
                                    <th>Slug </th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>link</th>
                                    <th>Quản lý</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($videos as $key => $videos)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$videos->title}}</td>
                         
                                    <td>{{$videos->slug}}</td>
                                   
                                    <td>{{$videos->description}}</td>
                                    <td>
                                        @if($videos->atatus==0)
                                        Không hiển thị
                                        @else
                                        Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{asset('/uploads/videos/'.$videos->images)}}" height="50%" weight="50%"></td>
                                   <td><span height="100" width="150">{!!$videos->link!!}</span></td>
                                    <td>
                                        <form action="{{route('videos.destroy',$videos->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa video game nay khong?');" class="btn btn-danger">Delete</button>
                                        </form>

                                        <a href="{{route('videos.edit',$videos->id)}}" class="btn btn-warning">Sửa</a>
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