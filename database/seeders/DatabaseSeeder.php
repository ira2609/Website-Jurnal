<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Memoa User',
            'username' => 'memoa',
            'email' => 'test@example.com',
            'bio' => 'Personal notebook for ideas, study notes, and drafts.',
            'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=200&q=80',
        ]);

        $sampleNotes = [
            [
                'title' => 'Laravel CRUD berhasil jadi',
                'content' => 'Sesi hari ini produktif: tampilan catatan sudah responsif, form create/edit sudah berjalan, dan mood tracker bekerja dengan baik.',
                'mood' => '😊 Happy',
                'is_favorite' => true,
            ],
            [
                'title' => 'Story Draft',
                'content' => 'Langit sore memantulkan bayangan merah muda di jendela, sementara ide babak berikutnya bergerak dari ingatan menjadi kata.',
                'mood' => '😍 Excited',
            ],
            [
                'title' => 'Meeting Notes: Applied Math',
                'content' => 'Fokus pada persamaan diferensial dan cara menulis penjelasan yang mudah dipahami untuk kelompok belajar besok.',
                'mood' => '😐 Neutral',
            ],
            [
                'title' => 'Fanfiction Outline',
                'content' => 'Bab 1: Pengenalan karakter. Bab 2: ketegangan meningkat ketika rencana rahasia dimulai.',
                'mood' => '😍 Excited',
                'is_favorite' => true,
            ],
            [
                'title' => 'Daily journal',
                'content' => 'Hari ini kepala terasa ringan. Menyelesaikan beberapa tugas dan menikmati jeda menulis sambil minum kopi.',
                'mood' => '😊 Happy',
            ],
            [
                'title' => 'Idea: Minimal workspace app',
                'content' => 'Sebuah catatan yang fokus pada fitur utama: penjadwalan, mood, kategori, dan akses cepat. Tidak perlu berlebihan.',
                'mood' => '😴 Tired',
            ],
        ];

        foreach ($sampleNotes as $noteData) {
            $noteData['user_id'] = $user->id;
            Note::create($noteData);
        }
    }
}
