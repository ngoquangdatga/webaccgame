@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Cập nhật nick game
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
                        <a href="{{route('nick.index')}}" class="bbt btn-success">Liệt kê nick game</a>
                        <a href="{{route('nick.create')}}" class="bbt btn-success">Thêm nick game</a>
                        <form action="{{route('nick.update',[$nick->id])}}" method="POST" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" value="{{$nick->title}}" name="title" placeholder="....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" class="form-control"  value="{{$nick->price}}" name="price" placeholder="....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Images</label>
                                <input type="file" class="form-control-file" name="images">
                                <img src="{{asset('uploads/nick/'.$nick->images)}}" height="50%" weight="50%">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" name="description" placeholder="....">"{{$nick->description}}"</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" name="status">
                                @if($nick->status==1)
                                    <option value="1" selected>Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                    @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0" selected>Không hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Thuộc game</label>
                                <select  required class="form-control " name="category_id">
                                <option value="0">---Chọn game cần thêm---</option>
                                    @foreach($category as $key => $cate)
                                    <option value="{{$cate->id}}" {{$cate->id==$nick->category_id ? 'selected' : ''}}>  {{$cate->title}}</option>
                                    @endforeach
                                </select>
                            <!-- <div class="form-group">
                                <label for="exampleFormControlSelect1">Thuộc game</label>
                                <textarea class="form-control" name="attribute" placeholder="....">"{{$nick->attribute}}"</textarea>
                            </div> -->
                            <!-- <span id="show_attribute"></span> -->
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>