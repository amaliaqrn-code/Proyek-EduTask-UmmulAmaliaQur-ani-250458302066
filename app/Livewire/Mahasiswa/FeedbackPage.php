<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class FeedbackPage extends Component
{
    public function render()
    {
        $feedbacks = Auth::user()
            ->mahasiswa
            ->feedbacks()
            ->with(['dosen.user', 'assignment.course'])
            ->latest()
            ->get();

        return view('livewire.mahasiswa.feedback-page', [
            'feedbacks' => $feedbacks,
        ]);
    }
}
