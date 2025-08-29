<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteManage;

class TentangKamiContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'section' => 'header_tentang_kami',
                'title' => 'Tentang Kami',
                'content' => 'Membangun generasi unggul yang berlandaskan <span class="font-semibold">adab</span> dan <span class="font-semibold">teknologi</span>.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'landasan_berfikir',
                'title' => 'Landasan Berfikir',
                'additional_content' => [
                    'arabic' => [
                        'لَقَدْ اَرْسَلْنَا رُسُلَنَا بِالْبَيِّنٰتِ وَاَنْزَلْنَا مَعَهُمُ الْكِتٰبَ وَالْمِيْزَانَ لِيَقُوْمَ النَّاسُ بِالْقِسْطِۚ',
                        'وَاَنْزَلْنَا الْحَدِيْدَ فِيْهِ بَأْسٌ شَدِيْدٌ وَّمَنَافِعُ لِلنَّاسِ وَلِيَعْلَمَ اللّٰهُ مَنْ يَّنْصُرُهٗ وَرُسُلَهٗ بِالْغَيْبِۗ',
                        'اِنَّ اللّٰهَ قَوِيٌّ عَزِيْزٌࣖ ۝٢٥'
                    ],
                    'translation' => 'Sungguh, Kami telah mengutus rasul-rasul Kami dengan membawa bukti-bukti yang nyata dan telah Kami turunkan bersama mereka Al Kitab dan neraca (keadilan) supaya manusia dapat melaksanakan keadilan. Dan Kami ciptakan besi yang padanya terdapat kekuatan yang hebat dan berbagai manfaat bagi manusia (supaya mereka mempergunakan besi itu) dan supaya Allah mengetahui siapa yang menolong (agama)-Nya dan rasul-rasul-Nya padahal Allah tidak dilihatnya. Sesungguhnya Allah Maha Kuat lagi Maha Perkasa.',
                    'reference' => 'QS. Al-Hadid: 25'
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'muqaddimah',
                'title' => 'Muqaddimah',
                'content' => '',
                'additional_content' => [
                    'paragraphs' => [
                        'Segala puji bagi Allah Rabb semesta alam, shalawat dan salam berlimpah kepada Rasulullah ﷺ, ahlul bait, sahabat, dan para pengikut setia beliau hingga kiamat. Pendidikan merupakan penentu masa depan seseorang dan peradaban manusia secara umum. Oleh karena itu, pendidikan adalah bidang strategis dalam kehidupan. Kemajuan dan karakter suatu bangsa ditentukan oleh sistem pendidikannya.',
                        'Islam sebagai agama sempurna yang diturunkan kepada manusia di muka bumi ini telah meletakkan konsep pendidikan, dan konsep itu telah terealisasi dalam pengawalan Nabi Utusan-Nya. Lahirnya generasi emas yang dijamin kebaikannya di tiga generasi pertama adalah bukti nyata dari keunggulan sistem pendidikan itu.',
                        'Berlalunya zaman, banyak terjadi degradasi karena secara pelan tapi pasti generasi belakangnya lalai terhadap konsep dan sistem pendidikan itu, akhirnya lahirlah kemunduran yang mengakibatkan kehinaan. Prof. DR. Syed Naquib Al Attas menyampaikan saat konferensi Pendidikan Internasional Pertama di Mekkah tahun 1977, faktor kemunduran yang menjadi problem besar umat adalah karena "loss of adab". Ini inti utama konsep pendidikan Islam yang kini hilang.',
                        'Menyadari hal tersebut, saatnya kini untuk kembali kepada nilai-nilai luhur tersebut, tentunya dengan menyesuaikan dengan perkembangan zaman. Abad 21 yang populer dengan era industri 4.0 saat ini perlu diintegrasikan dengan konsep pendidikan emas tersebut. **PENDIDIKAN BERBASIS ADAB & IT**, mungkin inilah konsep integrasi pendidikan ideal yang saat ini perlu kita mulai. Alhamdulillah, kami telah memulai konsep ini sejak lama. Mudah-mudahan ini bisa menjadi model bagi Lembaga Pendidikan yang lainnya.'
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'latar_belakang',
                'title' => 'Latar Belakang',
                'content' => 'Beberapa latar belakang dari kehadiran IDBC:',
                'additional_content' => [
                    'points' => [
                        'Mahalnya biaya pendidikan karena banyaknya biaya-biaya dan lamanya waktu yang ditempuh, tapi outputnya tetap standar.',
                        'Kemajuan teknologi digital dan tuntutan zaman yang terus berkembang.',
                        'Belum ada model pendidikan yang mengintegrasikan teknologi secara totalitas dalam proses pembelajaran.',
                        'Perlu adanya edukasi tentang teknologi agar teknologi dimanfaatkan secara maksimal sesuai fungsinya untuk kepentingan strategis, positif, dan produktif.'
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'visi_misi',
                'title' => 'Visi & Misi',
                'additional_content' => [
                    'visi' => 'Kaderisasi da\'i techno preneur yang berkarakter islami dan siap menghadapi tantangan global.',
                    'misi' => [
                        'Menjadi alternatif pendidikan yang efisien sesuai dengan syariat dan tuntutan zaman.',
                        'Optimalisasi dan integrasi teknologi dalam pendidikan dan dakwah.',
                        'Menerapkan konsep pendidikan Rabbani sesuai manhaj salaf.',
                        'Mewujudkan manusia menjadi hamba dan khalifah yang berdaya guna.'
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'keunggulan',
                'title' => 'Keunggulan',
                'additional_content' => [
                    'points' => [
                        'Berakhlak mulia.',
                        'Berjiwa da\'i, jago IT & pintar mengaji.',
                        'Mandiri dan punya bisnis sendiri.',
                        'Pembelajaran singkat, padat, dan efisien.',
                        'Mengembangkan potensi fitrah hingga menjadi expert.',
                        'Garansi kompetensi.'
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'sistem_pendidikan',
                'title' => 'Sistem Pendidikan',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Boarding',
                            'icon' => '<svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
                            'description' => 'Sistem pendidikan tertua dan paling efektif karena seluruh aktivitas 24 jam bisa terpantau, selalu bersanding dengan guru, dan berinteraksi dengan masyarakat.'
                        ],
                        [
                            'name' => 'Building',
                            'icon' => '<svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m-1 4h1m8-16v4h2m-2 0h2.5L21 9.5M17 11V7"></path></svg>',
                            'description' => 'Penempaan karakter setiap saat & termonitor secara langsung perkembangan seluruh aspek yang menjadi objek pendidikan yaitu olah hati, olah pikir, dan olah raga.'
                        ],
                        [
                            'name' => 'Teaching',
                            'icon' => '<svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
                            'description' => 'Pembelajaran klasikal ataupun halaqah dengan materi kurikulum yang telah ditentukan oleh guru atau musyrif.'
                        ],
                        [
                            'name' => 'Coaching',
                            'icon' => '<svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5m-1-9V4a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1h8m-1-9L16 9m4 0l-3 3-3-3m-2 0V9"></path></svg>',
                            'description' => 'Pendampingan intensif setiap anak untuk mengembangkan potensi dan skill agar bisa berkembang maksimal dan bisa menjadi modal menjalani hidup sesuai potensi dan skillnya.'
                        ],
                        [
                            'name' => 'Balancing',
                            'icon' => '<svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11V7a1 1 0 011-1h10a1 1 0 011 1v10a1 1 0 01-1 1h-2.5m-6.5-6.5l6.5 6.5m0 0H14m2 0v-2.5m-6.5-6.5h-2.5V7m0 2.5l-6.5 6.5"></path></svg>',
                            'description' => 'Mengawal dan mengajarkan keselarasan dan keseimbangan dalam berpikir dan bertindak baik untuk dunianya ataupun akhiratnya, untuk dirinya, keluarganya, dan orang lain.'
                        ]
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'model_pembelajaran',
                'title' => 'Model Pembelajaran',
                'image_path' => 'storage/images/diagram/diagram.png',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Pembelajaran Interaktif',
                            'icon' => '<i class="fas fa-chalkboard-teacher text-xl"></i>',
                            'description' => 'Sistem belajar dua arah dengan diskusi aktif dan studi kasus nyata yang relevan dengan kebutuhan industri terkini.'
                        ],
                        [
                            'name' => 'Praktik Langsung',
                            'icon' => '<i class="fas fa-laptop-code text-xl"></i>',
                            'description' => '80% waktu belajar diisi dengan praktik langsung menggunakan tools dan framework yang digunakan di dunia profesional.'
                        ],
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $content) {
            SiteManage::create($content);
        }
    }
}
