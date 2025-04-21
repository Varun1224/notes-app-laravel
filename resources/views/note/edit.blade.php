<x-app-layout>
    <div class="note-container single-note">
        <h1 class="p-4 text-white">Edit Your Note</h1>
        <form action="{{ route('note.update', $note) }}" method="POST" class="note">
            @csrf
            @method('PUT')
            <textarea name="note" rows="10" placeholder="Enter Your Note Here" class="note-body">{{ $note->note }} </textarea>
            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button type="submit" class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
