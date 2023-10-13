@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Thêm gallery nick game
                </h2>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                        
                        <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="nick_id" value="{{Request::segment(2)}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn Images</label>
                                <input type="file" class="form-control-file" required multiple name="images[]">
                            </div>
                            <span id="show_attribute"></span>
                            <button type="submit" class="btn btn-primary">Thêm ảnh</button>
                        </form>
                    </div>
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Gallery</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gallery as $key =>$gall)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$gall->title}}</td>
                                   
                                    <td><img src="{{asset('uploads/gallery/'.$gall->images)}}" height="50px" weight="50px"></td>
                                    <td>
                                        <form action="{{route('gallery.destroy',$gall->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Ban co muon xoa ảnh game nay khong?');" class="btn btn-danger">Delete</button>
                                        </form>

                                       
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
