<template>
    <form action="/admin/dashboard/transactions" method="post">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-gray-600">
            <h1 class="font-medium text-lg">Buat Transaksi</h1>
            <p>
                <label for="jenis_transaksi">Jenis Transaksi:</label>
                <select v-model="selected" name="jenis_transaksi" id="jenis_transaksi">
                    <option v-for="option in options" :value="option.value">
                        {{ option.text }}
                    </option>
                </select>
                <h1>Terpilih: {{ selected }}</h1>
            </p>
          </div>

          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-5">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
              </div>

            <div class="md:col-span-5">
                <div class="flex">
                  <div class="w-full">
                      <label for="harga">Harga Barang</label>
                      <div class="flex items-center">
                          <span class="flex h-10 items-center rounded-l border border-r-0 border-gray-100 px-3">Rp.</span>
                          <input type="number" name="harga" id="harga" class="h-10 border mt-1 rounded-r px-4 w-full bg-gray-50" value="" placeholder="" />
                      </div>
                  </div>
                  <div class="ml-4 w-2/5">
                      <label for="qty">Jumlah Terbeli</label>
                      <div class="flex">
                         <button type="button" onclick="qtyPlus()" class="border border-r-0 rounded-l px-3">
                            <i class="fa-solid fa-plus"></i>
                         </button>
                         <input type="number" name="qty" id="qty" class="h-10 border mt-1 px-4 w-full bg-gray-50" value="0" placeholder="" />
                          <button type="button" onclick="qtyMinus()" class="border border-l-0 rounded-r px-3">
                            <i class="fa-solid fa-minus"></i>
                         </button>
                     </div>
                  </div>
                </div>
            </div>
            <div class="md:col-span-3">
                <label for="created_at">Tanggal Transaksi</label>
                <input type="date" name="created_at" id="created_at" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" />
            </div>


              <div class="md:col-span-5 text-right">
                <div class="inline-flex items-end">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buat</button>
                </div>
              </div>

            </div>
          </div>
        </div>
    </form>
</template>
<script setup>
    import { ref } from 'vue';

    const selected = ref('Pembelian');
    const options = ref([
        { text: 'Pembelian', value: 'pembelian' },
        { text: 'Penjualan', value: 'penjualan' },
    ])

</script>
