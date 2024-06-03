# Progetto Programmazione Web 23/24
![logo](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/logos/logo.png)

[Museo - Digital Art](https://museodigitalart.altervista.org) è un sito web per la visualizzazione di temi, sale, opere e autori di un museo.
Il progetto è stato realizzato con la piattaforma web [Altervista.org](https://it.altervista.org) e scritto in codice html, php e css.

## Database
Il database ([_my_museodigitalart.ods_](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/database/my_museodigitalart.ods)) è stato costruito rispettando il modello ER dato (figura seguente) ed è composto da quattro tabelle:
- _TEMA_: 10 tuple;
- _SALA_: 30 tuple;
- _OPERA_: 1000 tuple;
- _AUTORE_: 100 tuple.

Per il popolamento con grandi quantità di dati è stato utilizzato [Mockaroo.com](https://www.mockaroo.com), generatore online di fake e test data, resi poi il più realistici possibile attraverso query sql in Altervista. Inoltre gli elementi di una tabella hanno corrispondenze in altre tabelle.
\
Per la consistenza dei dati si è lavorato direttamente da MySql, andando a fare delle verifiche e, successivamente, degli Update sulle date; ad esempio è stato verificato se la data di realizzazione dell'opera (_dataRealizzazione_ nella tabella _OPERA_) fosse coerente con le date di nascita ed eventualmente di morte dell'autore.

Sempre tramite MySql sono state aggiunte ove necessario delle colonne:
- in corrispondenza di associazioni (0:n) o (1:n) è stata aggiunta una colonna col numero di entità ad essa associate: ad esempio in _SALA_ è stata aggiunta la colonna _numeroOpere_ con all'interno il numero di opere presenti nella sala;
- in corrispondenza di associazioni (0:1) o (1:1) sono state aggiunte delle colonne relativamente alle informazioni principali presenti nella tabella connessa 1:1, ad esempio in _OPERA_, oltre all'id dell'autore, è possibile trovare delle informazioni riguardanti la tabella _AUTORE_, come il nome ed il cognome.

![Fig. 1: ER](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/models/ER.png)  

## Struttura
Il sito è suddiviso in cinque pagine: _Home_, _Temi_, _Sale_, _Opere_ e _Autori_, ognuna facilmente raggiungibile dalla _Navbar_ sulla destra. 
L'_Header_, in alto, contiene il nome della pagina visualizzata, mentre con il _footer_, in basso, è possibile raggiungere il [GitHub](https://github.com/DanieleGotti/MUSEO_Digital_Art).

#### Home 
Nella prima pagina è presente una sezione dei contenuti consigliati, contenente quattro sezioni (una per tabella) in cui vengono estratte per ciascuna otto tuple random. 
Cliccando si passa alla loro visualizzazzione nella rispettiva pagina. 

#### Temi, Sale, Opere, Autori
Ognuna di queste pagine ha una tabella contenente le relative tuple. E' possibile ordinare in modo crescente e decrescente cliccando sulla freccia accanto al nome della colonna. I dati hanno delle corrispondenze in altre tabelle, perciò selezionado i link nelle righe è possibile spostarsi tra le pagine: selezionando su _numeroOpere_ di un autore è possibile passare nella tabella di _Opere_ filtrata con le opere relative all'autore.

I filtri sono relativi ad ogni colonna, ed è possibile effettuare delle ricerche su più colonne insieme. I filtri sono tutti tramite inserimento di testo tranne due, che sono di tipo radio, e specificano i tipi di tupla che si vuole cercare (_Scultura/Quadro_ in _Opere_ e _Vivo/Morto_ in _Autore_).
Nel caso di inserimenti non corretti viene lanciato un alert per permettere all'utente di meglio comprendere il database (ad esempio se si inserisce un carattere alfabetico nella ricerca del codice quando i codici sono tutti numerici).
Oltre che ai filtri relativi alla tabella nella quale ci si trova è possibile effettuare delle ricerche riferite a colonne di altre tabelle. Sia in _Sale_ che in _Autori_ è infatti possibile effettuare un "_Cerca per opera_". Cercando nell'apposito spazio il titolo dell'opera è possibile ricondursi alle informazioni relative all'autore o alla sala relativi, ovviamente i risultati mostrano tutte le possibili corrispondenze relative all'input inserito (la stessa ricerca in realtà è possibile andando sulla tabella _OPERA_ e cliccando sul link relativo alla colonna _Esposta In Sala_ ed _Autore_,  ma in questo modo la navigabilità tra le schede è più immediata e offre più possibilità).

#### Gestione Autori (CRUD)
La gestione degli autori avviene tramite CRUD, cioè sulla tabella è possibile eseguire le azioni di creazione, lettura, eliminazione e modifica.
Nei filtri presenti nella pagina _Autore_ troviamo la possibilità, oltre che di visualizzare la tabella ed interagire con essa tramite la ricerca, di gestirla. Cliccando su _Gestisci_ compariranno delle icone accanto ad ogni tupla che, in maniera intuitiva e semplice, permetteranno la modifica e l'eliminazione della tupla nella quale riga è stato premuta l'icona. 
Sia la modifica che l'eliminazione, prima di avvenire, vanno confermate tramite l'alert.
Vari controlli sono stati eseguiti sul modifica:
- non è possibile la modifica dell'id primario in quanto univoco non può essere sostituito;
- la modifica della data di nascita o della data di morte deve rispettare la giusta sintassi;
- se ad un autore vivo viene inserita la data di morte, il tipo dell'autore passa da vivo a morto in automatico;
- se non vengono effettuati inserimenti negli appositi campi di modifica allora la modifica non può avvenire, e questo viene comunicato tramite alert.

L'inserimento di un nuovo autore può invece essere gestito premendo su _Inserisci_, posizionato in cima alla pagina. 
Dopo il click appare un pop-up nel quale inserire le informazioni dell'autore: anche in questo caso sono stati effettuati i controlli sulla correttezza delle informazioni immesse, come ad esempio che l'id inserito non sia già presente nel database e che le date siano consistenti. L'inserimento va confermato perchè possa avvenire. 

### GUI
Il sito utilizza palette arancio. Tutte le icone ([_icons_](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/icons)), compresa quella del logo ([_logos_](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/logos)), e le animazioni ([_animations_](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/animations)) sono state scaricate dall'archivio di icone digitali [Flaticon.com](https://www.flaticon.com/).
L'immagine principale della schermata home ([_images_](https://github.com/DanieleGotti/MUSEO_Digital_Art/blob/main/img/images)) è stata creata utilizzando l'AI di [Canva.com](https://www.canva.com/it_it/generatore-immagini-ai/), strumento web di progettazione grafica.

## Compatibilità browser
Il sito è stato progettato per versioni PC di Chrome. Nonostante siano state implementate soluzioni per il suo utilizzo in altri browser, si consiglia di utilizzare Chrome per una migliore esperienza (animazioni e altri elementi GUI potrebbero funzionare diversamente su altri browser).

## Gruppo
Nome gruppo: __DgFg24__ \
Componenti:
- [__Gotti Daniele, matricola 1079011__](https://github.com/DanieleGotti)
- [__Gervasoni Federica, matricola 1078966__](https://github.com/fgervasoni7)


