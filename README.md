# Progetto Programmazione Web 23/24
![logo](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/doc/img/logo_trasparente.png)

[Museo - Digital Art](https://museodigitalart.altervista.org) è un sito web per la visualizzazione di temi, sale, opere e autori di un museo.
Il progetto è stato realizzato con la piattaforma web [Altervista.org](https://it.altervista.org) e scritto in codice html, php e css.

## Database
Il database ([_my_museodigitalart.ods_](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/doc/database/my_museodigitalart.ods)) è stato realizzato rispettando il modello ER (Fig. 1) ed è composto da quattro tabelle:
- Temi: 10 tuple
- Sale: 30 tuple
- Opere: 1000 tuple
- Autori: 100 tuple
Per il popolamento con grandi quantità di dati è stato utilizzato [Mockaroo.com](https://www.mockaroo.com/), generatore online di fake e test data, resi poi il più realistici possibile attraverso query sql direttamente in Altervista.
(Fede: aggiugere magari qualcosa di piu su come hai lavorato sui dati? Tipo le query con le date)

![Fig. 1: ER](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/models/ER.png)

## Struttura
Il sito è suddiviso in cinque pagine: _Home_, _Temi_, _Sale_, _Opere_ e _Autori_, ognuna facilmente raggiungibile dalla _Navbar_ sulla destra. 
L'_Header_, in alto, contiene il nome della pagina visualizzata, mentre con il _footer_, in basso, è possibile raggiungere il [Git](https://github.com/DanieleGotti/MUSEO_Digital_Art).

# Home 
Nella prima pagina è presente una sezione "consigliati", contenente quattro sezioni (una per tabella) in cui vengono estratte per ciascuna otto tuple random.
Cliccando si passa alla loro visualizzazzione nella rispettiva pagina.
(Fede qua spieghiamo in breve la logica dei random?)

# Temi, Sale, Opere, Autori
Ognuna di queste pagine ha una tabella contenente le relative tuple. In ogni riga è 
(Fede, scrivi dei filtri)

# Gestione Autori (CRUD)
(Fede, crud)

## Compatibilità browser
Il sito è stato progettato per versioni PC di Chrome. Nonostante siano state implementate soluzioni per il suo utilizzo in altri browser, si consiglia di utilizzare Chrome per una migliore esperienza (animazioni e altri elementi GUI potrebbero funzionare diversamente su altri browser).

## Gruppo
Nome gruppo: __DgFg24__ \
Componenti:
- [__Gotti Daniele, matricola 1079011__](https://github.com/DanieleGotti)
- [__Gervasoni Federica, matricola 1078966__](https://github.com/fgervasoni7)


