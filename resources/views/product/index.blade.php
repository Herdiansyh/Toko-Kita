<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    {{-- ✅ Alert Sukses --}}
    @if (session('success'))
        <x-alertSuccess message="{{ session('success') }}" />
    @endif




    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-10 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="font-semibold">List Products</h2>
                        <a href="{{ route('product.create') }}">
                            <button class="bg-gray-300 p-2 rounded-md hover:bg-gray-200 text-sm px-8">Add</button>
                        </a>
                    </div>
                    <div class="grid md:grid-cols-3 mt-3 gap-2 grid-cols-1">
                        @foreach ($products as $product)
                            <div>
                                <img src="{{ asset('storage/' . ($product->foto ?? 'noimage.png')) }}"
                                    alt="gambar {{ $product->nama }}">
                                <script>
                                    console.log("{{ $product->foto }}");
                                </script>
                                <p class="font-light text-xl"> {{ $product->nama }}</p>
                                <p class="text-gray-500 text-md"> Rp. {{ number_format($product->harga) }}</p>
                                <p class="text-gray-500 text-md"> {{ $product->deskripsi }}</p>

                                <div>
                                    <a href="{{ route('product.edit', $product->id) }}">
                                        <button
                                            class="w-full bg-gray-300 p-1 rounded-md text-lg font-light hover:bg-gray-200">Edit</button>
                                    </a>
                                    <form id="delete-form-{{ $product->id }}"
                                        action="{{ route('product.destroy', $product->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $product->id }})"
                                            class="w-full bg-red-800 p-1 rounded-md mt-2 text-lg font-light hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus produk ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</x-app-layout>
