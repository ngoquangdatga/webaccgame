@section('navbar')
@include('admin.include.navbar')
@endsection
<x-app-layout>
    <x-slot name="header">


        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                  Thêm videos game
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
                        <form action="{{route('videos.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="slug" required onkeyup="ChangeToSlug();" name="title" placeholder="....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link</label>
                                <input type="text" class="form-control" name="link" required placeholder="link Youtobe...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" required name="slug" id="convert_slug" placeholder="....">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Images</label>
                                <input type="file" class="form-control-file" required name="images">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" id="desc_videos" required name="description" placeholder="....">
                                </textarea>
                            </div>
                        
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Không hiển thị</option>

                                </select>
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Add Videos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>
</x-app-layout>