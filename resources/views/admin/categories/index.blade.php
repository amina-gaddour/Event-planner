@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-12">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">
                Categories
            </h1>

            <button onclick="openCreateModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg">
                + Add Category
            </button>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 font-medium">
                                {{ $category->name }}
                            </td>

                            <td class="px-6 py-4 text-right flex justify-end gap-4">
                                <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')"
                                    class="text-blue-600 hover:underline">
                                    Edit
                                </button>

                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                    onsubmit="return confirm('Delete this category ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= CREATE MODAL ================= --}}
    <div id="createModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl w-[400px] p-6">
            <h2 class="text-lg font-semibold mb-4">Create Category</h2>

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <input name="name" placeholder="Category name" class="input w-full mb-4" required>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                    <button class="bg-purple-600 text-white px-4 py-2 rounded">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= EDIT MODAL ================= --}}
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl w-[400px] p-6">
            <h2 class="text-lg font-semibold mb-4">Edit Category</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <input id="editName" name="name" class="input w-full mb-4" required>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                    <button class="bg-purple-600 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createModal').classList.add('flex');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        function openEditModal(id, name) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');

            document.getElementById('editName').value = name;
            document.getElementById('editForm').action =
                `/admin/categories/${id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
@endsection