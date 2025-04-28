<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Poliklinik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                <div class="bg-white shadow rounded-lg p-6">
                    <h1 class="text-xl font-semibold mb-4 text-gray-900">Edit Data Poliklinik</h1>
                    <form method="POST" action="{{ route('poli.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Nama Poliklinik
                                </label>
                                <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." value="{{ $data->nama_poli }}" name="nama_poli" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label for="keterangan" class="block mb-2 text-sm font-medium text-slate-600">Keterangan</label>
                                <textarea id="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Type here..." name="keterangan">{{ $data->keterangan }}</textarea>
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
