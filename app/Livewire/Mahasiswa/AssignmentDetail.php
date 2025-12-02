<?php
namespace App\Livewire\Mahasiswa;

use Livewire\Attributes\Layout;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

#[Layout('mahasiswa.layout')]
class AssignmentDetail extends Component
{
    use WithFileUploads;

    public $assignment;
    public $file;

    public function mount($id) {
        // LOAD ASSIGNMENT
        $this->assignment = Assignment::findOrFail($id);
    }

    public function submit()
{
    $this->validate([
        'file' => 'required|mimes:pdf,doc,docx,zip,jpeg',
    ]);

    $mahasiswaId = Auth::user()->mahasiswa->id;

    // CEK SUBMISSION SUDAH ADA
    $existing = Submission::where('assignment_id', $this->assignment->id)
        ->where('mahasiswa_id', $mahasiswaId)
        ->first();

    if ($existing) {
        session()->flash('success', 'Tugas sudah pernah dikumpulkan.');
        return redirect()->route('mahasiswa.assignments.index');
    }

    $path = $this->file->store('submissions');

    $deadline = $this->assignment->deadline;
    $now = now();

    $status = $now->gt($deadline) ? 'late' : 'submitted';
    $points = $status === 'late' ? 2 : 10;

    Submission::create([
        'assignment_id' => $this->assignment->id,
        'mahasiswa_id' => $mahasiswaId,
        'file_url' => $path,
        'status' => $status,
        'points_awarded' => $points,
        'points_reason' => $status === 'late' ? 'Terlambat mengumpulkan' : 'Tepat waktu',
    ]);

    session()->flash('success', 'Tugas berhasil dikumpulkan!');
    return redirect()->route('mahasiswa.assignments.index');
    }

    public function render() {
        return view('livewire.mahasiswa.assignment-detail');
    }
}
