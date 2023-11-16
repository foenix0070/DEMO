




Wenn das Feld options vorhanden ist
-> kann es wie folgt statisch sein
```typo3_typoscript
options >
options = eins, zwei, drei
```
-> in diesem Fall wird key/value der gleiche Wert!

=> Hinweis, sollte der String einmal nicht exploded werden, lösche vorher die options mit `options >`

-> alternative
```typo3_typoscript
options {
  eins = eins
  zwei = zwei
  drei = drei
}
```

-> alternative 2 - wenn key/value unterschiedlich sein müssen, aber der key Zeichen enthält die in TypoScript nicht erlaubt sind:

```typo3_typoscript

```
options {
  1 {
     value = Südlicher Oberrhein
     label = Südlicher
  }
  1 {
     value = Ostwürttemberg
     label = Ostwürttemberg
 }
}




options {
  1 {
     value = Freudenstadt
     label = Freudenstadt
  }
  1 {
     value = Göppingen
     label = Göppingen
  }
  1 {
     value = Heidelberg (Stadtkreis)
     label = Heidelberg (Stadtkreis)
  }
  1 {
     value = Heidenheim
     label = Heidenheim
  }
  1 {
     value = Heilbronn (Landkreis)
     label = Heilbronn (Landkreis)
  }
  1 {
     value = Heilbronn (Stadtkreis)
     label = Heilbronn (Stadtkreis)
  }
  1 {
     value = Hohenlohekreis
     label = Hohenlohekreis
  }
  1 {
     value = Karlsruhe (Landkreis)
     label = Karlsruhe (Landkreis)
  }
  1 {
     value = Karlsruhe (Stadtkreis)
     label = Karlsruhe (Stadtkreis)
  }
  1 {
     value = Konstanz
     label = Südlicher
  }
  1 {
     value = Lörrach
     label = Südlicher
  }
  1 {
     value = Ludwigsburg
     label = Südlicher
  }
  1 {
     value = Main-Tauber-Kreis
     label = Südlicher
  }
  1 {
     value = Mannheim (Stadtkreis)
     label = Südlicher
  }
  1 {
     value = Neckar-Odenwald-Kreis
     label = Südlicher
  }
  1 {
     value = Ortenaukreis
     label = Südlicher
  }
  1 {
     value = Ostalbkreis
     label = Südlicher
  }
  1 {
     value = Pforzheim (Stadtkreis)
     label = Südlicher
  }
  1 {
     value = Rastatt
     label = Südlicher
  }
  1 {
     value = Ravensburg
     label = Südlicher
  }
  1 {
     value = Rems-Murr-Kreis
     label = Südlicher
  }
  1 {
     value = Reutlingen
     label = Südlicher
  }
  1 {
     value = Rhein-Neckar-Kreis
     label = Südlicher
  }
  1 {
     value = Rottweil
     label = Südlicher
  }
  1 {
     value = Schwäbisch Hall
     label = Südlicher
  }
  1 {
     value = Schwarzwald-Baar-Kreis
     label = Südlicher
  }
  1 {
     value = Sigmaringen
     label = Südlicher
  }
  1 {
     value = Stuttgart (Stadtkreis)
     label = Südlicher
  }
  1 {
     value = Tuttlingen
     label = Südlicher
  }
  1 {
     value = Tübingen
     label = Südlicher
  }
  1 {
     value = Ulm (Stadtkreis)
     label = Südlicher
  }
  1 {
     value = Waldshut
     label = Südlicher
  }
  1 {
     value = Zollernalbkreis
     label = Südlicher
  }
  1 {
     value = Neu-Ulm
     label = Südlicher
  }
  1 {
     value =
