@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">


        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                  Cập nhật blogs game
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
                        <a href="{{route('blogs.index')}}" class="bbt btn-success">Liệt kê blogs game</a>
                        <a href="{{route('blogs.create')}}" class="bbt btn-success">Thêm blogs game</a>
                        <form action="{{route('blogs.update',[$blogs->id])}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" value="{{$blogs->title}}" id="slug" required onkeyup="ChangeToSlug();" name="title" placeholder="....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" value="{{$blogs->slug}}" required name="slug" id="convert_slug" placeholder="....">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Images</label>
                                <input type="file" class="form-control-file" name="images">
                                <img src="{{asset('/uploads/blogs/'.$blogs->images)}}" height="50%" weight="50%">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" id="desc_blogs" required name="description" placeholder="....">{{$blogs->description}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Content</label>
                                <textarea class="form-control" id="content_blogs" required name="content" placeholder="....">{{$blogs->content}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" name="status">
                                    @if($blogs->status==1)
                                    <option selected value="1">Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                    @else
                                    <option value="0">Không hiển thị</option>
                                    <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                                <label for="exampleFormControlSelect1">Loại Tin</label>
                                <select class="form-control" name="kind_of_blog">
                                    @if($blog->kind_of_blog=='blog')
                                    <option selected value="blog">Blogs</option>
                                    <option value="huongdan">Hướng Dẫn</option>

                                    @else
                                    <option value="blog">Blogs</option>
                                    <option selected value="huongdan">Hướng Dẫn</option>

                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>
</x-app-layout>