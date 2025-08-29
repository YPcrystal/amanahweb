<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteManage;

class KompetensiDesainContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'section' => 'header_kompetensi_desain',
                'title' => 'Kompetensi Desain Multimedia',
                'content' => 'Membentuk kreator visual yang kompeten dengan integritas keislaman',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section' => 'overview_desain',
                'title' => 'Desain Multimedia Profesional',
                'content' => 'Kurikulum berbasis proyek nyata',
                'additional_content' => [
                    'left' => [
                        'title' => 'Orientasi Pembelajaran',
                        'description' => 'Kami berkomitmen membentuk desainer multimedia yang tidak hanya unggul dalam kemampuan teknis dan kreativitas visual, tetapi juga memiliki karakter Islami yang kuat dan jiwa kewirausahaan yang visioner. Dengan perpaduan nilai-nilai spiritual, keterampilan profesional, dan mindset bisnis, lulusan kami siap menjadi inovator yang mampu bersaing di industri kreatif berbasis nilai.',
                        'quote' => 'Karya yang baik bermula dari niat tulus, bermakna, dan disertai tanggung jawab yang jelas.',
                        'learning_method' => [
                            'title' => 'Metode Pembelajaran',
                            'icon' => '<i class="fas fa-laptop-code"></i>',
                            'description' => '80% praktik langsung, 10% teori, dan 10% mentoring karakter melalui proyek nyata.',
                        ],
                    ],

                    'right' => [
                        'title' => 'Materi Inti',
                        [
                            'icon' => '<i class="fas fa-print"></i>',
                            'title' => 'Digital Printing & Publishing',
                            'description' => 'Mempelajari cara mencetak desain menggunakan teknik dan kualitas yang sesuai dengan kebutuhan profesional, seperti sablon, offset, atau digital printing.',
                        ],
                        [
                            'icon' => '<i class="fas fa-paint-brush"></i>',
                            'title' => 'Desain Grafis & UI/UX',
                            'description' => 'Merancang tampilan aplikasi atau website agar menarik secara visual, mudah digunakan, dan memudahkan penggunaan UX.',
                        ],
                        [
                            'icon' => '<i class="fas fa-film"></i>',
                            'title' => 'Animasi & Video Editing',
                            'description' => 'Membuat animasi grafis bergerak dengan teknik yang terstruktur dan hasil berkualitas tinggi.',
                        ],
                        [
                            'icon' => '<i class="fas fa-camera"></i>',
                            'title' => 'Fotografi Digital',
                            'description' => 'Mempelajari cara mengambil foto untuk keperluan bisnis seperti iklan, katalog produk, atau branding agar hasilnya menarik dan menjual.',
                        ],
                    ],
                ],
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section' => 'benefits_desain',
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
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section' => 'call_to_action_desain',
                'title' => 'Siap Menjadi Desainer Profesional?',
                'content' => 'Bergabunglah dengan program kami dan raih kompetensi desain multimedia dengan nilai-nilai islami.',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $content) {
            SiteManage::create($content);
        }
    }
}