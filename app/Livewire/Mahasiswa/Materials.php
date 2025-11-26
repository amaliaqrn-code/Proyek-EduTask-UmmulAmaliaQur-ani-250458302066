<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Material;
use App\Models\Like;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Materials extends Component
{
    public $liked = [];
    public $selectedCourse = 'all';

    public function toggleLike($materialId)
    {
        $userId = Auth::id();
        $type   = \App\Models\Material::class;

        $existingLike = Like::where([
            'user_id'       => $userId,
            'likeable_id'   => $materialId,
            'likeable_type' => $type,
        ])->first();

        if ($existingLike) {
            $existingLike->delete();
            unset($this->liked[$materialId]);
        } else {
            Like::create([
                'user_id'       => $userId,
                'likeable_id'   => $materialId,
                'likeable_type' => $type,
            ]);
            $this->liked[$materialId] = true;
        }
    }

    /** RENDER PAGE */
    public function render()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $courses = $mahasiswa->courses;

        $likes = Like::where('user_id', Auth::id())
            ->where('likeable_type', Material::class)
            ->pluck('likeable_id')
            ->toArray();

        $this->liked = array_fill_keys($likes, true);

        // mengambil materi sesuai mata kuliah mahasiswa
        $materials = Material::query()
            ->whereIn('course_id', $courses->pluck('id'))
            ->when($this->selectedCourse !== 'all', function ($q) {
                $q->where('course_id', (int) $this->selectedCourse);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.mahasiswa.materials', [
            'materials' => $materials,
            'courses'   => $courses,
        ]);
    }
}
