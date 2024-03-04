<!-- resources/views/components/table.blade.php -->
<table {{ $attributes->merge(['class' => 'table-auto w-full']) }}>
    <thead>
        <tr>
            {{ $head }}
        </tr>
    </thead>
    <tbody>
        {{ $body }}
    </tbody>
</table>
