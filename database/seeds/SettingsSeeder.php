<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('settings')->insert([['key' => 'author', 'value' => 'Ferdinand Frank & Alexander Richstein'], ['key' => 'title', 'value' => 'Phoenix Music'],
            ['key' => 'email_contact', 'value' => 'info@phoenixmusicproductions.com'], ['key' => 'email_admin', 'value' => 'ferdinand@phoenixmusicproductions.com'], [
                'key'   => 'description',
                'value' => '<p>
    Phoenix Music is an independent music company of the two composers Alexander Richstein and Ferdinand Frank from Munich, Germany.
</p>
<p>
    Founded in 2010, Phoenix Music is focused on composing tracks and sounds for trailers, video games, movies and advertisements.
</p>
<p>
    The most of these tracks and sounds are available for licensing on AudioJungle or SongsToYourEyes.
</p>
<p>
    But Phoenix Music doesn\'t only have music for licensing...
</p>
<p>
    In November 2014, the first public album, called "The First Spirit", was released on CDBaby, Amazon, iTunes, Spotify and other platforms.
</p>'
            ], ['key' => 'keywords', 'value' => 'epic, phoenix, music, alexander, ferdinand, richstein, frank, trailer'],
            ['key' => 'logo', 'value' => '/storage/images/full_logo.png'], ['key' => 'background', 'value' => '/storage/images/background.jpg'],
            ['key' => 'favicon', 'value' => '/storage/images/favicon.png'], [
                'key'   => 'imprint',
                'value' => '<p class="">
    Ferdinand Frank<br>Mühlbachstraße 25b<br>82229 Seefeld<br>Germany<br>Phone: +49 157 565 535 12<br>E-Mail: ferdinand@phoenixmusicproductions.com
</p><p class="">and</p><p class="active">Alexander Richstein<br>Kienbachstraße 22<br>82211 Herrsching<br>Germany<br>E-Mail: alexander@phoenixmusicproductions.com</p>'
            ], ['key' => 'intro_video', 'value' => '/storage/videos/intro.mp4'], [
                'key'   => 'text_stye',
                'value' => '<p>
    More than 20 exclusive tracks by Phoenix Music are available for licensing at the SongsToYourEyes library.
</p>'
            ], [
                'key'   => 'text_audiojungle',
                'value' => '<p>
    Since November 2012, Phoenix Music is selling exclusive licensable tracks and sounds for trailers, intros, video games, movies and much more on Audiojungle.
</p>'
            ], ['key' => 'youtube', 'value' => 'PhoenixMusic10'], ['key' => 'twitter', 'value' => 'PhoenixMusic10'], ['key' => 'facebook', 'value' => 'phoenixmusicofficial'],
            ['key' => 'stye', 'value' => '#!explorer?b=689545'], ['key' => 'audiojungle', 'value' => 'user/phoenixmusic'], ['key' => 'cdbaby', 'value' => 'phoenixmusic2'],
            ['key' => 'iTunes', 'value' => 'phoenix-music'],
            ['key' => 'amazon', 'value' => 'B00P7UCMC2?ie=UTF8&keywords=phoenix%20music%20the%20first%20spirit&qid=1453488466&ref_=sr_1_1&sr=8-1'],
            ['key' => 'privacy_policy', 'value' => '<h2><strong>§ 1 Information about the collection of personal data</strong></h2>
            (1) In the following, we provide information about the collection of personal data when using our website. Personal data are all data that are personally identifiable to you, e.g. name, address, e-mail addresses, user behavior.</p>
            (2) Responsible persons according to art. 4 para. 7 EU Data Protection Basic Regulation (DS-GMO) are Ferdinand Frank (ferdinand@phoenixmusicproductions.com) and Alexander Richstein (alexander@phoenixmusicproductions.com) (see our <a href="https://phoenixmusicproductions.com/contact" target="_blank">Imprint</a>).</p>
            When you contact us by e-mail or via a contact form, the information you provide will be stored by us to answer your questions. We delete the data arising in this connection after the storage is no longer necessary or limit the processing, if legal storage obligations exist.</p>
            <h2><strong>§ 2 Your rights</strong></h2><p>(1) You have the following rights towards us regarding the personal data concerning you:</p><ul><li><li>Right to information,</li><li><li>Right to correction or deletion,</li><li><li>Right to processing restriction,</li><li><li>Right to data transfer,</li><li>Right to objection,</li><li>Right to receive a copy,</li><li><li>Right to completion.</li></ul>
            If you give us your consent, you have the right to revoke the consent at any time. This does not affect the legality of the processing carried out on the basis of the consent until revocation.</p>
            You also have the right to complain to a data protection supervisory authority about our processing of your personal data.</p>
            <h2><strong>§ 3 Collection of personal data</strong></h2><p>(1) When you use our website, cookies are stored on your computer. Cookies are small text files that are assigned and stored on your hard disk to the browser you use and through which certain information flows to the place that sets the cookie (here by us). Cookies cannot run programs or transmit viruses to your computer.</p>
            This Web site uses persistent cookies, the scope and functionality of which are explained below.</p>
            <p> (a) Persistent cookies are automatically deleted after a specified period, which may vary depending on the cookie. You can delete cookies at any time in the security settings of your browser.</p>
            <p>(b) You can configure your browser settings to suit your preferences, such as rejecting third party cookies or all cookies.</p>
            <p>(c) We use cookies to ensure the security of our website.</p>
            <h2><strong>§ 4 Objection</strong></h2><p>As far as we base the processing of your personal data, date and time of your inquiry (technical data), on the weighing of interests (Art. 6 I 1 f DSGVO), you can file an objection against the processing. This is the case if the processing is not necessary in particular for the fulfilment of a contract with you, which is described by us in the description of the functions (§ 5). When exercising such objection, we ask you to explain the reasons why we should not process your personal data as we have done. In the event of your justified objection, we will examine the situation and either stop or adjust data processing or point out to you our compelling reasons worthy of protection, on the basis of which we will continue processing.</p></div>'],
            ['key' => 'privacy_policy_de', 'value' => '
            <h2><strong>§ 1 Informationen über die Erhebung personenbezogener Daten</strong></h2>
            <p>(1) Im Folgenden informieren wir über die Erhebung personenbezogener Daten bei Nutzung unserer Website. Personenbezogene Daten sind alle Daten, die auf Sie persönlich beziehbar sind, z.B. Name, Adresse, E-Mail-Adressen, Nutzerverhalten.</p>
            <p>(2) Verantwortliche nach Art. 4 Abs. 7 EU-Datenschutz-Grundverordnung (DS-GVO) sind Ferdinand Frank (ferdinand@phoenixmusicproductions.com) und Alexander Richstein (alexander@phoenixmusicproductions.com) (siehe unser <a href="https://phoenixmusicproductions.com/contact" target="_blank">Impressum</a>).</p>
            <p>(3) Bei Ihrer Kontaktaufnahme mit uns per E-Mail oder über ein Kontaktformular werden die von Ihnen mitgeteilten Daten von uns gespeichert, um Ihre Fragen zu beantworten. Die in diesem Zusammenhang anfallenden Daten löschen wir nachdem die Speicherung nicht mehr erforderlich ist oder schränken die Verarbeitung ein, falls gesetzliche Aufbewahrungspflichten bestehen.</p>
            <h2><strong>§ 2 Ihre Rechte</strong></h2><p>(1) Sie haben gegenüber uns folgende Rechte hinsichtlich der Sie betreffenden personenbezogenen Daten:</p><ul><li>Recht auf Auskunft,</li><li>Recht auf Berichtigung oder Löschung,</li><li>Recht auf Verarbeitungseinschränkung,</li><li>Recht auf Datenübertragung,</li><li>Recht auf Widerspruch,</li><li>Recht auf Erhalt einer Kopie,</li><li>Recht auf Vervollständigung.</li></ul>
            <p>(2) Insoweit Sie uns eine Einwilligung erteilen, haben Sie das Recht die Einwilligung jederzeit zu widerrufen. Dabei wird die Rechtmäßigkeit der aufgrund der Einwilligung bis zum Widerruf erfolgten Verarbeitung nicht berührt.</p>
            <p>(3) Sie haben zudem das Recht, sich bei einer Datenschutz-Aufsichtsbehörde über die Verarbeitung Ihrer personenbezogenen Daten durch uns zu beschweren.</p>
            <h2><strong>§ 3 Erhebung personenbezogener Daten</strong></h2><p>(1) Bei Ihrer Nutzung unserer Website werden Cookies auf Ihrem Rechner gespeichert. Bei Cookies handelt es sich um kleine Textdateien, die auf Ihrer Festplatte dem von Ihnen verwendeten Browser zugeordnet und gespeichert werden und durch welche der Stelle, die den Cookie setzt (hier durch uns), bestimmte Informationen zufließen. Cookies können keine Programme ausführen oder Viren auf Ihren Computer übertragen.</p>
            <p>(2) Diese Website nutzt persistente Cookies, deren Umfang und Funktionsweise im Folgenden erläutert wird.</p>
            <p>		(a) Persistente Cookies werden automatisiert nach einer vorgegebenen Dauer gelöscht, die sich je nach Cookie unterscheiden kann. Sie können die Cookies in den Sicherheitseinstellungen Ihres Browsers jederzeit löschen.</p>
            <p>(b) Sie können Ihre Browser-Einstellung entsprechend Ihren Wünschen konfigurieren und z. B. die Annahme von Third-Party-Cookies oder allen Cookies ablehnen.</p>
            <p>(c) Wir setzen Cookies ein, um die Sicherheit unserer Website garantieren zu können.</p>
            <h2><strong>§ 4 Widerspruch</strong></h2><p>Soweit wir die Verarbeitung Ihrer personenbezogenen Daten, Datum und Uhrzeit Ihrer Anfrage (technische Daten), auf die Interessenabwägung (Art. 6 I 1 f DSGVO) stützen, können Sie Widerspruch gegen die Verarbeitung einlegen. Dies ist der Fall, wenn die Verarbeitung insbesondere nicht zur Erfüllung eines Vertrags mit Ihnen erforderlich ist, was von uns jeweils bei der Beschreibung der Funktionen (§ 5) dargestellt wird. Bei Ausübung eines solchen Widerspruchs bitten wir um Darlegung der Gründe, weshalb wir Ihre personenbezogenen Daten nicht wie von uns durchgeführt verarbeiten sollten. Im Falle Ihres begründeten Widerspruchs prüfen wir die Sachlage und werden entweder die Datenverarbeitung einstellen beziehungsweise anpassen oder Ihnen unsere zwingenden schutzwürdigen Gründe aufzeigen, aufgrund derer wir die Verarbeitung fortführen.</p></div>']]);
    }
}
