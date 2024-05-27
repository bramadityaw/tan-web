@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/blog">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="w-1/2 mx-auto mb-12">
    <div class="bg-white rounded-md px-6 py-5">
        <section class="flex justify-between mb-4">
            <h1 class="text-lg font-semibold">Atur Kategori</h1>
            <button type="button" onclick="if (!editing) tambahKategori()" class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1">
                <i class="fa-solid fa-plus block text-md mr-4"></i>
                <span class="inline-block mr-2">Tambah</span>
            </button>
        </section>
        <section id="kategori" class="min-h-[35dvh]">
            @forelse($kategori as $k)
            <div data-kategori="{{ $k->id }}" class="flex gap-4 mb-4 justify-between">
                <input class="w-full px-2 py-1 bg-gray-100 border border-gray-300" type="text" name="kategori" value="{{ $k->value ?? '' }}" disabled>
                <div class="text-white min-w-1/3 flex gap-4">
                    <button type="button" data-kategori="{{ $k->id }}" onclick="editKategori(this)" class="rounded-md flex justify-between text-sm items-center gap-2 px-2 py-1 bg-green-500 w-16">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span class="w-full">Edit</span>
                    </button>
                    <button data-kategori="{{ $k->id }}" onclick="deleteKategori(this)" class="rounded-md flex justify-between items-center gap-2 text-sm px-2 py-1 bg-red-500">
                        <i class="fa-solid fa-trash"></i>
                        <span>Hapus</span>
                    </button>
                </div>
            </div>
            @empty
            <h1 class="text-xl text-center text-gray-400 font-semibold mt-[calc(25dvh-1.5rem)]">Tambahkan kategori <i class="fa-solid fa-arrow-up text-md ml-4"></i> </h1>
            @endforelse
        </section>
    </div>
</div>
<dialog id="deleteDialog" class="border border-[#1B3C73] rounded-md p-4 w-4/5 md:w-1/6">
    <div class="text-center">
        <button class="float-end" type="button" onclick="deleteDialog.close()">
            <i class="fa-solid fa-times text-lg"></i>
        </button>
        <p>Hapus kategori?</p>
        <img class="aspect-auto w-2/3 mx-auto my-4" src="{{ asset('/images/question.png') }}" alt="Tanda Tanya">
        <div class="flex flex-row justify-around text-white">
            <form method="dialog">
                <button type="submit" class="rounded-md px-3 py-2 bg-blue-500">Batal</button>
            </form>
            <button type="button" class="rounded-md px-3 py-2 bg-red-500">Hapus</button>
        </div>
    </div>
</dialog>
@endsection

@push('scripts')
<script>
const deleteDialog = document.querySelector("#deleteDialog");
const deleteButton = deleteDialog.querySelector('form[method="dialog"] + button[type="button"]');

function deleteKategori(kategori) {
    deleteDialog.showModal();
    const id = kategori.dataset.kategori;
    const uri = `/kategori/${id}`;

    const form = new FormData;
    form.append('_token', token);

    deleteButton.addEventListener("click", e => {
        fetch(uri, {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'multipart/form-data',
            },
            body: form,
        });
        deleteDialog.close();
        location.reload();
    });
}
</script>
<script>
const kategori = document.querySelector('#kategori');
const token = document.querySelector('input[name="_token"]').value;
let editing = false;

function tambahKategori() {
    editing = true;
    let placeholder = kategori.querySelector('h1');

    const row = document.createElement('div');
    row.classList.add('flex', 'gap-4', 'mb-4', 'justify-between');

    const field = document.createElement('input');
    field.classList.add("w-full", "px-2", "py-1", "bg-gray-100", "border", "border-gray-300");
    field.type = 'text';
    field.name = 'kategori';
    field.required = true;

    row.appendChild(field);

    const cancelButton = document.createElement('button');
    cancelButton.classList.add("rounded-md", "flex", "text-sm", "items-center", "gap-4", "px-2", "py-1", "bg-red-500");

    const cancelIcon = document.createElement('i');
    cancelIcon.classList.add("fa-solid", "fa-close");

    const cancelCopy = document.createElement('span');
    cancelCopy.innerText = "Batal";

    cancelButton.appendChild(cancelIcon);
    cancelButton.appendChild(cancelCopy);

    cancelButton.addEventListener("click", e => cancel(e.target))

    const confirmButton = document.createElement('button');
    confirmButton.classList.add("rounded-md", "flex", "text-sm", "items-center", "gap-2", "px-2", "py-1", "bg-green-500", "w-16");

    confirmButton.type = "submit";

    const confirmIcon = document.createElement('i');
    confirmIcon.classList.add("fa-solid", "fa-check");

    const confirmCopy = document.createElement('span');
    confirmCopy.innerText = "Buat";

    confirmButton.appendChild(confirmIcon);
    confirmButton.appendChild(confirmCopy);

    const buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add("text-white", "flex", "gap-4", "max-w-[155px]");
    buttonsContainer.appendChild(confirmButton);
    buttonsContainer.appendChild(cancelButton);

    const form = document.createElement('form');
    form.action = "/kategori";
    form.method = "post";

    const tokenField = document.createElement('input');
    tokenField.type = 'hidden';
    tokenField.name = '_token';
    tokenField.value = token;

    form.appendChild(tokenField);

    row.appendChild(buttonsContainer);
    form.appendChild(row);

    if (placeholder) {
        placeholder.remove();
    }

    kategori.prepend(form);
    row.querySelector('input[name="kategori"]').focus();
}

document.addEventListener("click", e => {
    let placeholder = kategori.querySelector('h1');
    if (!placeholder && kategori.children.length < 2) {
        let input = kategori.children[0].querySelector('input');
        if (document.activeElement !== input) {
            input.parentNode.remove();
            kategori.appendChild(createPlaceholder());
        }
    }
});

function createPlaceholder() {
    const placeholder = document.createElement('h1');
    placeholder.innerHTML = "Tambahkan kategori <i class=\"fa-solid fa-arrow-up text-md ml-4\">";
    placeholder.classList.add("text-xl", "text-center", "text-gray-400", "font-semibold", "mt-[calc(25dvh-1.5rem)]");
    return placeholder;
}

function cancel(button) {
    editing = false;
    if (button.children.length === 0) {
        button.parentNode.parentNode.parentNode.remove();
        return
    }
    button.parentNode.parentNode.remove();
}

function editKategori(button) {
    editing = true;
    const kategoriRow = button.parentNode.parentNode;
    const field = kategoriRow.querySelector('input');
    field.disabled = false;
    field.focus();
    field.select();
    editMode(kategoriRow);
}

function editMode(row) {
    const originalRow = row.innerHTML;
    row.classList.remove('w-16');
    const submitButton = row.querySelector('button.bg-green-500');

    const submitIcon = submitButton.querySelector('i');
    submitIcon.classList.remove('fa-pen-to-square');
    submitIcon.classList.add('fa-check');

    const submitText = row.querySelector('span');
    submitText.textContent = 'Ubah';

    const cancelButton = row.querySelector('button.bg-red-500');
    cancelButton.classList.remove('gap-2');
    cancelButton.classList.add('gap-4');

    const cancelIcon = cancelButton.querySelector('i');
    cancelIcon.classList.remove('fa-trash');
    cancelIcon.classList.add('fa-close');

    const cancelText = cancelButton.querySelector('span');
    cancelText.textContent = 'Batal';

    cancelButton.onclick = null;
    cancelButton.addEventListener('click', e => cancelEdit(e.target, originalRow));
    submitButton.onclick = null;
    submitButton.addEventListener('click', e => submitEdit(e.target,
                                                row.querySelector('input').value))
}

function submitEdit(button, value) {
    const kategoriId = button.dataset.kategori;
    const url = `/kategori/${kategoriId}`;

    console.log(kategoriId);
    const form = new FormData;
    form.append('_token', token);
    form.append('_method', 'PUT');
    form.append('kategori', value);

    fetch(url, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'multipart/form-data',
        },
        body: form,
    })

}

function cancelEdit(button, originalRow) {
    const row = button.children.length === 0
        ? button.parentNode.parentNode.parentNode
        : button.parentNode.parentNode;
    row.innerHTML = originalRow;
}
</script>
@endpush
