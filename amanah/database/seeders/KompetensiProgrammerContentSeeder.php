<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteManage;

class KompetensiProgrammerContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'section' => 'header_kompetensi_programmer',
                'title' => 'Kompetensi Programmer',
                'content' => 'Membentuk developer profesional dengan integritas keislaman',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'overview_programmer',
                'title' => 'Programming Profesional',
                'content' => 'Kurikulum berbasis proyek nyata',
                'additional_content' => [
                    'left' => [
                        'title' => 'Orientasi Pembelajaran',
                        'description' => 'Kami berkomitmen mencetak programmer yang tidak hanya mahir dalam aspek teknis, tetapi juga berlandaskan nilai-nilai Islam dan memiliki jiwa kewirausahaan. Dengan bekal integritas, kecakapan digital, serta semangat inovatif, mereka siap mengembangkan solusi digital yang bermanfaat dan berdaya saing',
                        'quote' => 'Setiap baris kode bukan sekadar membuat sistem berjalan, tapi mengandung makna dan tanggung jawab yang harus dijaga.',
                        'learning_method' => [
                            'title' => 'Metode Pembelajaran',
                            'icon' => '<i class="fas fa-laptop-code"></i>',
                            'description' => '80% praktik coding langsung, 15% teori, dan 5% mentoring karakter melalui proyek nyata.',
                        ],
                    ],

                    'right' => [
                        'title' => 'Teknologi Inti',
                        [
                            'no' => 1,
                            'title' => 'Frontend Development',
                            'description' => 'HTML5, CSS, Responsive Design, UI/UX Principles',
                        ],
                        [
                            'no' => 2,
                            'title' => 'Backend Development',
                            'description' => 'PHP, Laravel, Express, Database Design, API Development',
                        ],
                        [
                            'no' => 3,
                            'title' => 'Mobile Development',
                            'description' => 'Flutter dan Mobile UI/UX',
                        ],
                    ],
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'benefits_programmer',
                'title' => 'Keunggulan Program',
                'content' => '',
                'additional_content' => [
                    'points' => [
                        [
                            'icon' => '<i class="fas fa-award text-2xl"></i>',
                            'name' => 'Sertifikasi Pelatihan',
                            'description' => 'Sebagai bukti nyata telah menyelesaikan pelatihan',
                        ],
                        [
                            'icon' => '<i class="fas fa-project-diagram text-2xl"></i>',
                            'name' => 'Portofolio Nyata',
                            'description' => 'Aplikasi siap untuk profesional',
                        ],
                        [
                            'icon' => '<i class="fas fa-user-tie text-2xl"></i>',
                            'name' => 'Mentor Berpengalaman',
                            'description' => 'Praktisi industri teknologi',
                        ],
                    ],
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'features',
                'title' => 'Fitur Tambahan',
                'content' => '',
                'additional_content' => [
                    'points' => [
                        [
                            'icon' => '<i class="fas fa-book-quran"></i>',
                            'name' => 'Nilai Islami',
                            'description' => 'Integrasi etika islam dalam pengembangan software',
                        ],
                        [
                            'icon' => '<i class="fas fa-users"></i>',
                            'name' => 'Team Project',
                            'description' => 'Pengalaman kerja tim seperti di dunia profesional',
                        ],
                        [
                            'icon' => '<i class="fas fa-briefcase"></i>',
                            'name' => 'Eksplorasi Dunia Industri',
                            'description' => 'Menjelajahi wawasan dunia kerja bersama para pengajar profesional',
                        ],
                        [
                            'icon' => '<i class="fas fa-rocket"></i>',
                            'name' => 'Startup Incubation',
                            'description' => 'Pembinaan untuk mengembangkan startup digital',
                        ],
                    ],
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'call_to_action_programmer',
                'title' => 'Siap Menjadi Programmer Profesional?',
                'content' => 'Bergabunglah dengan program kami dan raih kompetensi programming dengan nilai-nilai islami.',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $content) {
            SiteManage::create($content);
        }
    }
}