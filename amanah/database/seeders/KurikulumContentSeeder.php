<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteManage;

class KurikulumContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'section' => 'header_kurikulum',
                'title' => 'Kurikulum IDBC',
                'content' => 'Struktur kurikulum yang dirancang untuk membentuk kader <span class="font-semibold">Da\'i Teknopreneur</span> yang berkarakter dan berkompetensi tinggi.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'overview_kurikulum',
                'title' => 'Sistem Pembelajaran & Kurikulum di IDBC',
                'content' => 'Di IDBC (Islamic Digital Boarding College), kami percaya bahwa pendidikan terbaik adalah yang tidak hanya membentuk kecerdasan intelektual, tetapi juga membangun karakter, keterampilan hidup, dan kesiapan menghadapi dunia nyata yang terus berkembang—baik di ranah teknologi, komunikasi, maupun spiritualitas.',
                'additional_content' => [
                    'description' => 'Oleh karena itu, kurikulum yang kami terapkan dirancang secara terpadu, modern, dan aplikatif. Kami menggabungkan ilmu agama, keterampilan digital, dan pengembangan diri dalam satu kesatuan pembelajaran yang seimbang. Seluruh peserta didik akan mendapatkan pengalaman belajar secara praktik langsung, dengan pendekatan proyek nyata (project-based learning) yang membuat mereka tidak hanya tahu, tapi juga bisa dan siap kerja.',
                    'learning_approaches' => [
                        [
                            'title' => 'Pendekatan Pembelajaran',
                            'icon' => '<i class="fas fa-book-open text-xl"></i>',
                            'description' => 'Gabungan pembelajaran teori, praktik langsung, dan pendekatan berbasis proyek nyata.'
                        ],
                        [
                            'title' => 'Metode Pembelajaran',
                            'icon' => '<i class="fas fa-chalkboard-teacher text-xl"></i>',
                            'description' => 'Pembinaan karakter melalui mentoring intensif dan kegiatan sosial yang aplikatif.'
                        ],
                        [
                            'title' => 'Tujuan Pendidikan',
                            'icon' => '<i class="fas fa-bullseye text-xl"></i>',
                            'description' => 'Mencetak generasi berakhlak mulia, melek digital, dan siap bersaing di era industri 4.0.'
                        ]
                    ]
                ],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'curriculum_structure',
                'title' => 'Struktur Kurikulum IDBC',
                'additional_content' => [
                    'curricula' => [
                        [
                            'name' => 'Kurikulum Umum',
                            'description' => 'Pondasi ilmu agama dan keterampilan dasar penting dalam kehidupan dan dunia profesional.',
                            'subjects' => [
                                'Fiqih & Aqidah',
                                'Adab & Parenting',
                                'Muhadaroh & Munadaroh',
                                'Public Speaking & Jurnalistik',
                                'Entrepreneurship (Digital Marketing, Business Plan, Marketing Plan, Marketplace)',
                                'Microsoft Office',
                                'Pengambilan Foto & Video',
                                'Desain Grafis',
                                'HTML & CSS',
                                'Hardware & Jaringan'
                            ]
                        ],
                        [
                            'name' => 'Desain Multimedia',
                            'description' => 'Pembelajaran intensif dunia kreatif dan multimedia untuk kebutuhan digital profesional.',
                            'subjects' => [
                                'Digital Printing & Publishing',
                                'Desain Grafis & UI (User Interface)',
                                'Animasi dengan After Effect',
                                'Pengolahan Audio',
                                'Pengambilan Gambar Profesional',
                                'Pembuatan Situs dengan Wordpress'
                            ]
                        ],
                        [
                            'name' => 'Programming & Coding',
                            'description' => 'Kurikulum khusus untuk mempersiapkan peserta menjadi programmer andal.',
                            'subjects' => [
                                'HTML & CSS',
                                'Desain UI (User Interface)',
                                'Web Programming',
                                'Mobile App Development',
                                'Pemrograman Berbasis Proyek',
                                'Pengembangan Aplikasi Android/iOS'
                            ]
                        ]
                    ]
                ],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'educational_goals',
                'title' => 'Tujuan Pendidikan IDBC',
                'additional_content' => [
                    'goals' => [
                        [
                            'title' => 'Lulusan Berakhlak Mulia',
                            'icon' => '<i class="fas fa-graduation-cap"></i>',
                            'description' => 'Menghasilkan lulusan yang berakhlak mulia dan berwawasan Islam secara komprehensif.'
                        ],
                        [
                            'title' => 'Penguasaan Teknologi',
                            'icon' => '<i class="fas fa-laptop-code"></i>',
                            'description' => 'Menguasai teknologi terkini dan mampu bersaing di era transformasi digital.'
                        ],
                        [
                            'title' => 'Jiwa Entrepreneur',
                            'icon' => '<i class="fas fa-chart-line"></i>',
                            'description' => 'Memiliki jiwa entrepreneur dan kemandirian ekonomi melalui pengembangan bisnis digital.'
                        ],
                        [
                            'title' => 'Kontributor Masyarakat',
                            'icon' => '<i class="fas fa-users"></i>',
                            'description' => 'Siap menjadi pemimpin dan kontributor positif di masyarakat sebagai Da\'i Teknopreneur.'
                        ]
                    ],
                    'goals_images' => [
                        [
                            'title' => 'Visi Pendidikan IDBC',
                            'icon' => '<i class="fas fa-bullseye text-6xl text-teal-700"></i>',
                            'description' => "Membentuk kader Da'i Teknopreneur yang unggul dalam ilmu agama, teknologi, dan kewirausahaan.",
                            'points' => [
                                [
                                    'name' => 'Agama',
                                    'icon' => '<i class="fas fa-mosque text-2xl text-teal-600 mb-2"></i>',
                                ],
                                [
                                    'name' => 'Teknologi',
                                    'icon' => '<i class="fas fa-laptop-code text-2xl text-emerald-600 mb-2"></i>',
                                ],
                                [
                                    'name' => 'Bisnis',
                                    'icon' => '<i class="fas fa-chart-line text-2xl text-cyan-600 mb-2"></i>',
                                ]
                            ]
                        ],
                    ],
                    'quote_icon' => '<i class="fas fa-quote-left text-2xl text-gray-500"></i>',
                    'quote' => 'Dengan dukungan pengajar profesional, pendekatan praktis, dan fasilitas yang menunjang, kami berkomitmen mencetak generasi yang berakhlak mulia, melek digital, dan siap bersaing di era industri 4.0 dan seterusnya.'
                ],
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $content) {
            SiteManage::create($content);
        }
    }
}
