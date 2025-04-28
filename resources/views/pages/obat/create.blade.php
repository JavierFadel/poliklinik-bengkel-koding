<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-6">
                        <div class="bg-white p-6">
                            <h1 class="text-xl font-semibold mb-4 text-gray-900">Tambah Data Obat</h1>
                            <form method="POST" action="{{ route('obat.store') }}">
                                @csrf
                                @method('POST')
                                <div class="mb-4">
                                    <div class="w-full min-w-[200px]">
                                        <label class="block mb-2 text-sm text-slate-600">
                                            Nama Obat
                                        </label>
                                        <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." name="nama_obat" autofocus />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="w-full min-w-[200px]">
                                        <label class="block mb-2 text-sm text-slate-600">
                                            Kemasan
                                        </label>
                                        <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." name="kemasan" />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="w-full min-w-[200px]">
                                        <label class="block mb-2 text-sm text-slate-600">
                                            Harga
                                        </label>
                                        <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." name="harga" type="number" />
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
