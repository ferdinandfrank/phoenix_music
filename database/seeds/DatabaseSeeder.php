<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'name'     => 'Ferdinand Frank',
                'email'    => 'ferdinand.frank@phoenixmusicproductions.com',
                'password' => bcrypt('password'),
                'birthday' => \App\Utils\LocalDate::create(1994, 8, 25),
                'role'     => 'Composer / Web Developer',
                'about'    => 'Born with a huge passion for epic music, Ferdinand started to make music at the age of eigth through playing the trumpet. Seven years later he switched to the classical piano and started to compose epic music together with his friend Alexander. On the same year Phoenix Music was founded...<br/> After graduation from school, Ferdinand is now studying Internet Computing at the University of Passau.',
                'image'    => 'ferdinand_frank.jpg',
                'facebook' => 'ferdinandfrank717',
            ],
            [
                'name'     => 'Alexander Richstein',
                'email'    => 'alexander.richstein@phoenixmusicproductions.com',
                'password' => bcrypt('password'),
                'birthday' => \App\Utils\LocalDate::create(1990, 11, 24),
                'role'     => 'Composer',
                'about'    => null,
                'image'    => 'alexander_richstein.jpg',
                'facebook' => 'alexander.richstein',
            ]
        ];

        $categories = [
            ['title' => 'Album Track'],
            ['title' => 'TrailerMusic'],
            ['title' => 'Sound'],
            ['title' => 'Logo'],
            ['title' => 'MenuTheme'],
        ];

        $albums = [
            [
                'title'        => 'The First Spirit',
                'image'        => 'the_first_spirit.jpg',
                'description'  => null,
                'published_at' => \App\Utils\LocalDate::create(2014, 11, 13),
            ],
        ];

        $tracks = [
            [
                'title'        => 'Intense Whoosh Sounds',
                'description'  => 'Intense Whoosh Sounds, which are perfect for logos, intros or transition and movement soundeffects.',
                'composer_id'  => 1,
                'file'         => 'intense_whoosh_sounds.mp3',
                'length'       => '0:13, 0:15, 0:11, 0:09, 0:11',
                'bpm'          => '110',
                'published_at' => '2012-12-10',
                'tags'         => 'aggressive, dramatic, drums, full, hit, horror, hybrid, intense, intro, long, loud, preview, rising, scream, short, trailer, website, whoosh',
                'category_id'  => 3,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'intense-whoosh-sounds/3552113',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Survival and Horror Menu Theme',
                'description'  => 'This is a survival menu music theme, which is perfect for the menu screen of survival games, horror games or horror movies. But it would also fit perfectly as the background music of a horror or survival game.',
                'composer_id'  => 1,
                'file'         => 'survival_menu_theme.mp3',
                'length'       => '1:36, 1.36, 1:36, 1:36',
                'bpm'          => '90',
                'published_at' => '2016-03-09',
                'tags'         => 'background, dark, epic, episch, game, horror, menu, menue, radio, riser, scary, screams, screen, sounds, survival, trailer, videogame, whoosh, wild',
                'category_id'  => 5,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'survival-and-horror-menu-theme/14749262',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Intense Banner Intro',
                'description'  => 'These intense banner intro sounds are perfect for short intros, outros, websites and anything else you can imagine.',
                'composer_id'  => 1,
                'file'         => 'intense_banner_intro.mp3',
                'length'       => '0:12, 0:14, 0:16, 0:16, 0:16, 0:19, 0:21, 0:21, 0:21, 0:21',
                'bpm'          => '90',
                'published_at' => '2012-12-26',
                'tags'         => 'aggressive, drums, hard, hits, hybrid, intense, long, risers, short, sound, stingers, taiko, whoosh',
                'category_id'  => 3,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'intense-banner-intro-/edit/3644660',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [

                'title'        => 'Intense Whoosh Sounds 2',
                'description'  => 'Number 2 of our intense whoosh sounds. These sounds are perfect for any logo intro or transition sound effect.

These sounds are perfect for intros, trailers, websites and more. ',
                'composer_id'  => 1,
                'file'         => 'intense_whoosh_sounds2.mp3',
                'length'       => '0:11, 0:11, 0:11, 0:11',
                'bpm'          => '110',
                'published_at' => '2013-01-11',
                'tags'         => 'aggressive, dark, drama, dramatic, drums, epic, hits, horror, hybrid, immense, intense, intro, loud, new, pack, rising, sound, stingers, trailer, voice',
                'category_id'  => 3,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'intense-whoosh-sounds-2/3728250',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Horror Menu Music',
                'description'  => 'This is an intense horror music theme, which is perfect for the menu screen of horror games or horror movies. But it would also fit perfectly as the background music of a horror game.',
                'composer_id'  => 1,
                'file'         => 'horror_menu_music.mp3',
                'length'       => '1:53',
                'bpm'          => '135',
                'published_at' => '2013-01-25',
                'tags'         => 'action, drama, drums, game, hits, horror, hybrid, intense, kids, laugh, menu, menue, riser, scary, screen, selection, sound, swoosh, voice, whoosh',
                'category_id'  => 5,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'horror-menu-music/3800426',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Intense Epic Hybrid Orchestra Trailer',
                'description'  => 'This is a powerful and dramatic, motivating soundtrack, including big powerful hits with epic spicatto string, which is perfect for videos, movies or trailers.',
                'composer_id'  => 2,
                'file'         => 'intense_epic_hybrid_orchestra_trailer.mp3',
                'length'       => '2:50',
                'bpm'          => '95',
                'published_at' => '2014-11-04',
                'tags'         => 'action, bass, beat, choir, dramatic, drums, epic, guitar, hits, hybrid, instense, intro, orchestra, phoenix music, powerfull, saw, sound, strings, strong, trailer, violine, youtube',
                'category_id'  => 2,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'intense-epic-hybrid-orchestra-trailer/9358552',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'A New Day',
                'description'  => 'This is an uplifting and epic soundtrack, which is perfect for videos, movies or trailers. It´s a track full of harmony and melody.',
                'composer_id'  => 2,
                'file'         => 'a_new_day.mp3',
                'length'       => '2:07, 2:07',
                'bpm'          => '80',
                'published_at' => '2014-11-06',
                'tags'         => 'adventure, beautiful, chello, choir, classic, discover, dramatic, drums, epic, game, happy, intro, motivating, motivation, motivational, movie, music, orchestra, pan, piano, score, soundtrack, strings, taikos, trailer, uplifting, video, voice',
                'category_id'  => 2,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'a-new-day/9383108',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Rock On Ident',
                'description'  => 'An upbeat with guitars and diverse percussion beats, which can be perfectly used as a logo theme.',
                'composer_id'  => 2,
                'file'         => 'rock_on_ident.mp3',
                'length'       => '0:17',
                'bpm'          => '140',
                'published_at' => '2014-11-24',
                'tags'         => 'background, beat. rock, business, confidence, corporate, delight, documentary, drums, faith, film, game, guitar, happy, hope, industry, modern, motivational, percussion, podcast, positive, presentation, radio, sunny, tv, uplifting, upright, web',
                'category_id'  => 4,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'rock-on-ident/9465653',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [

                'title'        => 'Sunrise Earth',
                'description'  => 'This is a dramatic and uplifting soundtrack, which is perfect for videos, movies or trailers.
',
                'composer_id'  => 2,
                'file'         => 'sunrise_earth.mp3',
                'length'       => '1:45, 1:45',
                'bpm'          => '120',
                'published_at' => '2014-11-17',
                'tags'         => 'background, beautiful, big, cinematic, dramatic, dreamy, emotional, epic, ethno, exploration, fulfilling, hopeful, inspiration, inspirational, inspired, inspiring, montage, motivating, motivational, moving, orchestra, reflective, sentimental, sunrise, trailer, uplifting, voice, wonder, world',
                'category_id'  => 2,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'sunrise-earth/9487437',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Quantum Energy',
                'description'  => 'This is an action and inspiring hybrid soundtrack, which is perfect for intros/outros or trailers.',
                'composer_id'  => 2,
                'file'         => 'quantum_energy.mp3',
                'length'       => '0:20, 4:48, 1:49, 0:50',
                'bpm'          => '95',
                'published_at' => '2015-01-09',
                'tags'         => 'action, adventure, advertise, background, choir, dramatic, energetic, epic, exciting, fast, heroic, hollywood, hybrid, intro, modern, motivating, motivation, movie, orchestra, piano, powerful, promotion, race, strong, trailer, triumphant, uplifting, video game',
                'category_id'  => 2,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'quantum-energy/9991637',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Rising Skylands',
                'description'  => 'This is an uplifting and dramatic orchestra soundtrack, which is perfect for videos, movies or trailers. It´s a track full of harmony and melody.',
                'composer_id'  => 2,
                'file'         => 'rising_skylands.mp3',
                'length'       => '1:11, 1:17, 1:08',
                'bpm'          => '125',
                'published_at' => '2015-01-24',
                'tags'         => 'adventure, beautiful, chello, choir, classic, courage, discover, dramatic, drums, energetic, epic, game, heroic, intro, motivating, motivation, motivational, noble, orchestra, orchestral, patriotic, soundtrack, strings, strong, taikos, trailer, triumphant, uplifting',
                'category_id'  => 2,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'rising-skylands/10127558',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Epic Hybrid Riser Ident',
                'description'  => 'An epic, hybrid riser sound, that can be perfectly used for intros, logos and much more.',
                'composer_id'  => 1,
                'file'         => 'epic_hybrid_riser_ident.mp3',
                'length'       => '0:29, 0:29, 0:14, 0:14',
                'bpm'          => '120',
                'published_at' => '2015-03-17',
                'tags'         => 'action, aggressive, drums, epic, episch, hit, hybrid, intense, intro, logo, music, orchestral, phoenix, rhythm, sound, strings, swoosh, whoosh, woosh',
                'category_id'  => 4,
                'image'        => null,
                'album_id'     => null,
                'audiojungle'  => 'epic-hybrid-riser-ident/10651407',
                'stye'         => null,
                'cdbaby'       => null,
                'amazon'       => null,
                'itunes'       => null
            ],
            [
                'title'        => 'Fire And Passion',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 2,
                'file'         => 'fire_and_passion.mp3',
                'length'       => '1:19',
                'bpm'          => '140',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, electro, trailer music, choir, action, dramatic, hybrid, strings',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => null,
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Forbidden Love',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 1,
                'file'         => 'forbidden_love.mp3',
                'length'       => '4:15',
                'bpm'          => '120',
                'published_at' => '2014-11-13',
                'tags'         => 'piano, strings, uplifting, drums, emotional',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => 'http://www.stye.sourceaudio.com/#!details?id=4775183',
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Force Of Time',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 2,
                'file'         => 'force_of_time.mp3',
                'length'       => '2:22',
                'bpm'          => '100',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, piano, uplifting, choir, strings, trailer music',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => 'http://www.stye.sourceaudio.com/#!details?id=4775176',
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Glory And Honor',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 1,
                'file'         => 'glory_and_honor.mp3',
                'length'       => '4:09',
                'bpm'          => '140',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, strings, dark, horns, choir, dramatic, action, drums, trailer music',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => 'http://www.stye.sourceaudio.com/#!details?id=4775197',
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Guardians Of The Earth',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 2,
                'file'         => 'guardians_of_the_earth.mp3',
                'length'       => '4:25',
                'bpm'          => '125',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, piano, uplifting, choir, strings, trailer music, dramatic, hybrid',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => 'guardians-of-the-earth/14694791',
                'stye'         => null,
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Planet Earth',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 2,
                'file'         => 'planet_earth.mp3',
                'length'       => '4:11',
                'bpm'          => '140',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, piano, uplifting, choir, strings, trailer music',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => 'http://www.stye.sourceaudio.com/#!details?id=4775194',
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Reflections',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 2,
                'file'         => 'reflections.mp3',
                'length'       => '2:08',
                'bpm'          => '100',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, choir, strings, trailer music, horns, piano, dramatic',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => 'http://www.stye.sourceaudio.com/#!details?id=4775187',
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [

                'title'        => 'Run',
                'description'  => 'An epic, uplifting and adventurous trailer music track, that fits perfectly to any kind of epic project. This track was also realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.
',
                'composer_id'  => 1,
                'file'         => 'run.mp3',
                'length'       => '3:33',
                'bpm'          => '140',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, uprising, choir, strings, trailer music',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => 'run/14533807',
                'stye'         => null,
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'Starbreaker',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 1,
                'file'         => 'starbreaker.mp3',
                'length'       => '3:22',
                'bpm'          => '100',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, strings, piano, horns, drums, choir',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => null,
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [

                'title'        => 'Sword Of Faith',
                'description'  => 'An heroic, inspirational and dramatic trailer music track, including fast string melodies, rhytmic drums and melodic horns and choir, that fits perfectly to any kind of epic project.
This track was also realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 1,
                'file'         => 'sword_of_faith.mp3',
                'length'       => '3:45',
                'bpm'          => '85',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, choir, strings, trailer music, horns, piano, dramatic, action, drums',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => 'sword-of-faith/14533600',
                'stye'         => null,
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [

                'title'        => 'Vindictus',
                'description'  => 'An epic and dramatic orchestral track, including epic string parts, massive drums, horns and a melodic background choir, which will fit to any kind of epic project like movies, videogames, trailers, intros, or any other kind of awesome project you can imagine.
This track is also part of the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 1,
                'file'         => 'vindictus.mp3',
                'length'       => '4:30',
                'bpm'          => '80',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, choir, strings, trailer music, horns, dramatic',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => 'vindictus/14533499',
                'stye'         => null,
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ],
            [
                'title'        => 'World Of Tomorrow',
                'description'  => 'An epic track, realeased on the first public album of Phoenix Music, called <i>The First Spirit</i>.',
                'composer_id'  => 2,
                'file'         => 'world_of_tomorrow.mp3',
                'length'       => '2:30',
                'bpm'          => '95',
                'published_at' => '2014-11-13',
                'tags'         => 'epic, choir, strings, trailer music, piano, dramatic',
                'category_id'  => 1,
                'image'        => 'the_first_spirit.jpg',
                'album_id'     => 1,
                'audiojungle'  => null,
                'stye'         => 'http://www.stye.sourceaudio.com/#!details?id=4775186',
                'cdbaby'       => 'phoenixmusic2',
                'amazon'       => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1',
                'itunes'       => 'phoenix-music/id936603454'
            ]
        ];

        $settings = [
            [
                'key'   => 'page_title',
                'value' => 'Phoenix Music - Music For Motion Pictures And Motion Picture Advertising'
            ],
            [
                'key'   => 'page_keywords',
                'value' => 'epic music, trailer music, epic, trailer, music, choir, classic, composer, young, library, phoenix, phoenix music, phoenix music productions,
							the first spirit, first spirit, episch, orchester, chor, soundtrack, sounddesign, sounds, hybrid'
            ],
            [
                'key'   => 'page_description',
                'value' => 'Phoenix Music is an independent epic music company of the two composers Alexander Richstein and Ferdinand Frank from Munich, Germany.
								Founded in 2010, Phoenix Music is focused on composing tracks and sounds for trailers, video games, movies and advertisements.'
            ],
            [
                'key'   => 'page_author',
                'value' => 'Ferdinand Frank'
            ],
            ['key'   => 'amazon',
             'value' => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1'
            ],
            ['key'   => 'iTunes',
             'value' => 'phoenix-music/id936603454'
            ],
            ['key' => 'cdbaby', 'value' => 'phoenixmusic2'],
            ['key'   => 'audiojungle',
             'value' => 'user/phoenixmusic'
            ],
            ['key' => 'stye', 'value' => '#!explorer?b=689545'],
            ['key' => 'facebook', 'value' => 'phoenixmusicofficial'],
            ['key' => 'twitter', 'value' => 'PhoenixMusic10'],
            ['key' => 'youtube', 'value' => 'PhoenixMusic10'],

            [
                'key'   => 'about',
                'value' => 'Phoenix Music is an independent music company of the two composers Alexander Richstein and Ferdinand Frank from Munich, Germany.<br/>
								Founded in 2010, Phoenix Music is focused on composing tracks and sounds for trailers, video games, movies and advertisements.<br/>
								The most of these tracks and sounds are available for licensing on AudioJungle or SongsToYourEyes.<br/>
                                But Phoenix Music doesn\'t only have music for licensing... <br/>
                                In November 2014, the first public album, called "The First Spirit", was released on CDBaby, Amazon, iTunes, Spotify and other platforms.'
            ],
            ['key'   => 'text_audiojungle',
             'value' => "Since November 2012, Phoenix Music is selling exclusive licensable tracks and sounds for trailers, intros, video games, movies and much more on Audiojungle."
            ],
            ['key'   => 'text_stye',
             'value' => "More than 20 exclusive tracks by Phoenix Music are available for licensing at the SongsToYourEyes library."
            ],

            ['key' => 'email_contact', 'value' => "info@phoenixmusicproductions.com"],
            ['key' => 'email_admin', 'value' => "admin@phoenixmusicproductions.com"],
        ];

        foreach ($users as $userData) {
            $user = new \App\Models\User($userData);
            $user->save();
        }

        foreach ($categories as $categoryData) {
            $category = new \App\Models\Category($categoryData);
            $category->save();
        }

        foreach ($albums as $albumData) {
            $album = new \App\Models\Album($albumData);
            $album->save();
        }

        foreach ($tracks as $trackData) {
            $track = new \App\Models\Track($trackData);
            $track->save();
        }

        foreach ($settings as $settingData) {
            $setting = new \App\Models\Settings($settingData);
            $setting->save();
        }

    }
}
