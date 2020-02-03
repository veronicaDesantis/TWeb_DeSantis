-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 03, 2020 alle 23:06
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmanager`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autore`
--

CREATE TABLE `autore` (
  `id_autore` int(2) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `cognome` varchar(500) NOT NULL,
  `luogo_nascita` varchar(500) NOT NULL,
  `data_nascita` date NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `autore`
--

INSERT INTO `autore` (`id_autore`, `nome`, `cognome`, `luogo_nascita`, `data_nascita`, `enabled`) VALUES
(1, 'Matteo', 'Bussola', 'Verona', '1971-11-14', b'1'),
(2, 'William', 'Shakespeare', 'Stratford', '1564-04-23', b'1'),
(3, 'Isaac', 'Asimov', 'Petrovici', '1920-01-02', b'1'),
(4, 'Stephanie', 'Garber', 'Carolina del Nord', '1990-01-01', b'1'),
(5, 'Nicholas', 'Spark', 'Omaha', '1965-12-31', b'1'),
(6, 'Marzia', 'Sicignano', 'Siracusa', '1997-01-01', b'1'),
(7, 'Antonio', 'Dikele', 'Busto Arsizio', '1992-05-25', b'1'),
(8, 'Alessandro', 'Baricco', 'Torino', '1958-01-25', b'1'),
(9, 'Andrzej', 'Sapkowski', 'Lodz', '1948-06-21', b'1'),
(10, 'Simone', 'Montanaro', 'Torino', '1999-02-09', b'0');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`id`, `id_utente`, `id_libro`) VALUES
(24, 1, 1),
(25, 1, 12),
(26, 1, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `casaeditrice`
--

CREATE TABLE `casaeditrice` (
  `id_casa_editrice` int(2) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `indirizzo_web` varchar(500) NOT NULL,
  `sede` varchar(500) NOT NULL,
  `enabled` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `casaeditrice`
--

INSERT INTO `casaeditrice` (`id_casa_editrice`, `nome`, `indirizzo_web`, `sede`, `enabled`) VALUES
(1, 'Einaudi editore', '  https://www.einaudi.it', 'Torino', 1),
(2, 'Editrice Nord', '  https://www.editricenord.it/', 'Milano', 1),
(3, 'LaFeltrinelli', 'https://www.lafeltrinelli.it/', 'Milano', 1),
(4, 'Bompiani', 'https://www.bompiani.it/', 'Milano', 1),
(5, 'Mondadori', 'https://www.mondadoristore.it/', 'Milano', 1),
(6, 'Rizzoli', 'https://www.rizzolilibri.it/', 'Milano', 1),
(7, 'Pickwick', 'http://www.pickwicklibri.it/', 'Milano', 1),
(8, 'test', 'test111', 'Milano', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `libro`
--

CREATE TABLE `libro` (
  `id_libro` int(2) NOT NULL,
  `titolo` varchar(500) NOT NULL,
  `codeISBN` varchar(500) NOT NULL,
  `descrizione` mediumtext NOT NULL,
  `anno` int(4) NOT NULL,
  `id_autore` int(2) NOT NULL,
  `id_casa_editrice` int(2) NOT NULL,
  `path_copertina` varchar(500) NOT NULL,
  `prezzo` double NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `libro`
--

INSERT INTO `libro` (`id_libro`, `titolo`, `codeISBN`, `descrizione`, `anno`, `id_autore`, `id_casa_editrice`, `path_copertina`, `prezzo`, `enabled`) VALUES
(1, 'Notti in bianco, baci a colazione', '978-8804668237', 'Il respiro di tua figlia che ti dorme addosso sbavandoti la felpa. Le notti passate a lavorare e quelle a vegliare le bambine. Le domande difficili che ti costringono a cercare le parole. Le trecce venute male, le scarpe da allacciare, il solletico, i «lecconi», i baci a tutte le ore. Sono questi gli istanti di irripetibile normalità che Matteo Bussola cattura con felicità ed esattezza. Perché a volte, proprio guardando ciò che sembra scontato, troviamo inaspettatamente il senso di ogni cosa. Padre di tre figlie piccole, Matteo sa restituirne lo sguardo stupito, lo stesso con cui, da quando sono nate, anche lui prova a osservare il mondo. Dialoghi strampalati, buffe scene domestiche, riflessioni sottovoce che dopo la lettura continuano a risuonare in testa. Nell’«abitudine di restare» si scopre una libertà inattesa, nei gesti della vita di ogni giorno si scopre quanto poetica possa essere la paternità.', 2016, 1, 1, '../attached/NottiInBianco.jpg', 14.45, b'1'),
(2, 'Amleto', '978-8807900426', 'La vicenda che Shakespeare doveva mettere in scena era, senza mezzi termini, il rapporto di una mente umana con la vita, e il suo problema, allora, era quello di far muovere Amleto, con la sua \"prodigiosa consapevolezza\" (Henry James), su un terreno adeguato al personaggio e alla sua ricerca. Poiché tutta la vita doveva essere messa in discussione, sottoposta all\'analisi, al dubbio di un Amleto che è l\'unico moderno, Shakespeare crea una struttura supremamente elastica e comprensiva, capace di abbracciare pianto e riso, ragione e follia, amore e odio; di passare da un universo domestico a un paesaggio sconfinato, da un salone di corte a un campo militare, da una fortezza a un cimitero. Se bene guardiamo l\'Amleto, vediamo come ogni esperienza umana vi venga rappresentata. Tutta la vita; e più ancora: la vita vista come immagine di se medesima, come teatro.', 1601, 2, 3, '../attached/Amleto.jpg', 7.65, b'1'),
(3, 'Il mercante di Venezia', '978-8807900433', 'Nel \"Mercante di Venezia\", opera composta tra il 1596 e il 1598 e qui presentato in nuova traduzione, il mondo sembra nettamente distinto tra buoni e malvagi, cristiani ed ebrei, innocenti e colpevoli: ma così non è.', 1594, 2, 3, '../attached/IlMercanteDiVenezia.jpg', 7.65, b'1'),
(4, 'La bisbetica domata', '978-8807903250', 'Petruccio è un avventuriero che parte da Verona e va a cercare fortuna a Padova. È un maschio giovane, forte e avvenente, assai dotato, e ha quella libertà di movimento che agli uomini è pienamente concessa nell\'Italia immaginata da Shakespeare - così come nella sua Inghilterra. E quale modo migliore di fare fortuna se non trovare moglie? Moglie vuol dire dote. Anche se brutta come il peccato, o scontrosa come la proverbiale Santippe, la donna assolverà comunque al suo compito, se il padre-padrone com\'è suo dovere la consegnerà al futuro sposo coprendola d\'oro il giorno del matrimonio. È così che il giovane Petruccio s\'imbatte nella giovane Caterina, la quale non sarà brutta, ma senz\'altro è la più scorbutica delle spose. Caterina è la sorella ribelle dell\'angelica Bianca, che tutti vorrebbero in moglie, ma che non potrà sposarsi, se il padre non si sarà prima liberato di quella gattaccia selvatica che è Caterina. Il quale padre tenta di combinare il matrimonio, che risolverebbe in un sol colpo ogni nodo della trama comica: Petruccio si arricchirà, Caterina sarà addomesticata, Bianca potrà realizzare le proprie potenzialità di affettuosa e docile mogliettina. Ma Caterina non ci sta: né a sposare uno sconosciuto, né a essere seconda a Bianca, né a ubbidire alla legge paterna. Ed ecco che si avvia il gioco del dominio e della sopraffazione amorosa e sociale e sessuale e di genere, con Petruccio nei panni del domatore e Caterina in quelli della bisbetica da domare: ma neanche Shakespeare accetta fino in fondo il modello comico che ha ereditato e ci regala un finale assolutamente sorprendente. Introduzione di Nadia Fusini.', 1590, 2, 3, '../attached/LaBisbeticaDomata.jpg', 7.65, b'1'),
(5, 'Macbeth', '978-8807900754', 'Macbeth torna vittorioso dal campo di battaglia e tre streghe gli profetizzano un glorioso destino, ivi compresa la Corona di Scozia. La sete di potere, condivisa e stimolata anche dalla moglie Lady Macbeth, lo spinge al delitto e infine all\'amaro disinganno, per cui l\'esistenza non è che \"una favola raccontata da un idiota, piena di rumore e furore, che non significa nulla\".', 1605, 2, 3, '../attached/Macbeth.jpg', 7.22, b'1'),
(6, 'Otello', '978-8807900440', 'Nell\'\"Otello\" la parola diventa destino e per questo, al di là dei molti temi di cui la tragedia è ricca (dallo studio della gelosia alla rappresentazione dell\'operare del male, dall\'analisi della follia alla percezione di quella grande crisi di trasformazione, di quel passaggio dal Medioevo all\'età moderna che è alla base dell\'arte shakespeariana), essa offre il suo più straordinario contributo nel proporre una nuova, moderna immagine di eroe tragico. Un eroe che cade perché non riesce a leggere il mondo e perciò a conoscerlo. Esso è per lui una sfinge, un enigma, e la parola è mistero e inganno, illusione e simulazione, apparenza che però incide sulla realtà e la distorce, rendendo la conoscenza impossibile e portando alla catastrofe. Il percorso tragico non è più determinato da un fato esterno all\'uomo ma dall\'incapacità dell\'uomo (ormai solo, in un universo senza dei) di decifrare il testo-mondo.', 1603, 2, 3, '../attached/Otello.jpg', 7.65, b'1'),
(7, 'Romeo e Giulietta', '978-8807901379', 'In \"Romeo e Giulietta\" (1595-1596) la morte è presente in vario modo fin dall\'inizio. Ma è con il duello tra Mercuzio e Tebaldo che essa entra realmente in scena e avvia quella sua presa di possesso della città cui la tragedia conduce. Non solo, ma che la prima vittima sia Mercuzio, simbolo di giovinezza e di libertà, della gioia di vivere e della stessa gioia di far teatro, è anche indicativo di chi sia l\'oggetto di questo assalto della morte: non i vecchi, ma i giovani, non il declinare della vita, ma il suo sbocciare, non la stanchezza, l\'aridità del cuore, ma la sua freschezza, il suo desiderio d\'amore. Tebaldo uccide Mercuzio; Romeo uccide Tebaldo, finché, come sappiamo, la morte aggredisce anche Romeo e Giulietta, e la \"bella Verona\" celebrata all\'inizio si trasforma in una tomba. Nulla di vivo resta se non i vecchi, la cui faida e il cui egoismo, non il caso, hanno ucciso i giovani. Romeo e Giulietta potranno finalmente stare insieme ma solo nella cripta, con il loro amore raggelato per l\'eternità nelle statue d\'oro che i carnefici eleveranno a ricordo.', 1594, 2, 3, '../attached/RomeoEGiulietta.jpg', 7.22, b'1'),
(8, 'Sogno di una notte di mezza estate', '978-8817063432', 'Fate e folletti popolano il mondo fantastico di questa commedia di Shakespeare, lieve e raffinata, in cui amori e tradimenti si susseguono con comicità e grazia incantevole. Dalla bellissima Titania, regina delle fate, innamorata perdutamente di un uomo dalla testa d\'asino, al comico e irresistibile Bottom fino al capriccioso folletto Puck, i cui errori nel somministrare i filtri d\'amore muovono le sottili trame della vicenda. Una commedia lieve e briosa, ricca di improvvisazioni e colpi di scena, che inaugura un nuovo tipo di rappresentazione nel panorama shakespeariano, e che viene qui presentata nella celebre traduzione di Gabriele Baldini in un\'edizione rinnovata a cura di Fernando Cioni.', 1595, 2, 3, '../attached/SognoDiUNaNotteDiMezzaEstate.jpg', 7.22, b'1'),
(9, 'Nemesis', '978-0553286281', 'In the twenty-third century pioneers have escaped the crowded earth for life in self-sustaining orbital colonies.  One of the colonies, Rotor, has broken away from the solar system to create its own renegade utopia around an unknown red star two light-years from Earth:  a star named Nemesis.  Now a fifteen-year-old Rotorian girl has learned of the dire threat that nemesis poses to Earth\'s people--but she is prevented from warning them.  Soon she will realize that Nemesis endangers Rotor as well.  And so it will be up to her alone to save both Earth and Rotor as--drawn inexorably by Nemesis, the death star--they hurtle toward certain disaster.', 1989, 3, 4, '../attached/Nemesis.jpg', 10.2, b'1'),
(10, 'Robot NDR 113', 'B00P4AWRR0', 'Robot insolito, Andrew manifesta doti artistiche e intellettuali estranee alla sua programmazione originale. Tali peculiarità emergono sempre più nella coscienza di Andrew che inizialmente le interpreta come delle disfunzioni positroniche.', 1993, 3, 4, '../attached/RobotNdr113.jpg', 22, b'1'),
(11, 'Io, robot', '978-8804707035', 'Pubblicata per la prima volta nel 1950, questa celebre antologia raccoglie i più significativi racconti che il più prolifico e famoso scrittore di fantascienza di tutti i tempi ha dedicato ai robot. È proprio in questo libro che Asimov detta le tre Leggi della robotica, che regolano appunto il comportamento delle \"macchine pensanti\" e che da allora in poi sono alla base di tutta la letteratura del genere.', 1950, 3, 5, '../attached/IoRobot.jpg', 11.9, b'1'),
(12, 'Sono puri i loro sogni', '978-8806236229', 'Quando abbiamo smesso di fidarci degli insegnanti, e abbiamo iniziato a vivere al posto dei nostri figli? Essere genitori, a volte, significa fare un passo indietro. ', 2017, 1, 1, '../attached/SonoPuriILoroSogni.jpg', 11.05, b'1'),
(13, 'La vita fino a te', '978-8806236359', 'Matteo Bussola riconosce ciò che di straordinario si annida nelle cose ordinarie perché le guarda come se accadessero per la prima volta, come se sentisse sempre la vita pulsare in ogni cellula. Ed è con quello sguardo che racconta di relazioni sentimentali, l istante in cui nascono, il tempo che abitano. Lo fa mettendosi a nudo, ricordando gli amori passati, per ripercorrere la strada che lo ha portato fino a qui, alla sua esistenza con Paola e le loro tre figlie. Soprattutto, lo fa specchiandosi nelle storie di ciascuno: quelle che incontra su un treno, o mentre sbircia dal finestrino della macchina, o seduto in un bar la mattina presto. Quelle che incontra stando nel mondo senza mai dare il mondo per scontato, e che la sua voce intima e familiare ci restituisce facendoci sentire che sta parlando esattamente di noi.', 2018, 1, 1, '../attached/LaVitaFinoATe.jpg', 14.45, b'1'),
(14, 'Caraval', '978-8817096805', 'Il mondo, per Rossella Dragna, ha sempre avuto i confini della minuscola isola dove vive insieme alla sorella Tella e al potente, crudele padre. Se ha sopportato questi anni di forzato esilio è stato grazie al sogno di partecipare a Caraval, uno spettacolo itinerante misterioso quanto leggendario in cui il pubblico partecipa attivamente; purtroppo, l\'imminente, combinato matrimonio a cui il padre la sta costringendo significa la rinuncia anche a quella possibilità di fuga. E invece Rossella riceve il tanto desiderato invito, e con l\'aiuto di un misterioso marinaio, insieme a Tella fugge dall\'isola e dal suo destino... Appena arrivate a Caraval, però, Tella viene rapita da Legend, il direttore dello spettacolo che nessuno ha mai incontrato: Rossella scopre in fretta che l\'edizione di Caraval che sta per iniziare ruota intorno alla sorella, e che ritrovarla è lo scopo ultimo del gioco, non solo suo, ma di tutti i fortunati partecipanti. Ciò che accade in Caraval sono solo trucchi ed illusioni, questo ha sempre sentito dire Rossella. Eppure, sogno e veglia iniziano a confondersi e negare la magia diventa impossibile. Ma che sia realtà o finzione poco conta: Rossella ha cinque notti per ritrovare Tella, e intanto deve evitare di innescare un pericoloso effetto domino che la porterebbe a perdere Tella per sempre...', 2016, 4, 6, '../attached/Caraval.jpg', 15.3, b'1'),
(15, 'Legend', '978-8817105934', 'Dopo la travolgente avventura nel mondo magico e misterioso del Caraval, Donatella Dragna è riuscita finalmente a sfuggire al padre e a salvare la sorella Rossella da un disastroso matrimonio combinato. Ma Tella non è ancora libera; per ritrovare la madre Paloma ha stretto un patto disperato con un criminale misterioso, che vuole in cambio qualcosa che solo lei può dargli: il vero nome di Legend, il Mastro di Caraval. L\'unica possibilità per scoprire il vero nome di Legend è vincere il nuovo Caraval, che si terrà a Valenda, l\'antica capitale dove una volta regnavano i Fati, in occasione del genetliaco di Elantine, la sovrana dell\'Impero di Mezzo. Tella dovrà quindi immergersi di nuovo nella competizione magica, tra le attenzioni di un inquietante erede al trono, una storia d\'amore impossibile e una ragnatela di segreti, tra cui anche quelli di Rossella. Se fallirà non potrà mantenere il suo patto e rischierà di perdere tutto, compresa forse la vita. Ma se vincerà, Legend e il Caraval saranno distrutti per sempre.', 2018, 4, 6, '../attached/Legend.jpg', 15.3, b'1'),
(16, 'Finale', '978-8817143431', 'Sono passati due mesi da quando i Fati sono stati liberati, due mesi da quando Legend ha reclamato per sé il trono, due mesi da quando Tella ha scoperto che il ragazzo di cui si è innamorata in realtà non esiste. Mentre vite, imperi e cuori restano in sospeso, Tella deve decidere se fidarsi di Legend o piuttosto di un ex nemico. Dopo aver scoperto un segreto che ribalta tutta la sua vita, Rossella dovrà tentare l\'impossibile per salvare coloro che ama e l\'Impero. E Legend dovrà fare una scelta che lo cambierà per sempre. Caraval è finito, ma il più grande dei giochi è appena cominciato. Non ci sono spettatori questa volta, qualcuno vincerà, e qualcuno perderà per sempre.', 2019, 4, 6, '../attached/Finale.jpg', 16.15, b'1'),
(17, 'Le pagine della nostra vita', '978-8868360399', 'North Carolina, 1946: il giovane Noah, tornato nel paese natale dopo la guerra, realizza il sogno - coltivato da tempo - di abitare nella grande casa vicino al fiume, da lui riportata all\'antico splendore. Alla perfezione del quadro manca però Allie, una seducente ragazza incontrata anni prima, amata disperatamente nel breve spazio di un\'estate e mai più ritrovata. Invece, un giorno lei ricompare, per vederlo un\'ultima volta prima di sposarsi... Ma il destino ha deciso altrimenti, scrivendo per loro una storia diversa...', 1996, 5, 7, '../attached/LePagineDellaNostraVita.jpg', 8.41, b'1'),
(18, 'Io, te e il mare', '978-8804710295', '«Ti sei mai sentito solo al mondo? Ti sei mai sentito senza un senso, diviso a metà, come se ti mancasse qualcosa? Ecco, quando ti ho visto per la prima volta è stato come ritrovare la parte di me che avevo perso, forse, quando ho messo piede in questo mondo». Eccola, l\'essenza del primo, vero amore, che travolge i protagonisti di questa storia: la sensazione meravigliosa che, tutto a un tratto, il caos che hanno dentro trovi finalmente un punto intorno al quale sciogliersi, permettendogli di accarezzare quella felicità di cui fino a un momento prima avevano solo fantasticato. Perché quando si è ragazzi e ci si ama, si può davvero tutto, persino regalarsi il mare. Che poi, a pensarci bene, ogni cosa bella comincia sempre da lì, dal mare, metafora perfetta di quell\'esplosione di emozioni che senti dentro quando ti innamori. Il mare, che quando ci entri lo fai velocemente, senza pensare alle conseguenze: ti tuffi e basta. Il mare che, da solo, è in grado di curarti il cuore e che, persino quando ti tramortisce con le sue onde, è talmente bello che proprio non riesci a concepire che potrebbe anche farti del male. Eppure potrebbe, potrebbe eccome. E infatti, la lei e il lui di questo romanzo in cui i sentimenti si muovono liberamente attraverso le poesie e la prosa, ben presto saranno costretti ad affrontare le loro personali tempeste: un misto di insicurezze, fragilità, paura di non essere \"abbastanza\" con il rischio, inevitabile, di andare alla deriva, l\'uno lontano dall\'altra. Pure loro mare, un mare mai calmo, che distrugge tutto ma che vale sempre la pena guardare, respirare, vivere, anche se fa male, fin che ce n\'è.', 2018, 6, 5, '../attached/IoTeEIlMare.jpg', 15.52, b'1'),
(19, 'Non ho mai avuto la mia età', '978-8804702146', 'Questa è la storia di un ragazzo che non ha mai avuto la sua età. Non ha neanche un nome, e per comodità lo chiameremo Zero. In realtà non ha mai avuto nulla. Perché la sua è una vita tutta in sottrazione, che ha sempre tolto e ha dato poco. Zero non ha cittadinanza, non ha madre, non ha soldi, e non si concede neanche il lusso di pensare al futuro. Zero ha dovuto capire in fretta che certe cose non si possono chiedere ai genitori, che ciò che è giusto non è patrimonio di tutti. Perché la vita non ha nessun obbligo di darti quello che credi di meritare e non lo ha nemmeno chi ti ha messo al mondo. Gli anni di Zero, dai sette ai diciotto, i capitoli che scandiscono il romanzo, sono duri, sono anni che hanno il sapore della povertà e della periferia. Ma sono anche anni passati ad attraversare strade in bici, con il cellulare attaccato a una cassa per permettere agli altri di sentire la musica. In piedi sui pedali, a ridere in mezzo alla via. Pomeriggi a giocare a pallone, a sperimentare il sesso e a bruciarsi per amore. Sono anni passati in quartiere consapevoli però che l\'unico modo per salvarsi e garantirsi un futuro è andare via perché se nuoti nel fango, alla fine ti sporchi. Ma quello che c\'è fuori fa paura. Ci sono gli sguardi indiscreti sui bus, le persone che tengono più stretta la borsa quando ci si avvicina, le ragazze che aumentano il passo e cambiano strada quando ti incontrano. C\'è un Paese che non ti riconosce, gente che non si ricorda che essere italiani non è un merito ma un diritto. Fuori c\'è la frase che ti ripeteva sempre la mamma e che ti rimbomba in testa \"i bianchi nei neri ci vedono sempre qualcosa di cattivo\". Ma di Zero ce n\'è uno, nessuno e centomila e con Non ho mai avuto la mia età Distefano ci regala uno spaccato dell\'esistenza di tutti quegli Zeri che con la vita si sono sempre presi a pugni in faccia, consapevole che ce la devi fare sempre anche quando non ce la fai più.', 2018, 7, 5, '../attached/NonHoMaiAvutoLaMiaEta.jpg', 14.36, b'1'),
(20, 'Bozze', '978-8804708810', 'Non ho scritto un romanzo. Ho scritto una cosa che vorrei che leggessi. Ho scritto che mi sento piccolo rispetto al mondo quando provo a capire come mi sento. Ho scritto che vorrei un amore di cui non devo preoccuparmi. Ho scritto che sono stanco. Se le mie parole ti piaceranno e sentirai che condividendole con altri possano essere d\'aiuto fallo. Condividi quello che ho scritto con più persone possibili. Io ho iniziato a scrivere per questo. Perché volevo che le persone capissero quello che non riuscivo a descrivere a parole. Io che non ho mai saputo raccontare un\'emozione mentre la sentivo. Quindi è tutto nelle tue mani.', 2018, 7, 5, '../attached/Bozze.jpg', 11.9, b'1'),
(21, 'Il guardiano degli innocenti', '978-8842932413', 'Geralt è uno \'strigo\', un individuo più forte e resistente di qualsiasi essere umano, che si guadagna da vivere uccidendo quelle creature che sgomentano anche i più audaci: demoni, orchi, elfi malvagi... Strappato alla sua famiglia quand\'era soltanto un bambino, Geralt è stato sottoposto a un durissimo addestramento, durante il quale gli sono state somministrate erbe e pozioni che lo hanno mutato profondamente. Non esiste guerriero capace di batterlo e le stesse persone che lo assoldano hanno paura di lui. Lo considerano un male necessario, un mercenario da pagare per i suoi servigi e di cui sbarazzarsi il più in fretta possibile. Anche Geralt, però, ha imparato a non fidarsi degli uomini: molti di loro nascondono decisioni spietate sotto la menzogna del bene comune o diffondono ignobili superstizioni per giustificare i loro misfatti. Spesso si rivelano peggiori dei mostri ai quali lui dà la caccia. Proprio come i cavalieri che adesso sono sulle sue tracce: hanno scoperto che Geralt è gravemente ferito e non vogliono perdere l\'occasione di eliminarlo una volta per tutte. Per questo lui ha chiesto asilo a Nenneke, sacerdotessa del tempio della dea Melitele e guaritrice eccezionale, nonché l\'unica persona che può aiutarlo a ritrovare Yennefer, la bellissima e misteriosa maga che gli ha rubato il cuore...', 1993, 9, 2, '../attached/IlGuardianoDegliInnocenti.jpg', 12.66, b'1'),
(22, 'Seta', '978-8807880896', 'La Francia, i viaggi per mare, il profumo dei gelsi a Lavilledieu, i treni a vapore, la voce di Hélène. Hervé Joncour continuò a raccontare la sua vita, come mai, nella sua vita, aveva fatto. \"Questo non è un romanzo. E neppure un racconto. Questa è una storia. Inizia con un uomo che attraversa il mondo, e finisce con un lago che se ne sta lì, in una giornata di vento. L\'uomo si chiama Hervé Joncour. Il lago non si sa.\"', 1996, 8, 3, '../attached/Seta.jpg', 6.37, b'1'),
(23, 'Oceano mare', '978-8807883026', '\"Oceano mare\" racconta del naufragio di una fregata della marina francese, molto tempo fa, in un oceano. Gli uomini a bordo cercheranno di salvarsi su una zattera. Sul mare si incontreranno le vicende di strani personaggi. Come il professore Bartleboom che cerca di stabilire dove finisce il mare, o il pittore Plasson che dipinge solo con acqua marina, e tanti altri individui in cerca di sé, sospesi sul bordo dell\'oceano, col destino segnato dal mare. E sul mare si affaccia anche la locanda Almayer, dove le tante storie confluiscono. Usando il mare come metafora esistenziale, Baricco narra dei suoi surreali personaggi, spaziando in vari registri stilistici.', 1993, 8, 3, '../attached/OceanoMare.jpg', 8.07, b'1');

-- --------------------------------------------------------

--
-- Struttura della tabella `librotag`
--

CREATE TABLE `librotag` (
  `id_libro` int(3) NOT NULL,
  `id_tag` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `librotag`
--

INSERT INTO `librotag` (`id_libro`, `id_tag`) VALUES
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(2, 79),
(2, 80),
(2, 81),
(3, 43),
(3, 46),
(3, 47),
(4, 46),
(4, 49),
(4, 50),
(5, 42),
(5, 51),
(6, 42),
(6, 43),
(6, 47),
(7, 35),
(7, 36),
(7, 39),
(7, 41),
(7, 42),
(7, 50),
(7, 52),
(8, 46),
(8, 53),
(8, 54),
(12, 36),
(12, 37),
(12, 38),
(12, 40),
(13, 35),
(13, 39),
(13, 41),
(14, 66),
(14, 67),
(14, 68),
(14, 69),
(15, 55),
(15, 56),
(15, 57),
(15, 58),
(16, 70),
(16, 71),
(16, 72),
(16, 73);

-- --------------------------------------------------------

--
-- Struttura della tabella `lista`
--

CREATE TABLE `lista` (
  `id_lista` int(3) NOT NULL,
  `id_utente` int(3) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `public` bit(1) NOT NULL,
  `enabled` bit(2) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `lista`
--

INSERT INTO `lista` (`id_lista`, `id_utente`, `nome`, `public`, `enabled`) VALUES
(1, 1, 'Magia', b'1', b'01'),
(2, 1, 'Fantascienza', b'1', b'01'),
(3, 1, 'Contemporanei', b'0', b'01'),
(4, 1, '900', b'0', b'00'),
(9, 1, 'test', b'1', b'00'),
(10, 1, 'Test11', b'1', b'00'),
(11, 1, 'Test', b'1', b'00'),
(12, 1, 'Test', b'1', b'00'),
(13, 1, 'Fantasy', b'0', b'01');

-- --------------------------------------------------------

--
-- Struttura della tabella `listalibro`
--

CREATE TABLE `listalibro` (
  `id_lista` int(3) NOT NULL,
  `id_libro` int(3) NOT NULL,
  `is_read` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `listalibro`
--

INSERT INTO `listalibro` (`id_lista`, `id_libro`, `is_read`) VALUES
(1, 14, b'0'),
(1, 15, b'0'),
(1, 16, b'1'),
(2, 9, b'1'),
(2, 10, b'1'),
(2, 11, b'1'),
(3, 1, b'1'),
(3, 12, b'1'),
(3, 13, b'1'),
(3, 18, b'1'),
(3, 19, b'0'),
(3, 20, b'1'),
(13, 21, b'0');

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `id_utente` int(3) NOT NULL,
  `id_libro` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`id_utente`, `id_libro`) VALUES
(1, 14),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(3) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `colore` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tag`
--

INSERT INTO `tag` (`id_tag`, `nome`, `colore`) VALUES
(35, 'Amore', 'danger'),
(36, 'Famiglia', 'info'),
(37, 'Papà', 'warning'),
(38, 'Figlie', 'secondary'),
(39, 'Vita', 'dark'),
(40, 'Scuola', 'success'),
(41, 'Moglie', 'info'),
(42, 'Tragedia', 'primary'),
(44, 'Essere o non essere', 'danger'),
(45, 'Danimarca', 'info'),
(46, 'Commedia', 'warning'),
(47, 'Venezia', 'secondary'),
(49, 'Femmine', 'info'),
(50, 'Verona', 'secondary'),
(51, 'Catastrofe', 'info'),
(52, 'Mantova', 'warning'),
(53, 'Atene', 'info'),
(54, 'Matrimonio', 'dark'),
(55, 'Caraval', 'primary'),
(56, 'Legend', 'info'),
(57, 'Magia', 'dark'),
(58, 'Sorelle', 'danger'),
(61, 'Test', 'dark'),
(62, 'Test', 'secondary'),
(63, 'Amore', 'danger'),
(64, 'Atene', 'info'),
(65, 'Test', 'secondary'),
(66, 'Caraval', 'primary'),
(67, 'Legend', 'info'),
(68, 'Magia', 'dark'),
(69, 'Sorelle', 'danger'),
(70, 'Caraval', 'primary'),
(71, 'Legend', 'info'),
(72, 'Magia', 'dark'),
(73, 'Sorelle', 'danger'),
(74, 'Amore', 'danger'),
(75, 'Famiglia', 'info'),
(76, 'Papà', 'warning'),
(77, 'Figlie', 'secondary'),
(78, 'Vita', 'dark'),
(79, 'Tragedia', 'primary'),
(80, 'Essere o non essere', 'danger'),
(81, 'Danimarca', 'info'),
(82, 'Amore', 'danger'),
(83, 'Famiglia', 'info'),
(84, 'Papà', 'warning'),
(85, 'Figlie', 'secondary'),
(86, 'Vita', 'dark');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(2) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `cognome` varchar(500) NOT NULL,
  `mail` varchar(500) NOT NULL,
  `bio` varchar(500) NOT NULL,
  `hash_recupero` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `path_foto` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `nome`, `cognome`, `mail`, `bio`, `hash_recupero`, `password`, `path_foto`, `username`) VALUES
(1, 'Veronica', 'De Santis', 'veronica.desantis@hrcsrl.it', 'Studentessa, lavoratrice, amante dei libri', '', 'da72ce93bf7f167ff9f0c9a50eaae1ff54866f6398a68b47fcded13db1344a3c', '18.png', 'vdesantis'),
(2, 'Simone', 'Montanaro', 'simone.montanaro@hrcsrl.it', '', '', 'd040f9cdb070a6c718f0f8392e34712502b6c0875d7d79c2b556a3cc6f869eea', '6.png', 'smontanaro'),
(3, 'Fabio', 'Giannetti', 'fabio.giannetti92@gmail.com', '', '', '42ec4a7146c9a785795178ad5bc5869ddec41e09e3873efeed675883cc4b7ec9', '7.png', 'fgiannetti'),
(6, 'Luca', 'De Santis', 'luca.desantis@hrcsrl.it', 'test bio111', '', '388a75b8681561690154f93b0a3d7914b5b022912d5aa5fbd09266776dbe2a35', '10.png', 'ldesantis');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `autore`
--
ALTER TABLE `autore`
  ADD PRIMARY KEY (`id_autore`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrello_utente` (`id_utente`),
  ADD KEY `carrello_libro` (`id_libro`);

--
-- Indici per le tabelle `casaeditrice`
--
ALTER TABLE `casaeditrice`
  ADD PRIMARY KEY (`id_casa_editrice`);

--
-- Indici per le tabelle `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_libro`),
  ADD KEY `libro_autore` (`id_autore`),
  ADD KEY `libro_casaeditrice` (`id_casa_editrice`);

--
-- Indici per le tabelle `librotag`
--
ALTER TABLE `librotag`
  ADD PRIMARY KEY (`id_libro`,`id_tag`);

--
-- Indici per le tabelle `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `lista_utente` (`id_utente`);

--
-- Indici per le tabelle `listalibro`
--
ALTER TABLE `listalibro`
  ADD PRIMARY KEY (`id_lista`,`id_libro`),
  ADD KEY `lista_libro` (`id_libro`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`id_utente`,`id_libro`),
  ADD KEY `pref_libro` (`id_libro`);

--
-- Indici per le tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `autore`
--
ALTER TABLE `autore`
  MODIFY `id_autore` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `casaeditrice`
--
ALTER TABLE `casaeditrice`
  MODIFY `id_casa_editrice` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `libro`
--
ALTER TABLE `libro`
  MODIFY `id_libro` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `lista`
--
ALTER TABLE `lista`
  MODIFY `id_lista` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_libro` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  ADD CONSTRAINT `carrello_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`);

--
-- Limiti per la tabella `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_autore` FOREIGN KEY (`id_autore`) REFERENCES `autore` (`id_autore`),
  ADD CONSTRAINT `libro_casaeditrice` FOREIGN KEY (`id_casa_editrice`) REFERENCES `casaeditrice` (`id_casa_editrice`);

--
-- Limiti per la tabella `librotag`
--
ALTER TABLE `librotag`
  ADD CONSTRAINT `libro_tag` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`);

--
-- Limiti per la tabella `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `lista_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`);

--
-- Limiti per la tabella `listalibro`
--
ALTER TABLE `listalibro`
  ADD CONSTRAINT `lista_libro` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  ADD CONSTRAINT `lista_lista` FOREIGN KEY (`id_lista`) REFERENCES `lista` (`id_lista`);

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `pref_libro` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  ADD CONSTRAINT `pref_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
