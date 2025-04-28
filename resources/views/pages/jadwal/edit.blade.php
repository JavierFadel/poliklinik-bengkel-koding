<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-6">
                    <div class="container mx-auto p-4">
                        <h1 class="text-xl font-semibold mb-4 text-gray-900">Edit Jadwal</h1>
                        <form method="POST" action="{{ route('jadwal.update', $data->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4 flex gap-2">
                                <div class="w-full min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Hari
                                    </label>
                                    <select
                                        name="hari"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                            <option value="senin" @selected($data->hari == 'senin')>Senin</option>
                                            <option value="selasa" @selected($data->hari == 'selasa')>Selasa</option>
                                            <option value="rabu" @selected($data->hari == 'rabu')>Rabu</option>
                                            <option value="kamis" @selected($data->hari == 'kamis')>Kamis</option>
                                            <option value="jumat" @selected($data->hari == 'jumat')>Jumat</option>
                                            <option value="sabtu" @selected($data->hari == 'sabtu')>Sabtu</option>
                                            <option value="minggu" @selected($data->hari == 'minggu')>Minggu</option>
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </div>
                                <div class="w-full min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Jam Mulai
                                    </label>
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <input 
                                        name="jam_mulai"
                                        type="time" 
                                        id="time" 
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                        min="09:00" 
                                        max="18:00" 
                                        value="{{ $data->jam_mulai }}" 
                                        required
                                    />
                                </div>
                                <div class="w-full min-w-[200px]">
                                    <label class="block mb-2 text-sm text-slate-600">
                                        Jam Selesai
                                    </label>
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg
                                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" 
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                    <input
                                        name="jam_selesai"
                                        type="time"
                                        id="time" 
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                        min="09:00" 
                                        max="18:00" 
                                        value="{{ $data->jam_selesai }}" 
                                        required
                                    />
                                </div>
                            </div>
                            <button type="submit" id="theme-toggle" class="px-4 py-2 rounded bg-indigo-500 text-white hover:bg-indigo-700 focus:outline-none transition-colors">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
