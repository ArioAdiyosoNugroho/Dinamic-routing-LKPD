<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Buat quiz utama
        $quiz = Quiz::create([
            'title'       => 'Kuis Dynamic Routing',
            'description' => 'Kuis ini menguji pemahaman tentang routing statis dan dinamis, khususnya protokol RIP v2.',
            'duration'    => 15, // dalam menit
            'is_active'   => true,
        ]);

        // Tambahkan soal-soal
        $q1 = $quiz->questions()->create([
            'question' => 'Apa perbedaan utama antara static dan dynamic routing?'
        ]);
        $q1->choices()->createMany([
            ['choice' => 'Static manual, Dynamic otomatis', 'is_correct' => true],
            ['choice' => 'Keduanya sama saja', 'is_correct' => false],
            ['choice' => 'Dynamic lebih lambat', 'is_correct' => false],
            ['choice' => 'Static lebih efisien di jaringan besar', 'is_correct' => false],
        ]);

        $q2 = $quiz->questions()->create([
            'question' => 'Perintah untuk mengaktifkan RIP v2 pada router adalah ...'
        ]);
        $q2->choices()->createMany([
            ['choice' => 'router rip / version 2', 'is_correct' => true],
            ['choice' => 'enable ripv2', 'is_correct' => false],
            ['choice' => 'ip rip enable', 'is_correct' => false],
            ['choice' => 'network rip2', 'is_correct' => false],
        ]);

        $q3 = $quiz->questions()->create([
            'question' => 'Fungsi no auto-summary pada RIP v2 adalah ...'
        ]);
        $q3->choices()->createMany([
            ['choice' => 'Mencegah ringkasan otomatis', 'is_correct' => true],
            ['choice' => 'Menambah subnet mask', 'is_correct' => false],
            ['choice' => 'Menghapus routing RIP', 'is_correct' => false],
            ['choice' => 'Mengaktifkan static route', 'is_correct' => false],
        ]);

        $q4 = $quiz->questions()->create([
            'question' => 'Berapa hop count maksimum pada protokol RIP?'
        ]);
        $q4->choices()->createMany([
            ['choice' => '15 hop', 'is_correct' => true],
            ['choice' => '10 hop', 'is_correct' => false],
            ['choice' => '30 hop', 'is_correct' => false],
            ['choice' => 'Unlimited', 'is_correct' => false],
        ]);

        $q5 = $quiz->questions()->create([
            'question' => 'Alamat multicast RIP v2 untuk update routing adalah ...'
        ]);
        $q5->choices()->createMany([
            ['choice' => '224.0.0.9', 'is_correct' => true],
            ['choice' => '255.255.255.255', 'is_correct' => false],
            ['choice' => '224.0.0.5', 'is_correct' => false],
            ['choice' => '224.0.0.10', 'is_correct' => false],
        ]);
    }
}
