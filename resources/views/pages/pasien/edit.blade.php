<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                <div class="bg-white shadow rounded-lg p-6">
                    <h1 class="text-xl font-semibold mb-4 text-gray-900">Edit Data Pasien</h1>
                    <form method="POST" action="{{ route('pasien.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Nama Pasien
                                </label>
                                <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." value="{{ $data->name }}" name="name" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Alamat
                                </label>
                                <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." value="{{ $data->alamat }}" name="alamat" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Nomor KTP
                                </label>
                                <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." value="{{ $data->no_ktp }}" name="no_ktp" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Nomor Handphone
                                </label>
                                <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." value="{{ $data->no_hp }}" name="no_hp" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="w-full min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Nomor RM
                                </label>
                                <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." value="{{ $data->no_rm }}" name="no_rm" />
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
