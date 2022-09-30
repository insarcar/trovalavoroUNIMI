-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 24, 2020 alle 17:35
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trovalavorounimi`
--

-- --------------------------------------------------------
CREATE DATABASE `trovalavorounimi`;
USE trovalavorounimi;
--
-- Struttura della tabella `annuncio`
--

CREATE TABLE `annuncio` (
  `idannuncio` int(10) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `datapubb` date NOT NULL DEFAULT curdate(),
  `periodovisibilita` int(3) DEFAULT NULL,
  `descrizione` text NOT NULL,
  `retrlorda` decimal(8,2) DEFAULT NULL,
  `datainizio` date NOT NULL,
  `tipovisibilita` enum('public','private','specific') DEFAULT 'private',
  `email` varchar(50) NOT NULL,
  `tiposettore` enum('Acquisti, logistica, magazzino','Amministrazione, contabilita, segreteria','Commercio al dettaglio, GDO, Retail','Finanza, banche e credito','Ingegneria','Professioni e mestieri','Settore farmaceutico','Affari legali','Arti grafiche, design','Edilizia, immobiliare','Formazione, istruzione','Marketing, comunicazione','Pubblica amministrazione','Turismo, ristorazione','Altre','Attenzione al cliente','Farmacia, medicina, salute','Informatica, IT e telecomunicazioni','Operai, produzione, qualita','Risorse umane, recruiting','Vendite') DEFAULT NULL,
  `tipocontratto` enum('Contratto a tempo determinato','Contratto a tempo indeterminato','Contratto a chiamata') NOT NULL,
  `durata` int(3) DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `ngiorni` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `annuncio`
--

INSERT INTO `annuncio` (`idannuncio`, `titolo`, `datapubb`, `periodovisibilita`, `descrizione`, `retrlorda`, `datainizio`, `tipovisibilita`, `email`, `tiposettore`, `tipocontratto`, `durata`, `datafine`, `ngiorni`) VALUES
(0, 'Giovane operatore elettromeccanico', '2019-11-10', 365, 'Cerchiamo operatore elettromeccanico junior', NULL, '2020-01-09', 'public', 'novacart@assunzioni.it', 'Operai, produzione, qualita', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(1, 'Si cerca uno sviluppatore di applicazioni web', '2019-10-10', 365, 'Cerchiamo front end developer con esperienza di lavoro in team complessi', '2600.00', '2020-02-11', 'public', 'asus.hr@assunzioni.it', 'Informatica, IT e telecomunicazioni', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(2, 'Cercasi perito chimico (stage d\'apprendimento incluso)', '2019-09-10', 365, 'Cerchiamo perito chimico da formare', '1000.00', '2020-01-11', 'public', 'limontaparati@limonta.ass.it', 'Operai, produzione, qualita', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(3, 'Richiesto tourist promoter, consulenze commerciali', '2019-11-09', 365, 'Cerchiamo tourist promoter per lavoro di consulenza commerciale con un grosso cliente', '1670.00', '2020-03-20', 'private', 'commercialiagency@libero.it', NULL, 'Contratto a chiamata', NULL, NULL, NULL),
(4, 'Cerchiamo manager per la gestione delle risorse destinate alle campagne pubblicitarie', '2019-11-01', 365, 'Cerchiamo marketing manager per una serie di progetti a lungo termine', '5500.00', '2020-01-09', 'public', 'apple.mgmt.mi@hr.apple.it', 'Marketing, comunicazione', 'Contratto a tempo determinato', 36, '2023-01-01', 5),
(5, 'Ingegnere informatico, machine learning', '2019-10-18', 365, 'Cerchiamo senior automation engineer per progetto di ricerca a lungo termine', '12000.00', '2020-01-09', 'specific', 'asus.hr@assunzioni.it', 'Ingegneria', 'Contratto a tempo determinato', 24, '2022-01-01', 6),
(6, 'Commesso Mondadori Store', '2020-01-15', 30, 'Si ricerca una giovane commessa disposta a lavorare nel Mondadori Store in via Campi di Grano - MO ', '800.00', '2020-02-10', 'public', 'mondadori@hotbook.it', 'Vendite', 'Contratto a tempo determinato', 12, '2021-02-10', 5),
(7, 'Ingegnere meccanico specializzato in costruzione di motori', '2019-07-11', 365, 'Cerchiamo un ingegnere meccanico appassionato al mondo dell\'automobilismo in grado di affiancare il team di specialisti qui in Lamborghini', NULL, '2019-10-20', 'specific', 'lamborghini@lambo.it', 'Ingegneria', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(8, 'Tecnico per manutenzione/riparazione macchine impastatrici', '2020-01-01', 700, 'Cerchiamo un tecnico disposto a specializzarsi sui macchinari usati qui in Ferrero per la produzione di dolci', NULL, '2020-01-10', 'specific', 'sweetferrero@ferrero.it', 'Operai, produzione, qualita', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(9, 'Cercasi psicoterapeuta', '2019-09-25', 365, 'Nel nostro istituto è richiesto uno psicoterapeuta per poter aiutare maggiormente i nostri pazienti', NULL, '2019-10-05', 'public', 'gulliver@gmail.com', 'Farmacia, medicina, salute', 'Contratto a chiamata', NULL, NULL, NULL),
(10, 'Cerchiamo Maitre Chocolatier', '2019-11-30', 365, 'Cerchiamo un pasticciere/Maitre Chocolatier pronto ad unirsi al team Ferrero', '7000.00', '2020-01-09', 'public', 'sweetferrero@ferrero.it', 'Altre', 'Contratto a tempo determinato', 24, '2022-01-20', 6),
(11, 'Cercasi insegnante/esperto di musica', '2019-05-22', 600, 'Si richiede un individuo appassionato ed esperto di musica che possa fare periodicamente degli incontri con i nostri ragazzi in modo da insegnargli il valore terapeutico della musica', '1800.00', '2020-01-09', 'public', 'gulliver@gmail.com', 'Formazione, istruzione', 'Contratto a tempo determinato', 36, '2022-05-22', 3),
(12, 'Fabriano General Manager', '2020-01-05', 60, 'La Fabriano ha recentemente aperto una sede anche a Grenoble in Francia, saremmo interessati a trovare un giovane direttore pronto ad incominciare questa nuova avventura', NULL, '2020-01-25', 'specific', 'fabriano@fogliame.it', 'Amministrazione, contabilita, segreteria', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(13, 'Restauratore/riparatore di strumenti musicali', '2019-11-25', 365, 'Cerchiamo un esperto di strumenti musicali/liutaio in grado di effettuare piccole e semplici riparazioni agli strumenti che arrivano in negozio', '1100.00', '2020-01-03', 'public', 'moltenistrumentimusicali@live.it', 'Professioni e mestieri', 'Contratto a tempo determinato', 12, '2021-01-03', 4),
(14, 'Pubblicità Poltronesofà estate 2020', '2019-10-18', 365, 'Cerchiamo un esperto nel campo della comunicazione multimediale per promuovere al meglio attraverso una campagna pubblicitaria la nostra nuova collezione di divani', '2500.00', '2020-02-01', 'public', 'poltronesofa@artigiano.it', 'Marketing, comunicazione', 'Contratto a tempo determinato', 10, '2020-12-01', 5),
(15, 'Cercasi stand-up comedian', '2020-01-03', 330, 'Come di consueto la nostra azienda celebra il lavoro svolto alla fine dell\'anno con un divertente spettacolo per ravvivare lo spirito dei dipendenti. Cerchiamo comici, cabarettisti.', '2000.00', '2020-12-20', 'public', 'stabiloboss@gmail.com', 'Altre', 'Contratto a tempo determinato', 1, '2020-12-21', 1),
(16, 'Commesso reparto uomo', '2019-10-30', 365, 'Cerchiamo un commesso/a per la gestione del reparto uomo della nostra nuova sede a Milano. Il candidato deve essere spigliato e propenso all\'interazione coi clienti', NULL, '2019-12-09', 'public', 'zaraofficial@live.it', 'Vendite', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(17, 'Cercasi meccanico', '2020-01-17', 365, 'É richiesto un giovane meccanico, abituato anche a lavorare in gruppo. Non è importante che sia altamente specializzato, la nostra squadra nel caso sarebbe pronta a guidarlo. Si richiede comunque una buona preparazione e spirito collaborativo', NULL, '2020-02-10', 'public', 'autoalberta@auto.it', 'Operai, produzione, qualita', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(18, 'Cercasi architetto/designer di impianti industriali', '2019-10-18', 700, 'Abbiamo intenzione di ampliare la nostra nuova sede a Grenoble in Francia, anche il fulcro del nuovo stabilimento è pronto per entrare in funzione, la dirigenza ha pensato che fosse consono ampliare il complesso con un ulteriore padiglione/area. Si cercano architetti con esperienza in campo industriale.', '15000.00', '2021-03-10', 'specific', 'fabriano@fogliame.it', 'Edilizia, immobiliare', 'Contratto a tempo determinato', 20, '2023-01-10', 6),
(19, 'Cerchiamo magazziniere', '2019-12-19', 365, 'Cerchiamo personale per lavorare organizzare gli articoli Ferrero nel magazzino. Il lavoro consiste nel organizzare, archiviare digitalmente, ed inscatolare i vari prodotti così da poterli rendere spedibili. É richiesta una buona attitudine al lavoro di squadra', NULL, '2020-04-15', 'public', 'sweetferrero@ferrero.it', 'Acquisti, logistica, magazzino', 'Contratto a tempo indeterminato', NULL, NULL, NULL),
(20, 'Cercasi influencer/rappresentante pubblicitario', '2020-01-18', 365, 'Cerchiamo un promoter della nostra nuova linea d\'abbigliamento invernale per l\'evento che si terrà il 22-12-2020', '8000.00', '2020-12-22', 'public', 'zaraofficial@live.it', 'Marketing, comunicazione', 'Contratto a tempo determinato', 1, '2020-12-22', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `azienda`
--

CREATE TABLE `azienda` (
  `email` varchar(50) NOT NULL,
  `pIVA` varchar(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ragionesociale` enum('S.s.','S.a.s.','S.n.c.','S.p.a.','S.a.p.a.','S.r.l.','S.r.ls.','Cooperativa Sociale') NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `via` varchar(50) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `CAP` varchar(5) NOT NULL,
  `nomec` varchar(40) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `azienda`
--

INSERT INTO `azienda` (`email`, `pIVA`, `password`, `ragionesociale`, `telefono`, `via`, `numero`, `CAP`, `nomec`, `logo`, `nome`, `foto`, `descrizione`) VALUES
('apple.mgmt.mi@hr.apple.it', '47258914356', 'aoksf49ji', 'S.p.a.', '021-419-7418', 'corso Sforza', '1', '20100', 'Milano', NULL, 'Apple Milano', NULL, NULL),
('assunzioni@anonimasequestri.humanresources.it', '00016798501', 'giveusmoney', 'S.s.', '081-512-4599', 'via Bolero', '5', '09100', 'Cagliari', NULL, 'Anonima Sequestri', NULL, 'Esperti decennali in human resources management and evaluation'),
('asus.hr@assunzioni.it', '00000147891', 'aokf24FJd32', 'S.a.p.a.', '081-678-1794', 'piazza Bellaria', '7/A', '60100', 'Ancona', NULL, 'Asus Ancona', NULL, NULL),
('autoalberta@auto.it', '0047699214', 'autoCarro22', 'S.r.l.', '033-464-8119', 'via Vesuvio', '11', '87100', 'Cosenza', NULL, 'Concessionaria/Officina Auto Alberta', NULL, 'Rivendiamo e ripariamo qualsiasi tipo di autovettura!'),
('commercialiagency@libero.it', '0012464897', 'jfakpojf93ji3', 'S.r.l.', '031-497-8529', 'via al Monte', '48', '37100', 'Verona', NULL, 'Agenzia Commercialisti Veronesi', NULL, 'Siamo quelli che vanno a dire ai commercianti locali di non fare gli scontrini'),
('dellafoglia@gmail.com', '0913285843', 'XmaancheD', 'S.n.c.', '312-0943-2211', 'via Monte Bianco', '29', '22100', 'Como', NULL, 'Della Foglia Saldature', NULL, NULL),
('fabriano@fogliame.it', '0607059335', 'Cialandro', 'S.a.s.', '056-556-4287', 'corso Hrothgar alto', '32', '60100', 'Ancona', NULL, 'Cartiere Fabriano', NULL, 'Gruppo di cartiere più importante in Italia'),
('gulliver@gmail.com', '0083941112', 'dammilassist', 'Cooperativa Sociale', '012-567-409', 'via Altura', '82', '30100', 'Venezia', NULL, 'Centro Gulliver', NULL, NULL),
('lamborghini@lambo.it', '9949294939', 'Murcielago', 'S.p.a.', '082-359-9366', 'via Impero', '7', '40100', 'Bologna', NULL, 'Lamborghini headquarters', NULL, 'Dal 1963 esportatori della classe automobilistica italiana nel mondo'),
('limontaparati@limonta.ass.it', '17846217489', 'aeofoefqWIJ12', 'S.p.a.', '031-186-7492', 'corso Giacomo Leopardi', '18', '24100', 'Bergamo', NULL, 'Limonta Parati', NULL, 'Leader regionali nella produzione di parati sintetici'),
('moltenistrumentimusicali@live.it', '0792948284', 'doesitdjentXD', 'S.s.', '332-316-7421', 'via Pasubio', '87', '47500', 'Cesena', NULL, 'Molteni strumenti musicali', NULL, 'Negozio di strumenti musicali'),
('mondadori@hotbook.it', '0485838294', 'anchequiSilviocihamessolozampino', 'S.p.a.', '393-892-9210', 'via Campi di grano', '32', '46100', 'Mantova', NULL, 'Bookstore Mondadori', NULL, 'Punto vendita Mondadori. Vedita di libri, film, serie tv, articoli di cancelleria e biglietti'),
('novacart@assunzioni.it', '00124646973', 'adsonodfaqi9oje', 'S.r.l.', '045-891-1234', 'via Stoppani', '4', '53100', 'Siena', NULL, 'Novacart', NULL, 'Azienda metalmeccanica radicata nel territorio'),
('poltronesofa@artigiano.it', '0987654321', 'dellaqualità', 'S.n.c.', '028-527-0983', 'corso Cavour', '8', '47100', 'Forlì', NULL, 'Poltronesofà', NULL, 'Artigiani della qualità dal 1995, produttori di divani e poltrone'),
('rodacciai@humanresources.racc.it', '01548289471', 'sfSPUDF3', 'S.p.a.', '051-492-3458', 'via Dante Alighieri', '9', '23100', 'Sondrio', NULL, 'Rodacciai', NULL, NULL),
('stabiloboss@gmail.com', '0038573298', 'Evidenziamoci', 'S.a.s.', '036-395-4468', 'via Rododendro', '34', '30100', 'Trento', NULL, 'Stabilo Trento', NULL, 'Da anni esperti produttori di penne, matite, evidenziatori, zaini, articoli di cancelleria.'),
('sweetferrero@ferrero.it', '0211486830', 'Nutellone', 'S.p.a.', '055-227-0932', 'via Velo', '33', '12100', 'Cuneo', NULL, 'Ferrero International', NULL, 'Azienda affermata da generazioni nella produzione alimentare di dolci'),
('zaraofficial@live.it', '0777938424', 'fescionblog', 'S.r.l.', '032-418-9221', 'via Morosini', '76', '21100', 'Varese', NULL, 'Zara Varese', NULL, 'Punto vendita del noto marchio di abbigliamento Zara');

-- --------------------------------------------------------

--
-- Struttura della tabella `candidato`
--

CREATE TABLE `candidato` (
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `datan` date NOT NULL,
  `via` varchar(50) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `CAP` varchar(5) NOT NULL,
  `nomec` varchar(40) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `candidato`
--

INSERT INTO `candidato` (`email`, `password`, `nome`, `cognome`, `datan`, `via`, `numero`, `CAP`, `nomec`, `foto`, `descrizione`) VALUES
('ajeje.brazoff@gmail.com', 'conduejejej', 'Ajeje', 'Brazoff', '1998-01-01', 'via XXV Aprile', '22/A', '93100', 'Caltanissetta', NULL, NULL),
('alberto.angela@rai.it', 'storicamente', 'Alberto', 'Angela', '1979-02-28', 'vicolo Cicerone', '11', '00100', 'Roma', NULL, 'Divulgatore storico-scientifico presso Rai'),
('crash@libero.it', 'wumpafruit', 'Crash', 'Bandicoot', '1973-02-12', 'corso Papu papu', '65', '48100', 'Ravenna', NULL, 'Pilota di macchine da corsa e valoroso avventuriero'),
('gastani.frinzi@gmail.com', 'suconquestisp', 'Gastani', 'Frinzi', '1974-10-29', 'via XXV Aprile', '31', '65100', 'Pescara', NULL, NULL),
('geeeerryscotty@berlusconi.it', 'passsaparola', 'Virginio', 'Scotti', '1956-08-07', 'corso Miradolo Terme', '56', '27100', 'Pavia', NULL, 'Presentatore televisivo, ex-deputato'),
('geraldo.fringi@hotmail.it', 'asonvdsqw0dqpuni', 'Geraldo', 'Fringi', '1987-03-23', 'piazza Idi di Marzo', '39', '73100', 'Lecce', NULL, NULL),
('gianluigi.buffon@libero.it', 'finoallaFine', 'Gianluigi', 'Buffon', '1978-01-28', 'via Mastro Lindo', '36', '10100', 'Torino', NULL, 'Abile saldatore. Nonché campione del mondo'),
('giulio.natta@polimi.it', 'polimeriii', 'Giulio', 'Natta', '1956-08-06', 'via Celoria', '18', '20100', 'Milano', NULL, NULL),
('giulio.rossi@libero.it', 'altronomebanale', 'Giulio', 'Rossi', '1995-07-29', 'corso san Cristoforo', '109/B', '27050', 'Valverde', NULL, NULL),
('guthriegovan@gmail.com', 'guitarGod71', 'Guthrie', 'Govan', '1971-12-27', 'via Val di non', '41-A', '50100', 'Firenze', NULL, 'Miglior chitarrista in circolazione'),
('humansafari@gmail.com', 'buuuuusta71', 'Nicolò', 'Balini', '1991-08-27', 'via Su per il monte', '12', '24100', 'Bergamo', NULL, 'Viaggiatore, promoter ed influencer'),
('johnny.english@alice.it', 'occhialata', 'Johnny', 'English', '1990-04-29', 'via Stoppani', '33/C', '82100', 'Benevento', NULL, 'Esperto di marketing e character design per chi paga'),
('lino.banfi@gmail.com', 'nonesageriamo', 'Lino', 'Banfi', '1940-12-12', 'piazza Badoglio', '19/B', '20100', 'Milano', NULL, 'Medico in famiglia, ma anche fuori'),
('marco.rossi@unimi.it', 'nomebanale', 'Marco', 'Rossi', '2000-07-19', 'via san Giuseppe', '28', '29100', 'Piacenza', NULL, 'Experienced business intelligence analyst'),
('matteo.salvini@hotmail.it', 'fenicotteriislamici', 'Matteo', 'Salvini', '1980-05-06', 'corso de Pazzi', '100', '50100', 'Firenze', NULL, 'Esperto in opinion leading e fake news riding'),
('maurizio.costanzo@rai.it', 'mariatiamo', 'Maurizio', 'Costanzo', '1930-08-08', 'via Merla', '25', '04100', 'Latina', NULL, NULL),
('maurizio.crozza@gmail.com', 'SilvanoBelfioreBand', 'Maurizio', 'Crozza', '1959-12-05', 'via Napoleone Bonaparte', '22', '16100', 'Genova', NULL, 'Comico, doppiatore, attore, scenografo, cantante dotato di spiccato intelletto e senso dell\'umorismo'),
('mirkoserraglia@gmail.com', 'msk4888GM', 'Mirko', 'Serraglia', '1984-10-21', 'via Poligono', '44', '72100', 'Brindisi', NULL, 'Da anni opero nella nel settore dell ricerca farmacologica. Farmacista da oltre vent\'anni'),
('myssketa@gmail.com', 'milanosushiecoca', 'MYSS', 'KETA', '1993-12-25', 'via Bamba', '21', '20900', 'Monza', NULL, 'Costruzione di un team di produttori che approfittano della mancanza di cultura musicale nel paese'),
('ofelia.cramberri@unimi.it', 'afsjiasji890322', 'Ofelia', 'Cramberri', '1999-10-07', 'via Giacomo Leopardi', '24', '27100', 'Pavia', NULL, 'Long life touristic promoter'),
('robertosaviano@hotmail.it', 'ZeroZeroZero', 'Roberto', 'Saviano', '1971-09-22', 'via A. Locatelli', '92', '80100', 'Napoli', NULL, 'Scrittore e sceneggiatore'),
('samar.gehebi@gmail.com', 'fnauwjfixvy25g9', 'Samar', 'Gehebi', '2001-09-21', 'via Giordano Bruno', '64', '13900', 'Biella', NULL, 'Operatore elettromeccanico'),
('umberto.bernasconi@gmail.com', 'ambedueueue', 'Umberto', 'Bernasconi', '1960-03-20', 'Piazza Monte Grappa', '63-C', '17100', 'Savona', NULL, 'Architetto, progettista di costruzioni'),
('vittorio.sgarbi@capra.com', 'capracapracapra', 'Vittorio', 'Sgarbi', '1964-11-08', 'Caprese', '82', '31100', 'Treviso', NULL, 'Critico d\'arte e public speaker'),
('yussef.fahri@gmail.com', 'jieqijfsdoheajqdwj', 'Yussef', 'Fahri', '1997-05-26', 'via san Matteo', '18/C', '42100', 'Reggio Emilia', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE `citta` (
  `CAP` varchar(5) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`CAP`, `nome`) VALUES
('00100', 'Roma'),
('01100', 'Viterbo'),
('02100', 'Rieti'),
('03100', 'Frosinone'),
('04100', 'Latina'),
('05100', 'Terni'),
('06100', 'Perugia'),
('07100', 'Sassari'),
('08020', 'San Teodoro'),
('08100', 'Nuoro'),
('09100', 'Cagliari'),
('09170', 'Oristano'),
('10010', 'Samone'),
('10100', 'Torino'),
('11100', 'Aosta'),
('12100', 'Cuneo'),
('13100', 'Vercelli'),
('13900', 'Biella'),
('14031', 'Calliano'),
('14100', 'Asti'),
('15100', 'Alessandria'),
('16100', 'Genova'),
('17100', 'Savona'),
('18100', 'Imperia'),
('19100', 'La Spezia'),
('20100', 'Milano'),
('20900', 'Monza'),
('21100', 'Varese'),
('22010', 'Livo'),
('22010', 'Peglio'),
('22100', 'Como'),
('23100', 'Sondrio'),
('23900', 'Lecco'),
('24063', 'Castro'),
('24100', 'Bergamo'),
('25100', 'Brescia'),
('26100', 'Cremona'),
('26900', 'Lodi'),
('27050', 'Valverde'),
('27100', 'Pavia'),
('28100', 'Novara'),
('28920', 'Verbania'),
('29100', 'Piacenza'),
('30100', 'Trento'),
('30100', 'Venezia'),
('31100', 'Treviso'),
('32100', 'Belluno'),
('32820', 'Livo'),
('33100', 'Udine'),
('33170', 'Pordenone'),
('34100', 'Trieste'),
('34170', 'Gorizia'),
('35100', 'Padova'),
('36100', 'Vicenza'),
('37100', 'Verona'),
('38059', 'Samone'),
('38060', 'Calliano'),
('39100', 'Bolzano'),
('40100', 'Bologna'),
('41100', 'Modena'),
('42100', 'Reggio Emilia'),
('43100', 'Parma'),
('44100', 'Ferrara'),
('45100', 'Rovigo'),
('46100', 'Mantova'),
('47100', 'Forlì'),
('47500', 'Cesena'),
('47900', 'Rimini'),
('48100', 'Ravenna'),
('50100', 'Firenze'),
('51100', 'Pistoia'),
('52100', 'Arezzo'),
('53100', 'Siena'),
('54033', 'Carrara'),
('55100', 'Lucca'),
('56100', 'Pisa'),
('57100', 'Livorno'),
('58100', 'Grosseto'),
('59100', 'Prato'),
('60100', 'Ancona'),
('61029', 'Urbino'),
('61049', 'Peglio'),
('61100', 'Pesaro'),
('62100', 'Macerata'),
('63100', 'Ascoli Piceno'),
('63900', 'Fermo'),
('64100', 'Teramo'),
('65100', 'Pescara'),
('66100', 'Chieti'),
('67100', 'L\'aquila'),
('70100', 'Bari'),
('71100', 'Foggia'),
('72100', 'Brindisi'),
('73030', 'Castro'),
('73100', 'Lecce'),
('74100', 'Taranto'),
('75100', 'Matera'),
('76121', 'Barletta'),
('76123', 'Andria'),
('76152', 'Trani'),
('80100', 'Napoli'),
('81100', 'Caserta'),
('82100', 'Benevento'),
('83100', 'Avellino'),
('84100', 'Salerno'),
('85100', 'Potenza'),
('86100', 'Campobasso'),
('86170', 'Isernia'),
('87100', 'Cosenza'),
('88100', 'Catanzaro'),
('88900', 'Crotone'),
('89900', 'Vibo Valentia'),
('90100', 'Palermo'),
('91100', 'Trapani'),
('92100', 'Agrigento'),
('93100', 'Caltanissetta'),
('94100', 'Enna'),
('95028', 'Valverde'),
('96100', 'Siracusa'),
('97100', 'Ragusa'),
('98030', 'San Teodoro');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `idcommento` int(10) NOT NULL,
  `idannuncio` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contenuto` text NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`idcommento`, `idannuncio`, `email`, `contenuto`, `data`) VALUES
(0, 0, 'matteo.salvini@hotmail.it', 'Ho visto volare dei fenicotteri islamici senza permesso', '2019-11-11 21:12:51'),
(1, 0, 'vittorio.sgarbi@capra.com', 'Capra Capra Ovino', '2019-11-11 21:13:11'),
(2, 0, 'maurizio.costanzo@rai.it', 'Ttate bboni ttate bboniiii', '2019-11-12 21:51:55'),
(3, 4, 'johnny.english@alice.it', 'Errore, signore, è una parola che non trova spazio nel mio dizionario.', '2019-12-12 21:51:55');

-- --------------------------------------------------------

--
-- Struttura della tabella `competenze`
--

CREATE TABLE `competenze` (
  `tiposettore` enum('Acquisti, logistica, magazzino','Amministrazione, contabilita, segreteria','Commercio al dettaglio, GDO, Retail','Finanza, banche e credito','Ingegneria','Professioni e mestieri','Settore farmaceutico','Affari legali','Arti grafiche, design','Edilizia, immobiliare','Formazione, istruzione','Marketing, comunicazione','Pubblica amministrazione','Turismo, ristorazione','Altre','Attenzione al cliente','Farmacia, medicina, salute','Informatica, IT e telecomunicazioni','Operai, produzione, qualita','Risorse umane, recruiting','Vendite') NOT NULL,
  `tipoesperienza` varchar(100) NOT NULL,
  `ordscolastico` enum('Scuola primaria','Istruzione secondaria di primo grado','Istruzione secondaria di secondo grado','Istruzione superiore','Alta formazione artistica, musicale e coreutica') NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `nome` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `competenze`
--

INSERT INTO `competenze` (`tiposettore`, `tipoesperienza`, `ordscolastico`, `titolo`, `nome`) VALUES
('Acquisti, logistica, magazzino', 'Magazziniere presso magazzino Amazon in Brianza', 'Istruzione secondaria di secondo grado', 'Geometra', 'Inglese'),
('Acquisti, logistica, magazzino', 'Magazziniere, disposizione di articoli su scaffali', 'Istruzione secondaria di primo grado', 'Scuola media', 'Inglese'),
('Amministrazione, contabilita, segreteria', 'Amministratore delegato per Gucci', 'Istruzione superiore', 'Master in economia', 'Cinese'),
('Amministrazione, contabilita, segreteria', 'Dirigente d\'azienda e di reparto', 'Istruzione superiore', 'Laurea in ingegneria gestionale', 'Inglese'),
('Commercio al dettaglio, GDO, Retail', 'Gestione della produzione e spedizione di capi Gucci', 'Istruzione superiore', 'Laurea magistrale in economia', 'Spagnolo'),
('Commercio al dettaglio, GDO, Retail', 'Gestore del reparto spedizioni per grandi aziende', 'Istruzione superiore', 'Master in economia', 'Spagnolo'),
('Ingegneria', 'Ingegnere meccanico', 'Istruzione superiore', 'Laurea magistrale in ingegneria meccanica', 'Inglese'),
('Ingegneria', 'Pilota ed ingegnere professionista di macchine da corsa', 'Istruzione superiore', 'Laurea magistrale in ingegneria meccanica', 'Tedesco'),
('Ingegneria', 'Software developer, esperto di machine learning', 'Istruzione superiore', 'Laurea magistrale di ingegneria informatica', 'Inglese'),
('Professioni e mestieri', 'Aiutante liutaio', 'Alta formazione artistica, musicale e coreutica', 'Diploma di conservatorio', 'Francese'),
('Professioni e mestieri', 'Liutaio, esperto di strumenti musicali', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Spagnolo'),
('Professioni e mestieri', 'Presentatore televisivo di programmi storico/scientifici', 'Istruzione superiore', 'Laurea magistrale in filosofia', 'Inglese'),
('Settore farmaceutico', 'Farmacista', 'Istruzione superiore', 'Laurea magistrale in farmacologia', 'Russo'),
('Edilizia, immobiliare', 'Architetto', 'Istruzione superiore', 'Laurea in architettura', 'Francese'),
('Edilizia, immobiliare', 'Architetto per varie aziende', 'Istruzione superiore', 'Master in architettura moderna', 'Inglese'),
('Formazione, istruzione', 'Insegnante di chitarra presso scuola di musica', 'Alta formazione artistica, musicale e coreutica', 'Diploma di conservatorio', 'Inglese'),
('Formazione, istruzione', 'Insegnante di musica', 'Alta formazione artistica, musicale e coreutica', 'Diploma liceo', 'Inglese'),
('Marketing, comunicazione', 'Artistic director per le strategie di marketing presso Gucci', 'Istruzione superiore', 'Laurea magistrale in ingegneria gestionale', 'Inglese'),
('Marketing, comunicazione', 'Character and icon desinger', 'Istruzione superiore', 'Master in Marketing', 'Cinese'),
('Marketing, comunicazione', 'Character and icon desinger', 'Istruzione superiore', 'Master in Marketing', 'Francese'),
('Marketing, comunicazione', 'Direttore tecnico per campagne pubblicitarie presso Adidas, Lindt e Electrolux', 'Istruzione superiore', 'Laurea magistrale comunicazione digitale', 'Inglese'),
('Marketing, comunicazione', 'Esperto in comunicazione digitale e pubblicità', 'Istruzione superiore', 'Laurea triennale in comunicazione digitale', 'Inglese'),
('Marketing, comunicazione', 'Promoter di prodotti', 'Istruzione secondaria di primo grado', 'Scuola media', 'Inglese'),
('Marketing, comunicazione', 'Senior marketing manager', 'Istruzione superiore', 'Master in Marketing', 'Inglese'),
('Altre', 'Comico, attore e cantante presso numerosi teatri', 'Istruzione superiore', 'Alta formazione artistica, musicale e coreutica', 'Tedesco'),
('Altre', 'Comico, stand-up comedian', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Inglese'),
('Altre', 'Cuoco, pasticciere, esperto di cioccolato', 'Istruzione superiore', 'Accademia di pasticceria', 'Inglese'),
('Farmacia, medicina, salute', 'Terapeuta, esperto di musica', 'Alta formazione artistica, musicale e coreutica', 'Diploma di conservatorio', 'Francese'),
('Informatica, IT e telecomunicazioni', 'Senior front end developer', 'Istruzione superiore', 'Laurea magistrale in Informatica', 'Inglese'),
('Operai, produzione, qualita', 'Controllo/ispezione di componenti meccaniche per la realizzazione di impianti termici', 'Istruzione secondaria di secondo grado', 'Ragioneria', 'Portoghese'),
('Operai, produzione, qualita', 'Meccanico presso officina di Cavaria con Premezzo', 'Istruzione secondaria di secondo grado', 'Itis, meccanica', 'Francese'),
('Operai, produzione, qualita', 'Meccanico, gommista, carrozziere', 'Istruzione secondaria di primo grado', 'Scuola media', 'Portoghese'),
('Operai, produzione, qualita', 'Perito chimico', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Inglese'),
('Operai, produzione, qualita', 'Riparatore di impianti industriali', 'Istruzione secondaria di secondo grado', 'Geometra', 'Inglese'),
('Vendite', 'Commessa', 'Istruzione secondaria di secondo grado', 'Liceo classico', 'Inglese'),
('Vendite', 'Commesso', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Tedesco'),
('Vendite', 'Commesso presso Decathlon', 'Istruzione secondaria di primo grado', 'Scuola media Dante Alighieri', 'Inglese'),
('Vendite', 'Rivenditrice di libri', 'Istruzione secondaria di secondo grado', 'Liceo classico', 'Francese');

-- --------------------------------------------------------

--
-- Struttura della tabella `curriculum`
--

CREATE TABLE `curriculum` (
  `idcurriculum` int(10) NOT NULL,
  `nomecv` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `suProfilo` enum('1','0') DEFAULT '0',
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `curriculum`
--

INSERT INTO `curriculum` (`idcurriculum`, `nomecv`, `email`, `suProfilo`, `descrizione`) VALUES
(0, 'curriculum1', 'johnny.english@alice.it', '1', 'DESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONE'),
(1, 'curriculumabba', 'alberto.angela@rai.it', '0', 'DESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONE'),
(2, 'curre', 'lino.banfi@gmail.com', '1', 'DESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONE'),
(3, 'curriculum1', 'ofelia.cramberri@unimi.it', '1', 'DESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONE'),
(4, 'curriculummum', 'johnny.english@alice.it', '1', 'DESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONE'),
(5, 'curriculummm', 'marco.rossi@unimi.it', '1', 'DESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONEDESCRIZIONE'),
(6, 'curriculumusic', 'guthriegovan@gmail.com', '1', 'So suonare bene. Conosco bene la musica. XD.'),
(7, 'curriculumusicthe', 'guthriegovan@gmail.com', '1', 'Conosco anche il potere terapeutico ed emotivo della musica.'),
(8, 'curriculbrumm', 'crash@libero.it', '1', 'Esperto pilota ed ingegnere di macchine da corsa'),
(9, 'curriculummissimo', 'crash@libero.it', '1', 'Intrattenitore di folle'),
(10, 'curric', 'humansafari@gmail.com', '0', 'Promuovo prodotti ad eventi o in video sulla rete'),
(11, 'curriculumauri', 'maurizio.crozza@gmail.com', '1', 'Comico ed intrattenitore per qualsiasi evenienza'),
(12, 'curriculuger', 'geeeerryscotty@berlusconi.it', '1', 'Abile lavoratore nel settore della logistica. Nessuno sistema i prodotti meglio di me.'),
(13, 'curriculumbe', 'umberto.bernasconi@gmail.com', '1', 'Pronto a progettare il tuo prossimo edificio.'),
(14, 'curriculllll', 'myssketa@gmail.com', '1', 'Non sono una grande cuoca ma con lo zucchero a velo me la cavo benissimo'),
(15, 'curriculbuff1', 'gianluigi.buffon@libero.it', '1', 'Saldatore con esperienza pluriennale'),
(16, 'curriculumrob', 'robertosaviano@hotmail.it', '0', 'General manager pronto a nuove avventure.'),
(17, 'curriculumrobl', 'robertosaviano@hotmail.it', '1', 'Offro consulenze terapeutiche su richiesta'),
(18, 'curriculucram', 'ofelia.cramberri@unimi.it', '1', 'Studentessa di letteratura amante dei libri'),
(19, 'curriculumirk', 'mirkoserraglia@gmail.com', '1', 'Esperto farmacista'),
(20, 'curriculalbe', 'alberto.angela@rai.it', '1', 'Redattore di libri di storia'),
(21, 'curriculbuff2', 'gianluigi.buffon@libero.it', '1', 'Oltre ad essere un campione del mondo e un ottimo saldatore, sono anche un ottimo tecnico di impanti di produzione generici'),
(22, 'curriculuff', 'geraldo.fringi@hotmail.it', '0', 'Abile commesso nel settore dell\'abbigliamento maschile'),
(23, 'curriculumajeje', 'ajeje.brazoff@gmail.com', '1', 'Discreto meccanico di motorini e macchine di bassa cilindrata'),
(24, 'curriculumusicology', 'guthriegovan@gmail.com', '1', 'Storico musicale/Musicologo'),
(25, 'curriculamar', 'samar.gehebi@gmail.com', '1', 'Esperto in campagne pubblicitarie televisive');

-- --------------------------------------------------------

--
-- Struttura della tabella `disponeazienda`
--

CREATE TABLE `disponeazienda` (
  `emailp` varchar(50) NOT NULL,
  `parola` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `disponeazienda`
--

INSERT INTO `disponeazienda` (`emailp`, `parola`) VALUES
('apple.mgmt.mi@hr.apple.it', 'word5'),
('apple.mgmt.mi@hr.apple.it', 'word6'),
('apple.mgmt.mi@hr.apple.it', 'word8'),
('asus.hr@assunzioni.it', 'word5'),
('asus.hr@assunzioni.it', 'word7'),
('asus.hr@assunzioni.it', 'word9'),
('novacart@assunzioni.it', 'word11'),
('novacart@assunzioni.it', 'word13'),
('novacart@assunzioni.it', 'word4');

-- --------------------------------------------------------

--
-- Struttura della tabella `disponecandidato`
--

CREATE TABLE `disponecandidato` (
  `emailp` varchar(50) NOT NULL,
  `parola` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `disponecandidato`
--

INSERT INTO `disponecandidato` (`emailp`, `parola`) VALUES
('ajeje.brazoff@gmail.com', 'word3'),
('gastani.frinzi@gmail.com', 'word8'),
('giulio.natta@polimi.it', 'word2'),
('giulio.natta@polimi.it', 'word4'),
('lino.banfi@gmail.com', 'word1'),
('lino.banfi@gmail.com', 'word10'),
('lino.banfi@gmail.com', 'word12'),
('lino.banfi@gmail.com', 'word6');

-- --------------------------------------------------------

--
-- Struttura della tabella `esplicita`
--

CREATE TABLE `esplicita` (
  `idcurriculum` int(10) NOT NULL,
  `tiposettore` enum('Acquisti, logistica, magazzino','Amministrazione, contabilita, segreteria','Commercio al dettaglio, GDO, Retail','Finanza, banche e credito','Ingegneria','Professioni e mestieri','Settore farmaceutico','Affari legali','Arti grafiche, design','Edilizia, immobiliare','Formazione, istruzione','Marketing, comunicazione','Pubblica amministrazione','Turismo, ristorazione','Altre','Attenzione al cliente','Farmacia, medicina, salute','Informatica, IT e telecomunicazioni','Operai, produzione, qualita','Risorse umane, recruiting','Vendite') NOT NULL,
  `tipoesperienza` varchar(100) NOT NULL,
  `ordscolastico` enum('Scuola primaria','Istruzione secondaria di primo grado','Istruzione secondaria di secondo grado','Istruzione superiore','Alta formazione artistica, musicale e coreutica') NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `periodo` int(3) NOT NULL,
  `votazione` varchar(4) NOT NULL,
  `livello` enum('Base','Medio','Avanzato') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `esplicita`
--

INSERT INTO `esplicita` (`idcurriculum`, `tiposettore`, `tipoesperienza`, `ordscolastico`, `titolo`, `nome`, `periodo`, `votazione`, `livello`) VALUES
(0, 'Marketing, comunicazione', 'Senior marketing manager', 'Istruzione superiore', 'Master in Marketing', 'Inglese', 48, '110L', 'Avanzato'),
(4, 'Marketing, comunicazione', 'Character and icon desinger', 'Istruzione superiore', 'Master in Marketing', 'Cinese', 48, '111', 'Avanzato'),
(5, 'Informatica, IT e telecomunicazioni', 'Senior front end developer', 'Istruzione superiore', 'Laurea magistrale in Informatica', 'Inglese', 150, '90', 'Avanzato'),
(6, 'Formazione, istruzione', 'Insegnante di chitarra presso scuola di musica', 'Alta formazione artistica, musicale e coreutica', 'Diploma di conservatorio', 'Inglese', 110, '96', 'Avanzato'),
(7, 'Professioni e mestieri', 'Aiutante liutaio', 'Alta formazione artistica, musicale e coreutica', 'Diploma di conservatorio', 'Francese', 60, '96', 'Medio'),
(8, 'Ingegneria', 'Pilota ed ingegnere professionista di macchine da corsa', 'Istruzione superiore', 'Laurea magistrale in ingegneria meccanica', 'Tedesco', 260, '110L', 'Avanzato'),
(11, 'Altre', 'Comico, attore e cantante presso numerosi teatri', 'Istruzione superiore', 'Alta formazione artistica, musicale e coreutica', 'Tedesco', 300, '100', 'Medio'),
(12, 'Acquisti, logistica, magazzino', 'Magazziniere presso magazzino Amazon in Brianza', 'Istruzione secondaria di secondo grado', 'Geometra', 'Inglese', 60, '64', 'Base'),
(13, 'Edilizia, immobiliare', 'Architetto per varie aziende', 'Istruzione superiore', 'Master in architettura moderna', 'Inglese', 150, '100', 'Avanzato'),
(15, 'Operai, produzione, qualita', 'Controllo/ispezione di componenti meccaniche per la realizzazione di impianti termici', 'Istruzione secondaria di secondo grado', 'Ragioneria', 'Portoghese', 200, '88', 'Base'),
(16, 'Amministrazione, contabilita, segreteria', 'Amministratore delegato per Gucci', 'Istruzione superiore', 'Master in economia', 'Cinese', 150, '90', 'Avanzato'),
(16, 'Commercio al dettaglio, GDO, Retail', 'Gestione della produzione e spedizione di capi Gucci', 'Istruzione superiore', 'Laurea magistrale in economia', 'Spagnolo', 150, '100', 'Avanzato'),
(16, 'Marketing, comunicazione', 'Artistic director per le strategie di marketing presso Gucci', 'Istruzione superiore', 'Laurea magistrale in ingegneria gestionale', 'Inglese', 150, '110L', 'Avanzato'),
(18, 'Vendite', 'Rivenditrice di libri', 'Istruzione secondaria di secondo grado', 'Liceo classico', 'Francese', 6, '93', 'Avanzato'),
(19, 'Settore farmaceutico', 'Farmacista', 'Istruzione superiore', 'Laurea magistrale in farmacologia', 'Russo', 200, '99', 'Medio'),
(20, 'Professioni e mestieri', 'Presentatore televisivo di programmi storico/scientifici', 'Istruzione superiore', 'Laurea magistrale in filosofia', 'Inglese', 130, '100', 'Avanzato'),
(22, 'Vendite', 'Commesso presso Decathlon', 'Istruzione secondaria di primo grado', 'Scuola media Dante Alighieri', 'Inglese', 90, '90', 'Base'),
(23, 'Operai, produzione, qualita', 'Meccanico presso officina di Cavaria con Premezzo', 'Istruzione secondaria di secondo grado', 'Itis, meccanica', 'Francese', 36, '90', 'Medio'),
(25, 'Marketing, comunicazione', 'Direttore tecnico per campagne pubblicitarie presso Adidas, Lindt e Electrolux', 'Istruzione superiore', 'Laurea magistrale comunicazione digitale', 'Inglese', 163, '85', 'Avanzato');

-- --------------------------------------------------------

--
-- Struttura della tabella `keyword`
--

CREATE TABLE `keyword` (
  `parola` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `keyword`
--

INSERT INTO `keyword` (`parola`) VALUES
('word1'),
('word10'),
('word11'),
('word12'),
('word13'),
('word2'),
('word3'),
('word4'),
('word5'),
('word6'),
('word7'),
('word8'),
('word9');

-- --------------------------------------------------------

--
-- Struttura della tabella `relativoa`
--

CREATE TABLE `relativoa` (
  `idannuncio` int(10) NOT NULL,
  `idcurriculum` int(10) NOT NULL,
  `giudizio` enum('Adeguato','Pienamente adeguato','Non adeguato') DEFAULT NULL,
  `esito` enum('Accettato','Non accettato') DEFAULT NULL,
  `notifica` enum('1','0') DEFAULT '0',
  `motivazione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `relativoa`
--

INSERT INTO `relativoa` (`idannuncio`, `idcurriculum`, `giudizio`, `esito`, `notifica`, `motivazione`) VALUES
(1, 5, 'Adeguato', 'Accettato', '1', NULL),
(3, 3, 'Adeguato', 'Non accettato', NULL, 'Il candidato non soddisfa i requisiti linguistici'),
(4, 0, 'Pienamente adeguato', 'Accettato', '1', NULL),
(4, 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `richiede`
--

CREATE TABLE `richiede` (
  `idannuncio` int(10) NOT NULL,
  `tiposettore` enum('Acquisti, logistica, magazzino','Amministrazione, contabilita, segreteria','Commercio al dettaglio, GDO, Retail','Finanza, banche e credito','Ingegneria','Professioni e mestieri','Settore farmaceutico','Affari legali','Arti grafiche, design','Edilizia, immobiliare','Formazione, istruzione','Marketing, comunicazione','Pubblica amministrazione','Turismo, ristorazione','Altre','Attenzione al cliente','Farmacia, medicina, salute','Informatica, IT e telecomunicazioni','Operai, produzione, qualita','Risorse umane, recruiting','Vendite') NOT NULL,
  `tipoesperienza` varchar(100) NOT NULL,
  `ordscolastico` enum('Scuola primaria','Istruzione secondaria di primo grado','Istruzione secondaria di secondo grado','Istruzione superiore','Alta formazione artistica, musicale e coreutica') NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `periodo` int(3) NOT NULL,
  `votazione` varchar(4) DEFAULT NULL,
  `livello` enum('Base','Medio','Avanzato') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `richiede`
--

INSERT INTO `richiede` (`idannuncio`, `tiposettore`, `tipoesperienza`, `ordscolastico`, `titolo`, `nome`, `periodo`, `votazione`, `livello`) VALUES
(1, 'Informatica, IT e telecomunicazioni', 'Senior front end developer', 'Istruzione superiore', 'Laurea magistrale in Informatica', 'Inglese', 24, NULL, NULL),
(2, 'Operai, produzione, qualita', 'Perito chimico', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Inglese', 3, NULL, 'Medio'),
(4, 'Marketing, comunicazione', 'Senior marketing manager', 'Istruzione superiore', 'Master in Marketing', 'Inglese', 36, NULL, 'Avanzato'),
(5, 'Ingegneria', 'Software developer, esperto di machine learning', 'Istruzione superiore', 'Laurea magistrale di ingegneria informatica', 'Inglese', 50, '110', 'Avanzato'),
(6, 'Vendite', 'Commessa', 'Istruzione secondaria di secondo grado', 'Liceo classico', 'Inglese', 3, NULL, 'Medio'),
(7, 'Ingegneria', 'Ingegnere meccanico', 'Istruzione superiore', 'Laurea magistrale in ingegneria meccanica', 'Inglese', 36, NULL, 'Avanzato'),
(8, 'Operai, produzione, qualita', 'Riparatore di impianti industriali', 'Istruzione secondaria di secondo grado', 'Geometra', 'Inglese', 12, NULL, NULL),
(9, 'Farmacia, medicina, salute', 'Terapeuta, esperto di musica', 'Alta formazione artistica, musicale e coreutica', 'Diploma di conservatorio', 'Francese', 2, NULL, NULL),
(10, 'Altre', 'Cuoco, pasticciere, esperto di cioccolato', 'Istruzione superiore', 'Accademia di pasticceria', 'Inglese', 40, NULL, 'Medio'),
(11, 'Formazione, istruzione', 'Insegnante di musica', 'Alta formazione artistica, musicale e coreutica', 'Diploma liceo', 'Inglese', 36, NULL, 'Medio'),
(12, 'Amministrazione, contabilita, segreteria', 'Dirigente d\'azienda e di reparto', 'Istruzione superiore', 'Laurea in ingegneria gestionale', 'Inglese', 40, '90', 'Avanzato'),
(12, 'Commercio al dettaglio, GDO, Retail', 'Gestore del reparto spedizioni per grandi aziende', 'Istruzione superiore', 'Master in economia', 'Spagnolo', 20, NULL, NULL),
(13, 'Professioni e mestieri', 'Liutaio, esperto di strumenti musicali', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Spagnolo', 36, NULL, NULL),
(14, 'Marketing, comunicazione', 'Esperto in comunicazione digitale e pubblicità', 'Istruzione superiore', 'Laurea triennale in comunicazione digitale', 'Inglese', 36, NULL, 'Medio'),
(15, 'Altre', 'Comico, stand-up comedian', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Inglese', 22, NULL, 'Base'),
(16, 'Vendite', 'Commesso', 'Istruzione secondaria di secondo grado', 'Istituto professionale', 'Tedesco', 12, NULL, NULL),
(17, 'Operai, produzione, qualita', 'Meccanico, gommista, carrozziere', 'Istruzione secondaria di primo grado', 'Scuola media', 'Portoghese', 12, NULL, NULL),
(18, 'Edilizia, immobiliare', 'Architetto', 'Istruzione superiore', 'Laurea in architettura', 'Francese', 36, '95', NULL),
(19, 'Acquisti, logistica, magazzino', 'Magazziniere, disposizione di articoli su scaffali', 'Istruzione secondaria di primo grado', 'Scuola media', 'Inglese', 20, NULL, NULL),
(20, 'Marketing, comunicazione', 'Promoter di prodotti', 'Istruzione secondaria di primo grado', 'Scuola media', 'Inglese', 2, NULL, 'Base');

-- --------------------------------------------------------

--
-- Struttura della tabella `settorelavorativo`
--

CREATE TABLE `settorelavorativo` (
  `tiposettore` enum('Acquisti, logistica, magazzino','Amministrazione, contabilita, segreteria','Commercio al dettaglio, GDO, Retail','Finanza, banche e credito','Ingegneria','Professioni e mestieri','Settore farmaceutico','Affari legali','Arti grafiche, design','Edilizia, immobiliare','Formazione, istruzione','Marketing, comunicazione','Pubblica amministrazione','Turismo, ristorazione','Altre','Attenzione al cliente','Farmacia, medicina, salute','Informatica, IT e telecomunicazioni','Operai, produzione, qualita','Risorse umane, recruiting','Vendite') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `settorelavorativo`
--

INSERT INTO `settorelavorativo` (`tiposettore`) VALUES
('Acquisti, logistica, magazzino'),
('Amministrazione, contabilita, segreteria'),
('Commercio al dettaglio, GDO, Retail'),
('Finanza, banche e credito'),
('Ingegneria'),
('Professioni e mestieri'),
('Settore farmaceutico'),
('Affari legali'),
('Arti grafiche, design'),
('Edilizia, immobiliare'),
('Formazione, istruzione'),
('Marketing, comunicazione'),
('Pubblica amministrazione'),
('Turismo, ristorazione'),
('Altre'),
('Attenzione al cliente'),
('Farmacia, medicina, salute'),
('Informatica, IT e telecomunicazioni'),
('Operai, produzione, qualita'),
('Risorse umane, recruiting'),
('Vendite');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `annuncio`
--
ALTER TABLE `annuncio`
  ADD PRIMARY KEY (`idannuncio`),
  ADD UNIQUE KEY `datapubb` (`datapubb`,`descrizione`,`email`) USING HASH,
  ADD KEY `email` (`email`),
  ADD KEY `tiposettore` (`tiposettore`);

--
-- Indici per le tabelle `azienda`
--
ALTER TABLE `azienda`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `pIVA` (`pIVA`),
  ADD KEY `CAP` (`CAP`,`nomec`);

--
-- Indici per le tabelle `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`email`),
  ADD KEY `CAP` (`CAP`,`nomec`);

--
-- Indici per le tabelle `citta`
--
ALTER TABLE `citta`
  ADD PRIMARY KEY (`CAP`,`nome`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`idcommento`),
  ADD KEY `idannuncio` (`idannuncio`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `competenze`
--
ALTER TABLE `competenze`
  ADD PRIMARY KEY (`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`);

--
-- Indici per le tabelle `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`idcurriculum`),
  ADD UNIQUE KEY `nomecv` (`nomecv`,`email`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `disponeazienda`
--
ALTER TABLE `disponeazienda`
  ADD PRIMARY KEY (`emailp`,`parola`),
  ADD KEY `parola` (`parola`);

--
-- Indici per le tabelle `disponecandidato`
--
ALTER TABLE `disponecandidato`
  ADD PRIMARY KEY (`emailp`,`parola`),
  ADD KEY `parola` (`parola`);

--
-- Indici per le tabelle `esplicita`
--
ALTER TABLE `esplicita`
  ADD PRIMARY KEY (`idcurriculum`,`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`),
  ADD KEY `tiposettore` (`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`);

--
-- Indici per le tabelle `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`parola`);

--
-- Indici per le tabelle `relativoa`
--
ALTER TABLE `relativoa`
  ADD PRIMARY KEY (`idannuncio`,`idcurriculum`),
  ADD KEY `idcurriculum` (`idcurriculum`);

--
-- Indici per le tabelle `richiede`
--
ALTER TABLE `richiede`
  ADD PRIMARY KEY (`idannuncio`,`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`),
  ADD KEY `tiposettore` (`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`);

--
-- Indici per le tabelle `settorelavorativo`
--
ALTER TABLE `settorelavorativo`
  ADD PRIMARY KEY (`tiposettore`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  ADD CONSTRAINT `annuncio_ibfk_1` FOREIGN KEY (`email`) REFERENCES `azienda` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `annuncio_ibfk_2` FOREIGN KEY (`tiposettore`) REFERENCES `settorelavorativo` (`tiposettore`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `azienda`
--
ALTER TABLE `azienda`
  ADD CONSTRAINT `azienda_ibfk_1` FOREIGN KEY (`CAP`,`nomec`) REFERENCES `citta` (`CAP`, `nome`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `candidato_ibfk_1` FOREIGN KEY (`CAP`,`nomec`) REFERENCES `citta` (`CAP`, `nome`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`idannuncio`) REFERENCES `annuncio` (`idannuncio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`email`) REFERENCES `candidato` (`email`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `competenze`
--
ALTER TABLE `competenze`
  ADD CONSTRAINT `competenze_ibfk_1` FOREIGN KEY (`tiposettore`) REFERENCES `settorelavorativo` (`tiposettore`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `curriculum`
--
ALTER TABLE `curriculum`
  ADD CONSTRAINT `curriculum_ibfk_1` FOREIGN KEY (`email`) REFERENCES `candidato` (`email`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `disponeazienda`
--
ALTER TABLE `disponeazienda`
  ADD CONSTRAINT `disponeazienda_ibfk_1` FOREIGN KEY (`emailp`) REFERENCES `azienda` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disponeazienda_ibfk_2` FOREIGN KEY (`parola`) REFERENCES `keyword` (`parola`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `disponecandidato`
--
ALTER TABLE `disponecandidato`
  ADD CONSTRAINT `disponecandidato_ibfk_1` FOREIGN KEY (`emailp`) REFERENCES `candidato` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disponecandidato_ibfk_2` FOREIGN KEY (`parola`) REFERENCES `keyword` (`parola`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `esplicita`
--
ALTER TABLE `esplicita`
  ADD CONSTRAINT `esplicita_ibfk_1` FOREIGN KEY (`idcurriculum`) REFERENCES `curriculum` (`idcurriculum`) ON UPDATE CASCADE,
  ADD CONSTRAINT `esplicita_ibfk_2` FOREIGN KEY (`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`) REFERENCES `competenze` (`tiposettore`, `tipoesperienza`, `ordscolastico`, `titolo`, `nome`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `relativoa`
--
ALTER TABLE `relativoa`
  ADD CONSTRAINT `relativoa_ibfk_1` FOREIGN KEY (`idannuncio`) REFERENCES `annuncio` (`idannuncio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relativoa_ibfk_2` FOREIGN KEY (`idcurriculum`) REFERENCES `curriculum` (`idcurriculum`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `richiede`
--
ALTER TABLE `richiede`
  ADD CONSTRAINT `richiede_ibfk_1` FOREIGN KEY (`idannuncio`) REFERENCES `annuncio` (`idannuncio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `richiede_ibfk_2` FOREIGN KEY (`tiposettore`,`tipoesperienza`,`ordscolastico`,`titolo`,`nome`) REFERENCES `competenze` (`tiposettore`, `tipoesperienza`, `ordscolastico`, `titolo`, `nome`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
