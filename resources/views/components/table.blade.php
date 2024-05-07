<table class="w-full border-collapse border dark:border-slate-700">
    <thead class="bg-slate-100 dark:bg-slate-700/20">
    <tr>
        @php
            // Total jumlah kolom
            $total_columns = count($theads);

            // Lebar kolom pertama dan terakhir adalah 10%
            $side_columns_width = '10%';

            // Sisa lebar yang dibagi rata oleh kolom tengah
            $middle_columns = $total_columns - 2;
            $middle_columns_width = 90 / $middle_columns; // Dalam persen
        @endphp

        @foreach($theads as $index => $head)
            @if ($index == 0)
                <th scope="col"
                    class="p-1 font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 border dark:border-slate-700"
                    style="width: {{ $side_columns_width }};"> <!-- Kolom pertama 10% -->
                    {{ $head }}
                </th>
            @elseif ($index == $total_columns - 1)
                <th scope="col"
                    class="p-1 font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 border dark:border-slate-700"
                    style="width: {{ $side_columns_width }};"> <!-- Kolom terakhir 10% -->
                    {{ $head }}
                </th>
            @else
                <th scope="col"
                    class="p-1 font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 border dark:border-slate-700"
                    style="width: {{ $middle_columns_width }}%;"> <!-- Kolom tengah bagi 90% -->
                    {{ $head }}
                </th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody id="_table-data" data-url="{{$url}}"></tbody>
</table>
<div class="flex justify-between mt-4">
    <div class="self-center" id="_show_pagination_total"></div>
    <ul class="inline-flex -space-x-px list-inside my-2 py-2" id="_pagination"></ul>
</div>
