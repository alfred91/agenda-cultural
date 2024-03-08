{{-- resources/views/components/responsive-table.blade.php --}}
@props(['headers', 'rows', 'class' => ''])

<div class="{{ $class }} overflow-x-auto mx-auto shadow-lg rounded-lg max-w-full text-center">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                @foreach($headers as $header)
                <th scope="col" class="px-6 py-3 text-s font-bold text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($rows as $row)
            <tr>
                @foreach($row as $cell)
                <td class="px-6 py-4 whitespace-normal text-center text-sm text-gray-500 dark:text-gray-200 break-words">
                    <div class="max-w-xs">
                        {!! $cell !!}
                    </div>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
