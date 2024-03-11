<footer class="bg-gray-900 text-white py-4 mt-auto mb-0">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ url('/admin/events') }}" class="flex items-center justify-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">Panel Administración</span>
                    <img src="/images/admin.svg" alt="Logo" class="h-8 w-auto mr-3 ml-5">
                </a>
            </div>
            <div>
                <p class="text-sm text-gray-400">&copy; {{ now()->year }} Agenda Cultural. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>
