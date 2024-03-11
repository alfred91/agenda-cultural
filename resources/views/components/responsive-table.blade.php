{{-- resources/views/components/responsive-table.blade.php --}}
@props(['headers', 'rows', 'class' => ''])

<div class="{{ $class }} overflow-x-auto mx-auto shadow-lg rounded-lg max-w-full text-center mb-18">
    <table class="min-w-full divide-y divide-gray-600 dark:divide-gray-950">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                @foreach($headers as $header)
                <th scope="col" class=" bg-slate-500 dark:bg-slate-900 px-6 py-3 text-s font-bold text-gray-50 dark:text-gray-200 uppercase tracking-wider">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-gray-50 dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($rows as $row)
            <tr>
                @foreach($row as $cell)
                <td class="px-6 py-4 whitespace-normal text-center text-sm text-gray-800 dark:text-gray-200 break-words">
                    <div class="max-w-s">
                        {!! $cell !!}
                    </div>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
