<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class ForumDetail extends Component
{
    public $course;
    public $thread;
    public $replyContent;

    public function mount(Course $course, Forum $thread) {
        $this->course = $course;
        $this->thread = $thread;
    }

        public function deleteThread() {
        if ($this->thread->user_id !== Auth::id()) {
            abort(403, 'Tidak boleh menghapus postingan orang lain.');
        }

        $this->thread->delete();

        return redirect()->route('mahasiswa.forum.index', $this->course->id);
    }

    public function deleteReply($id) {
        $reply = Forum::findOrFail($id);

        // cek apakah user yang hapus adalah pemilik balasan
        if ($reply->user_id !== Auth::id()) {
            abort(403, 'Tidak boleh menghapus balasan orang lain.');
        }

        $reply->delete();

        $this->thread->refresh(); // refresh replies

        session()->flash('message', 'Balasan berhasil dihapus!');
    }


    public function addReply() {
        $this->validate([
            'replyContent' => 'required|min:3',
        ]);

        Forum::create([
            'user_id' => Auth::id(),
            'course_id' => $this->course->id,
            'parent_id' => $this->thread->id,
            'content' => $this->replyContent,
        ]);

        $this->replyContent = '';

        // supaya data replies langsung update
        $this->thread->refresh();

        session()->flash('message', 'Balasan berhasil ditambahkan!');
    }

    public function render(){
        return view('livewire.forum-detail');
    }
}
