@extends('layouts.admin')

<div x-data="experienceModal()">
    @include('components.add-experience-modal')
    @include('components.edit-experience-modal')

    @section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-blue-400 dark:text-blue-800 leading-tight">
            {{ __('Experiencias') }}
        </h2>
        <x-secondary-button @click="$dispatch('open-add-experience-modal')">
            Añadir Experiencia
        </x-secondary-button>
    </div>
    @endsection

    @section('content')
    <div class="py-12 mb-10">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 mb-24">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">

                    @php
                    $headers = ['ID', 'Nombre', 'Descripción Corta', 'Descripción Larga', 'Fecha de Inicio', 'Texto de Fecha', 'Precio', 'Empresa', 'Link', 'Imagen', 'Acciones'];

                    $rows = $experiences->map(function ($experience) {
                    $editButton = "<button @click=\"openEditExperienceModal({$experience->id})\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded\"><i class=\"fas fa-edit\"></i></button>";
                    $deleteButton = '<form action="'.route('admin.experiences.destroy', $experience->id).'" method="POST" class="inline">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" onclick="return confirm(\'¿Estas seguro de que quieres eliminar esta experiencia?\');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-trash"></i></button>
                    </form>';

                    $fStartDate = \Carbon\Carbon::parse($experience->start_date)->format('d/m/Y');
                    $sShortDescription = Str::limit($experience->short_description, 50);
                    $sLongDescription = Str::limit($experience->long_description, 100);
                    $imageUrl = asset("storage/experiences/" . $experience->image);
                    $imageTag = "<img src='{$imageUrl}' alt='Imagen de experiencia' class='mx-auto block max-h-24 w-auto'>";

                    return [
                    $experience->id,
                    $experience->name,
                    $sShortDescription,
                    $sLongDescription,
                    $fStartDate,
                    $experience->date_text,
                    number_format($experience->price_per_person, 2).'€',
                    $experience->company->name ?? 'N/A',
                    $experience->link,
                    $imageTag,
                    $editButton . ' ' . $deleteButton,
                    ];
                    })->toArray();
                    @endphp

                    {{ $experiences->links() }}
                    <x-responsive-table :headers="$headers" :rows="$rows" />
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script>
        function experienceModal() {
            return {
                isOpenAddExperienceModal: false
                , isOpenEditExperienceModal: false
                , selectedExperienceId: null
                , experience: {},

                openAddExperienceModal() {
                    this.isOpenAddExperienceModal = true;
                },

                openEditExperienceModal(experienceId) {
                    this.selectedExperienceId = experienceId;
                    this.fetchExperience(experienceId);
                    this.isOpenEditExperienceModal = true;
                    this.isOpenAddExperienceModal = false;
                },

                async fetchExperience(experienceId) {
                    try {
                        const response = await fetch(`/admin/experiences/${experienceId}/edit`);
                        if (!response.ok) throw new Error('Error al cargar la experiencia');
                        const data = await response.json();
                        this.experience = data;
                    } catch (error) {
                        console.error(error.message);
                    }
                }
                , init() {
                    window.addEventListener('open-add-experience-modal', () => {
                        this.openAddExperienceModal();
                    });
                }
            }
        }

    </script>
