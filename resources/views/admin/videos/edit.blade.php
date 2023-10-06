@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">


        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                  Cập nhật videos game
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
                        <a href="{{route('videos.index')}}" class="bbt btn-success">Liệt kê videos game</a>
                        <form action="{{route('videos.update',[$videos->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" value="{{$videos->title}}" required onkeyup="ChangeToSlug();" name="title" placeholder="....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link</label>
                                <input type="text" class="form-control" value="{{$videos->link}}" name="link" required placeholder="link Youtobe...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" value="{{$videos->slug}}"  required name="slug" id="convert_slug" placeholder="....">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Images</label>
                                <img src="{{asset('/uploads/videos/'.$videos->images)}}" height="50%" weight="50%">
                                <input type="file" class="form-control-file"  name="images">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" id="desc_videos" value="{{$videos->description}}" required name="description" placeholder="....">{{$videos->description}}
                                </textarea>
                            </div>
                        
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" required name="status">
                                    @if($videos->status==1)
                                    <option value="1" selected>Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                    @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0" selected>Không hiển thị</option>
                                    @endif
                                </select>
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>
</x-app-layout>