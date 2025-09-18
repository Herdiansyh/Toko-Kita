<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>


    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST"
                        class="flex gap-8" x-data="{ imageUrl: '/storage/noimage.png' }">
                        @csrf

                        <div class ="w-1/2">
                            <img :src="imageUrl" alt="">

                        </div>
                        <div class="w-1/2">
                            <div class="mt-4">
                                <x-input-label for="foto" :value="__('foto')" />
                                <x-text-input accept="image/*" id="foto" class="block mt-1 w-full p-2"
                                    type="file" name="foto" required
                                    @change="imageUrl= URL.createObjectURL($event.target.files[0])" />
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="nama" :value="__('nama')" />
                                <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                    :value="old('nama')" required />
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="harga" :value="__('harga')" />
                                <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga"
                                    :value="old('harga')" required />
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="deskripsi" :value="__('deskripsi')" />
                                <x-textarea id="deskripsi" class="block mt-1 w-full" name="deskripsi" :value="old('deskripsi')"
                                    required />
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>
                            <x-primary-button class=" mt-3">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
