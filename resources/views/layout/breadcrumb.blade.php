<section class="bg-gray-100 p-4 rounded">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-xl font-bold" style="font-size: 1.8rem;">{{ $breadcrumb->title }}</h1>
            <ol class="flex space-x-2 text-sm">
                @foreach ($breadcrumb->list as $key => $value)
                    @if ($key == count($breadcrumb->list) - 1)
                        <li class="text-gray-500">{{ $value['name'] }}</li>
                    @else
                        <li>
                            <a href="{{ $value['url'] }}" class="text-teal-500 hover:underline">{{ $value['name'] }}</a>
                        </li>
                        <span>/</span>
                    @endif
                @endforeach
            </ol>
        </div>
    </div>
</section>
