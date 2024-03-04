{{-- resources/views/components/responsive-table.blade.php --}}
@props(['headers', 'rows', 'class' => ''])

<div class="{{ $class }} overflow-auto mx-auto">
    <table class="table w-full mx-auto dark:bg-gray-800 dark:text-gray-200 ">
        <thead class="dark:bg-gray-700">
            <tr>
                @foreach($headers as $header)
                <th class="px-4 py-2 text-center">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
            <tr>
                @foreach($row as $cell)
                <td class="px-4 py-2 text-center">{!! $cell !!}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
