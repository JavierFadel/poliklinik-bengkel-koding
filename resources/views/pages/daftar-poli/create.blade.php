<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Poli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-6">
                <div class="bg-white p-6">
                    <h1 class="text-xl font-semibold mb-4 text-gray-900">Daftar Poli</h1>
                    <form method="POST" action="{{ route('daftar-poli.store') }}">
                        @csrf
                        @method('POST')
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Jadwal
                                </label>
                                <select
                                    name="id_jadwal"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                        @foreach ($data as $item)
                                            <option value="{{ $item->id }}">{{ $item->dokter }} ({{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }})</option>    
                                        @endforeach
                                </select>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                </svg>
                            </div>                            
                        </div>
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Keluhan
                                </label>
                                <textarea
                                    name="keluhan"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none"
                                    required
                                ></textarea>
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
