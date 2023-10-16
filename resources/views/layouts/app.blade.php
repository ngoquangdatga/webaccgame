<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <main class="py-4">
            @yield('navbar')
            @yield('content')
        </main>
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->

    </div>

    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script type="text/javascript">
        $(".choose_category").change(function() {
            var category_id = $(this).val();
            //alert(category_id);
            if (category_id == '0') {
                alert('Vui lòng chọn danh mục game?');
            } else {
                $.ajax({
                    url: "{{route('choose_category')}}",
                    method: "POST",
                    headers: {
                        'x-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $('#show_attribute').html(data);
                    }
                })
            }
        })
    </script>
    <script type="text/javascript">
        function shuffle(array) {
            var currentIndex = array.length,
                randomIndex;

            while (0 !== currentIndex) {
              
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;

               
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex],
                    array[currentIndex],
                ];
            }

            return array;
        }

        function spin_wheel() {
           
            var path_wheel = "{{URL::asset('/backend/wheel.mp3')}}";
            var path_applause = "{{URL::asset('/backend/applause.mp3')}}";
            var wheel_music = new Audio(path_wheel);
            var applause_musis = new Audio(path_applause);
            wheel_music.play();
            const wheel = document.querySelector('.wheel_style');
            let SelectedItem = "";

            let MagicRoaster = shuffle([1890, 2250, 2610]);
            let Sepeda = shuffle([1850, 2210, 2570]); 
            let RiceCooker = shuffle([1810, 2170, 2530]);
            let LunchBox = shuffle([1770, 2130, 2490]);
            let Sanken = shuffle([1750, 2110, 2470]);
            let Electrolux = shuffle([1630, 1990, 2350]);
            let JblSpeaker = shuffle([1570, 1930, 2290]);

          
            let Hasil = shuffle([
                MagicRoaster[0],
                Sepeda[0],
                RiceCooker[0],
                LunchBox[0],
                Sanken[0],
                Electrolux[0],
                JblSpeaker[0],
            ]);
          
            if (MagicRoaster.includes(Hasil[0])) SelectedItem = "Magic Roaster";
            if (Sepeda.includes(Hasil[0])) SelectedItem = "Sepeda Aviator";
            if (RiceCooker.includes(Hasil[0])) SelectedItem = "Rice Cooker Philips";
            if (LunchBox.includes(Hasil[0])) SelectedItem = "Lunch Box Lock&Lock";
            if (Sanken.includes(Hasil[0])) SelectedItem = "Air Cooler Sanken";
            if (Electrolux.includes(Hasil[0])) SelectedItem = "Electrolux Blender";
            if (JblSpeaker.includes(Hasil[0])) SelectedItem = "JBL Speaker";

         
            wheel.style.transition = "all 5s  ease";
            wheel.style.transform = "rotate(445deg)";
           
          
            setTimeout(function () {
                applause_musis.play();
            swal(
            "Chúc mừng bạn đã trúng",
            "Đã trúng " + SelectedItem + ".",
            "success"
            );
        }, 5000);
        
            setTimeout(function() {
                wheel.style.setProperty("transition", "initial");
                wheel.style.transform = "rotate(360deg)";
            }, 6000);
        }
    </script>
</body>

</html>