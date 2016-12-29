<?php

return [
    'codearea' => [
        'title' => 'Hilfe zur CodeArea',
        'subtitle' => 'Die CodeArea ist ein "WYSIWYG (What You See Is What You Get)" Editor. Über diesen kannst du einen Inhalt so erstellen, wie dieser auch später live aussehen wird. Im Folgenden findest du eine kleine Hilfestellung über die möglichen Einstellungsmöglichkeiten.',
        'description' => '
            Durch einen Klick in ein CodeArea Feld öffnet sich eine Toolpalette mit dessen Hilfe man den Inhalt bearbeiten kann. Diese Optionen sind weitgehend selbsterklärend.
            Sollte die benötigte Einstellungsmöglichkeit hier nicht vorzufinden sein, so kann man durch einen Klick auf das lila Symbol am unteren linken Bildschirmrand weitere Einstellungen vornehmen.
            Solltest du das lila Symbol nicht sehen, so vergewissere dich, dass du in die CodeArea in den Bereich geklickt hast, den du bearbeiten möchtest.
            Nach dem Klick auf das Symbol poppt ein Fenster auf. Hier kann man für den ausgewählten Bereich zum einem unter "Code" den Codeblock direkt mittels HTML bearbeiten und zum anderem
            unter "Attributes (Zahnrad)" bestimmte Klassen festlegen. 
            Um für den ausgewählten Block Klassen festzulegen klicke in das Feld "Name" und gebe den Wert "class" ein. Nun kannst du im Feld "Value" der selben Zeile bestimmte Klassen definieren.
            Möchtest du mehrere Klassen definieren, so trenne diese mittels einem Leerzeichen. Die folgenden Klassen können definiert werden:
            <h5>Ausrichtung</h5>
            <ul>
                <li><em><b>img-center</b></em> Zentriert das ausgewählte Bild</li>
                <li><em><b>center</b></em> Zentriert den ausgewählten Text</li>
                <li><em><b>right-align</b></em> Richtet den ausgewählten Text nach rechts aus</li>
                <li><em><b>left-align</b></em> Richtet den ausgewählten Text nach link aus</li>
                <li><em><b>justify</b></em> Formiert den ausgewählten Text im Blocksatz</li>
            </ul>
            
            <h5>Schriftgröße</h5>
            <ul>
                <li><em><b>x-large</b></em> Ändert die Schriftgröße des ausgewählten Textes auf sehr groß</li>
                <li><em><b>large</b></em> Ändert die Schriftgröße des ausgewählten Textes auf groß</li>
                <li><em><b>normal</b></em> Ändert die Schriftgröße des ausgewählten Textes auf die Standardgröße</li>
                <li><em><b>small</b></em> Ändert die Schriftgröße des ausgewählten Textes auf sehr klein</li>
                <li><em><b>x-small</b></em> Ändert die Schriftgröße des ausgewählten Textes auf sehr klein</li>
                <li><em><b>lowercase</b></em> Wandelt den ausgewählten Text in Kleinbuchstaben um</li>
                <li><em><b>uppercase</b></em> Wandelt den ausgewählten Text in Großbuchstaben um</li>
            </ul>
            
            <h5>Farben</h5>
            <ul>
                <li><em><b>error</b></em> <span class="error">Ändert die Schriftfarbe des ausgewählten Textes in die Standard Fehlerfarbe</span></li>
                <li><em><b>success</b></em> <span class="success">Ändert die Schriftfarbe des ausgewählten Textes in die Standard Erfolgsfarbe</span></li>
                <li><em><b>muted</b></em> <span class="muted">Ändert die Schriftfarbe des ausgewählten Textes in ein leichtes Grau</span></li>
                <li><em><b>primary</b></em> <span class="primary">Ändert die Schriftfarbe des ausgewählten Textes in die Primärfarbe</span></li>
                <li><em><b>secondary</b></em> <span class="secondary">Ändert die Schriftfarbe des ausgewählten Textes in die Standard Sekundärfarbe</span></li>
            </ul>
        '
    ]
];
