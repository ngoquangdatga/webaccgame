@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Cập nhật phụ kiện game
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
                        <a href="{{route('phukien.index')}}" class="bbt btn-success">Liệt kê phụ kiện game</a>
                        <a href="{{route('phukien.create')}}" class="bbt btn-success">Thêm phụ kiện game</a>
                        <form action="{{route('phukien.update',[$phukien->id])}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" required  value="{{$phukien->title}}" name="title" placeholder="....">

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" required name="status">
                                    @if($phukien->status==1)
                                    <option value="1" selected>Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                    @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0" selected>Không hiển thị</option>
                                    @endif
                                </select>
                                <div class="form-group">
                                <label for="exampleFormControlSelect1">Thuộc game</label>
                                <select class="form-control" name="category_id">
                                    @foreach($category as $key => $cate)
                                    <option {{$cate->id==$phukien->category_id ? 'selected' : ''}} value="{{$cate->id}}"> {{$cate->title}}</option>
                                   @endforeach 

                                </select>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật phụ kiện</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>