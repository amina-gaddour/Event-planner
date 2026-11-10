<div id="modal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50">

    <div class="bg-white rounded-lg p-8 w-full max-w-sm text-center">
        <h2 class="font-bold mb-6">Book Event</h2>

        <form method="POST" action="{{ route('events.register', $event) }}">
            @csrf

            <div class="flex justify-center gap-4">
                <button type="button" onclick="closeModal()" class="border px-6 py-2 rounded">
                    Cancel
                </button>

                <button class="bg-purple-600 text-white px-6 py-2 rounded">
                    Book now
                </button>
            </div>
        </form>
    </div>
</div>