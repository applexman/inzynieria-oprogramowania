-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 12 Cze 2023, 23:03
-- Wersja serwera: 10.5.8-MariaDB-1:10.5.8+maria~buster-log
-- Wersja PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ksiegarnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Obyczajowe'),
(2, 'Fantasy'),
(3, 'Manga'),
(6, 'Horror'),
(7, 'Psychologiczny'),
(8, 'Przygodowy'),
(9, 'Romans'),
(10, 'Shōjo'),
(11, 'Shōnen'),
(12, 'Thriller'),
(13, 'Light Novel'),
(14, 'Komedia'),
(15, 'Science Fiction'),
(16, 'Komedia Romantyczna'),
(17, 'Josei'),
(18, 'Dramat'),
(19, ' Seinen');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'klient@klient.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `idOrder`, `idProduct`, `quantity`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 1),
(3, 2, 2, 2),
(4, 3, 3, 1),
(5, 3, 1, 1),
(6, 4, 3, 1),
(7, 5, 2, 3),
(8, 6, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `post` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_polish_ci NOT NULL,
  `payment` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `idUser`, `total`, `orderDate`, `status`, `name`, `surname`, `city`, `street`, `post`, `email`, `phone`, `payment`) VALUES
(1, 3, 20, '2023-06-10', 'Złożone', 'Test', 'Testowy', 'Testowo', 'Testowa 1', '11-111', 'testowy@test.com', '123456789', 'Przelew bankowy'),
(2, 3, 65, '2023-06-10', 'Złożone', 'Jan', 'Kowalski', 'Testowo', 'Testowa', '12-3456', 'klient@klient.com', '123456789', 'Za pobraniem'),
(3, 3, 44, '2023-06-10', 'Złożone', 'Jan', 'Kowalski', 'Testowo', 'Testowa', '12-3456', 'klient@klient.com', '123456789', 'Za pobraniem'),
(4, 3, 19, '2023-06-10', 'Złożone', 'Jan', 'Kowalski', 'Testowo', 'Testowa', '12-3456', 'klient@klient.com', '123456789', 'Przelew bankowy'),
(5, 3, 60, '2023-06-12', 'Złożone', 'Jan', 'Kowalski', 'Testowo', 'Testowa', '12-3456', 'klient@klient.com', '123456789', 'Przelew bankowy'),
(6, 1, 39, '2023-06-12', 'Zamówienie anulowano', '', '', '', '', '', '', '', 'Za pobraniem');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_polish_ci NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `img`, `price`, `quantity`) VALUES
(1, 'Czerwona Piramida RICK RIORDAN', 'Od śmierci matki Carter i Sadie są sobie niemal obcy. Dziewczyna mieszka z dziadkami w Londynie, jej brat natomiast podróżuje po świecie z ojcem, wybitnym egiptologiem doktorem Juliusem Kane. Pewnej nocy doktor Kane zabiera Cartera i Sadie na „eksperyment naukowy” do British Museum, w nadziei że uda mu się z powrotem połączyć rodzinę. Zamiast tego jednak uwalnia egipskiego boga Seta, który skazuje doktora na wygnanie, a jego dzieci zmusza do ucieczki. Wkrótce Sadie i Carter odkrywają, że budzą się wszyscy bogowie Egiptu, a najgorszy z nich – Set – chce zniszczyć rodzinę Kane. Aby go powstrzymać, dzieci muszą podjąć niebezpieczną podróż po całym świecie. Będzie to zadanie, które przybliży je do prawdy o rodzinie i ujawni jej powiązania z tajnym stowarzyszeniem istniejącym od czasów faraonów.', 'Czerwona Piramida.png', 39, 15),
(2, 'Ognisty Tron RICK RIORDAN', 'Odkąd bogowie starożytnego Egiptu zostali wyzwoleni we współczesnym świecie, Carter Kane i jego siostra Sadie znaleźli się w tarapatach. Jako potomkowie Domu Życia Kane’owie są obdarzeni wyjątkowymi mocami, ale przebiegli bogowie nie dali młodym magom czasu na opanowanie choćby podstawowych umiejętności. A byłyby bardzo potrzebne – ich przerażający nieprzyjaciel, wąż chaosu Apopis rośnie w siłę. Jeśli w ciągu kilku dni nie zdołają zapobiec jego uwolnieniu, nastąpi koniec świata. Innymi słowy: zwykły dzień rodziny Kane’ów. Aby mieć jakiekolwiek szanse w walce z siłami chaosu, rodzeństwo musi przywrócić do życia boga słońca Ra – to zadanie przekraczające wszystko, czego dokonał jakikolwiek mag. Muszą odnaleźć trzy części Księgi Ra i nauczyć się zawartych w niej zaklęć. Och, nie wspomnieliśmy chyba, że nikt nie wie, gdzie Ra się znajduje. Krótko mówiąc: drugi tom „Kronik Rodu Kane” to wspaniała przygoda.', 'Ognisty Tron.png', 39, 15),
(3, 'Cień Węża RICK RIORDAN', 'Odkąd młodzi magowie Carter i Sadie Kane nauczyli się, jak postępować ścieżką starożytnych egipskich bogów, wiedzieli, że odegrają ważną rolę w przywracaniu Maat – porządku – w świecie. Nie spodziewali się jednak, że świat stanie się aż tak bardzo chaotyczny. Wąż Chaosu, Apopis, uwolnił się i grozi zniszczeniem świata za trzy dni. Magowie są podzieleni. Bogowie znikają, a ci, którzy pozostali, są słabi. Walt, jeden z najzdolniejszych uczniów Cartera i Sadie, ma przed sobą krótkie życie i już czuje, że jego siły słabną. Ziya jest zbyt zajęta opieką nad zgrzybiałym bogiem słońca Ra, żeby naprawdę pomóc. Czego może dokonać dwójka nastolatków i grupka ich jeszcze młodszych uczniów?', 'Cień Węża.png', 39, 14),
(4, 'Ręka Mistrza STEPHEN KING', 'Edgar Freemantle w ciężkim wypadku samochodowym traci rękę i równowagę psychiczną. Nękany niekontrolowanymi napadami szału, musi zacząć życie od początku. Za radą psychologa wyrusza na Duma Key, olśniewająco piękną i 2odludną wyspę na wybrzeżu Florydy, należącą do sędziwej Elizabeth Eastlake. Wynajmuje tam dom, wiedząc tylko jedno: chce rysować. Tworzone z chorobliwą pasją obrazy Edgara są owocem talentu, nad którym stopniowo przestaje mieć kontrolę. Kiedy tragiczne losy rodziny Eastlake`ów zaczynają wyłaniać się z mroków przeszłości, dzieła Freemantle`a objawiają swą coraz bardziej przerażającą i niszczycielską moc.', 'Ręka Mistrza.png', 45, 22),
(5, 'Toradora! #1 Light Novel TAKEMIYA YUYUKO', 'Kwiecień. Płatki wiśni tańczą na wietrze. Nowa klasa. Ryuuji Takasu zwykły chłopak pokarany przez los wzrokiem mordercy spotyka niziutką, niepozorną Taigę Aisakę, która okazuje się postrachem całej szkoły, krwiożerczym Tycim Tygrysem. Życie Ryuujiego zmienia się raz na zawsze, gdy przez przypadek poznaje sekret dziewczyny. Tak rozpoczyna się ich wspólna walka o zdobycie serc swoich ukochanych. Problem w tym, że zawsze pogodna, lecz trochę dziwna Minori Kushieda i wzorowy uczeń Yuusaku Kitamura  nie stanowią najłatwiejszych celów w tej miłosnej kampanii!', 'Toradora-Light-Novel.png', 45, 50),
(6, 'Igrzyska Śmierci SUZANNE COLLINS', 'Na ruinach dawnej Ameryki Północnej rozciąga się państwo Panem, z imponującym Kapitolem otoczonym przez dwanaście dystryktów. Okrutne władze stolicy zmuszają podległe sobie rejony do składania upiornej daniny. Raz w roku każdy dystrykt musi dostarczyć chłopca i dziewczynę między dwunastym a osiemnastym rokiem życia, by wzięli udział w Głodowych Igrzyskach, turnieju na śmierć i życie, transmitowanym na żywo przez telewizję. Szesnastoletnia Katniss Everdeen jest pewna, że wydaje na siebie wyrok śmieci , kiedy zgłasza się na ochotnika w miejsce młodszej siostry. Jednak Katniss nie jest zupełnie bez szans - życie w najbiedniejszym dystrykcie nauczyło  ją, co znaczy walka o przerwanie. Mimo to jeśli chce wygrać musi wybrać między wolą przerwania a człowieczeństwem, między życiem a wolnością.', 'Igrzyska Śmierci.png', 35, 20),
(7, 'W Pierścieniu Ognia SUZANNE COLLINS', 'Głodowe Igrzyska niespodziewanie wygrywa dwoje trybutów z Dwunastego Dystryktu: Katniss Everdeen i Peeta Mellark. Jednak jest to zwycięstwo okupione buntem. Katniss i Peeta powinni być szczęśliwi, w końcu zyskali bezpieczeństwo i dostatek. Tymczasem szerzą się pogłoski o rebelii przeciwko Kapitolowi - rebelii, której Katniss i Peeta stali się symbolem. W Kapitolu rośnie gniew i pragnienie zemsty.', 'W Pierścieniu Ognia.png', 35, 20),
(8, 'Kosogłos SUZANNE COLLINS', 'Katniss Everdeen, dziewczyna, która igra z ogniem, dwukrotnie przeżyła Głodowe Igrzyska, ale nadal nie jest bezpieczna. Szerzy się rewolucja i wygląda na to, ze wszyscy poza nią mieli udział w jej planowaniu. Tymczasem to Katniss ma odegrać główną rolę. Musi stać się Kosogłosem, symbolem rebelii, niezależnie od tego, ile będzie ją to kosztowało.', 'Kosogłos.png', 35, 20),
(9, 'Blask ALEXANDRA ADORNETTO', 'Do sennego miasteczka Venus Cove przybywają trzy anioły: Gabriel – wojownik, Ivy – uzdrowicielka oraz najmłodsza, a przy tym mającą w sobie najwięcej z człowieka, Bethany. Zadaniem aniołów jest nieść dobro światu, który w coraz większej skali ulega wpływom ciemności. Podczas misji zmuszeni są ukrywać swe nadnaturalne zdolności, świetlistą poświatę, a także – co najtrudniejsze – anielskie skrzydła. Nie powinny też przywiązywać się do pojedynczych ludzi... I wtedy Bethany w szkole, do której uczęszcza jako siedemnastolatka, poznaje Xaviera. Żadne z nich nie potrafi oprzeć się wzajemnemu przyciąganiu. Kiedy zaczyna łączyć ich prawdziwe uczucie, zdają sobie sprawę, że przekraczają granice ustalone przez niebo. I nie jest to jedynie zagrożenie dla ich szczęścia. Ciemne moce wziąć rosną w siłę. Nie ma czasu do stracenia. Czy, ta która miała ratować zdoła uratować siebie?', 'Blask.png', 30, 90),
(10, 'Hades ALEXANDRA ADORNETTO', 'Bethany Church jest aniołem. Została przysłana na ziemię, aby powstrzymać panoszące się siły ciemności. Choć zakochanie się w chłopaku nie było częścią odgórnego planu, więź pomiędzy Xavierem a Beth, nie była częścią planu, więź pomiędzy nim a Beth jest bardzo silna. Niestety, ani to uczucie, ani opieka dwójki archaniołów Gabriela i Ivy, nie zdołają uchronić Beth przed diabelskim podstępem, który zawiedzie ją wprost do czeluści piekielnych.  Jack Thorn zażąda za jej uwolnienie zapłaty, która nie tylko zagrozi Bethany, lecz może także kosztować życie jej bliskich. Czy Bethany nie straci wiarę w miłość? Czy zdoła wypełnić swoją misję? Czy niebo jej pomoże?', 'Hades.png', 30, 49),
(11, 'Dziedzictwo Krwi AMÉLIE WEN ZHAO', 'W Cesarstwie Cyrilyjskim dyskryminacja powinowatych jest powszechna. A księżniczka Anastazja Michajłowna ukrywa jedno z najbardziej przerażających powinowactw. Jej zdolność kontrolowania krwi długo trzymano w tajemnicy. Po zabójstwie ojca Ana staje się jednak jedyną podejrzaną. Żeby ratować własne życie, musi odnaleźć mordercę. Szybko się przekonuje, że spiskowcy już planują jak obalić stary porządek. Istnieje tylko jedna osoba, która może pomóc Anie dotrzeć do źródła tego spisku – Ramson Złotousty. To kuty na cztery nogi baron światka przestępczego Cyrilii, ale w tym przypadku trafiła kosa na kamień... Bo w tej historii najniebezpieczniejszym graczem jest księżniczka.', 'Dziedzictwo Krwi.png', 40, 34),
(12, 'Czerwona Tygrysica AMÉLIE WEN ZHAO', 'Z całej cyrilyjskiej rodziny cesarskiej przeżyła tylko Ana. Pozbawiona tronu, tytułu i sojuszników musi znaleźć sposób, by odzyskać władzę i uniknąć okrutnej zemsty ze strony cesarzowej. Morgania nie cofnie się przed niczym, by ustalić nowy porządek świata, przelewając przy tym krew niepowinowatych. By zwiększyć swoje szanse i sprostać niebezpieczeństwom, Ana postanawia wejść w sojusz z Ramsonem Złotoustym. Lecz sprytny lord przestępczego światka ma swoje plany. Aby Ana mogła zdobyć armię, muszą dotrzeć do niezdobytych fortów Bregonu. Nikt jednak nie wie, jakie tajemnice kryją forty. Mrok rośnie w siłę. Czy rewolucja przyniesie upragniony pokój czy raczej utopi świat we krwi?', 'Czerwona Tygrysica.png', 40, 25),
(13, 'Niewidzialne życie Addie Larue V.E. SCHWAB', 'Francja rok 1714. Uciekająca sprzed ołtarza młoda dziewczyna imieniem Adeline popełnia niewyobrażalny błąd. Zawiera umowę z diabłem. Faustowski pakt nakłada na nią ograniczenie - możliwość wiecznego życia bez szansy na bycie zapamiętaną przez kogokolwiek - dlatego Addie decyduje się opuścić swoją wioskę. Dziewczyna jest zdeterminowana znaleźć dla siebie właściwe miejsce, nawet jeśli została skazana na wieczną samotność. Ale czy na pewno? Każdego roku, w ndiu jej urodzin, tajemniczy Luc  przychodzi i pyta, czy Addie jest gotowa, by oddać mu swą duszę.', 'Niewidzialne życie Addie.png', 37, 35),
(14, 'Mroczna Wiedza NAOMI NOVIK', 'Scholomance to szkoła, w której nie ma nauczycieli, wakacji ani przyjaźni między uczniami – tylko strategiczne sojusze. Przetrwanie jest ważniejsze od stopni, gdyż młodzi magowie nie mogą opuścić szkoły, aż ją ukończą lub zginą. Obowiązujące w Scholomance zasady są proste: nie można chodzić samotnie po korytarzach i trzeba się strzec potworów, które czają się wszędzie. Poza tym niektórzy uczniowie praktykują czarną magię, a nawet mordują innych, żeby zwiększyć swoje szanse przeżycia. Galadriel Higgins, zwana El, potrafi stawić czoło niebezpieczeństwom czyhającym w Scholomance, ponieważ ma ogromną moc. Mogłaby bez trudu pokonać wszystkie grasujące potwory. Problem polega na tym, że równie łatwo mogłaby także zabić pozostałych uczniów...', 'Mroczna Wiedza.png', 38, 44),
(15, 'Ostatni Absolwent NAOMI NOVIK', 'Scholomance, szkoła dla magów, przez dziesiątki lat robiła, co mogła, żeby uśmiercić wszystkich uczniów. Po ostatnich dramatycznych wydarzeniach sytuacja jednak radykalnie się zmienia. Wygląda na to, że szkoła uwzięła się tylko na El, właśnie teraz, kiedy dotrwała ona do ostatniej klasy, a do tego zdobyła wreszcie grupkę sprzymierzeńców. Nawet jeśli El odeprze niekończące się ataki złowrogów nasyłanych na nię przez Scholomance w przerwach między nawałem uciążliwych zajęć, to wciąż nie ma pojęcia, jak wraz z sojuszniczkami zdoła ujść z życiem z auli po zakończeniu roku. Może powinna zaakceptować mroczną przepowiednię i zostać czarownicą siejącą śmierć i zniszczenie? Mimo licznych problemów El nie zamierza się poddać – ani złowrogom, ani przeznaczeniu, a zwłaszcza Scholomance. Nawet jeśli będzie musiała przy tym zginąć…', 'Ostatni Absolwent.png', 38, 32),
(16, 'Sprzedałem Swoje Życie za 10 000 jenów rocznie SUGARU MIAKI', 'Pewnego dnia dwudziestoletni Kusunoki dowiaduje się o niezwykłym sklepie, w którym skupuje się ludzkie życie. Z braku pieniędzy i perspektyw postanowił sprzedać większość czasy jaki mu pozostał. Przed nim ostatnie trzy miesiące życia, które ma spędzić pod okiem tajemniczej kobiety imieniem Miyagi.', 'Sprzedałem Swoje życie.png', 34, 32),
(17, 'Detektyw Sasaki KEISUKE MATSUOKA', 'Kotoha Minemori rozpoczyna pracę w Biurze Wewnętrznym agencji wywiadowczej Suma Research, gdzie poznaje swoją jedyną współpracowniczkę – detektyw Renę Sasaki. Ich cel to oczyścić środowisko z nieuczciwej konkurencji. Muszą jednak nie tylko tropić skorumpowanych “kolegów z branży”, ale też chronić przed nimi własne życie…', 'Detektyw Sasaki.png', 55, 34),
(18, 'Twoje Imię. 2 MAKOTO SHINKAI', 'Taki wpatruje się w wiadomość od Mitsuchy, ale zupełnie nie rozumie, o co chodzi. Jest też przygnębiony po nieudanej randce z Okuderą i nie może doczekać się następnej zamiany ciał. Ta jednak nigdy nie następuje. Mając za jedyną wskazówkę zdjęcia, które widział z Okuderą na wystawie „Nostalgia”, Taki wyrusza do Hidy, żeby odnaleźć Mitsuhę.', 'Twoje Imie Tom 2.png', 45, 31),
(19, 'Twoje Imię. #3 MAKOTO SHINKAI', 'Taki, wraz z Tesshim i Sayą, opracowuje plan ewakuacji Itomori. Wszystko, byle ocalić Mitsuhę! \"Rano gdy wstaję, mam łzy w oczach. To mi się czasami zdarza. Szukam czegoś, kogoś. To uczucie towarzyszy mi chyba.. od tamtego dnia. Oto poruszający finał opowieści o chłopaku i dziewczynie, których połączył cud.', 'Twoje Imie Tom 3.png', 37, 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `product_categories`
--

INSERT INTO `product_categories` (`id`, `productID`, `categoryID`) VALUES
(2, 2, 2),
(3, 3, 2),
(4, 4, 6),
(5, 4, 7),
(10, 6, 12),
(11, 6, 15),
(12, 7, 12),
(13, 7, 15),
(14, 8, 12),
(15, 8, 15),
(16, 9, 2),
(17, 9, 9),
(18, 9, 15),
(19, 10, 2),
(20, 10, 9),
(21, 10, 15),
(22, 11, 2),
(23, 11, 15),
(24, 12, 2),
(25, 12, 15),
(26, 13, 2),
(27, 13, 15),
(32, 14, 2),
(33, 14, 15),
(34, 15, 2),
(35, 15, 15),
(36, 16, 3),
(37, 16, 7),
(38, 16, 9),
(39, 16, 11),
(41, 17, 3),
(42, 17, 18),
(43, 17, 19),
(44, 18, 3),
(45, 18, 9),
(46, 18, 15),
(47, 18, 18),
(48, 19, 3),
(49, 19, 9),
(50, 19, 15),
(51, 19, 18),
(58, 1, 2),
(59, 5, 1),
(60, 5, 11),
(61, 5, 13),
(62, 5, 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `review_text` text COLLATE utf8mb4_polish_ci NOT NULL,
  `stars` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `reviews`
--

INSERT INTO `reviews` (`id`, `idProduct`, `idUser`, `review_text`, `stars`, `date`) VALUES
(1, 1, 1, 'Polecam', 5, '2023-05-30'),
(2, 1, 1, 'Fajne', 4, '2023-05-30'),
(3, 1, 4, 'Love <3', 5, '2023-06-12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `post` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_polish_ci NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `surname`, `city`, `street`, `post`, `email`, `phone`, `userID`) VALUES
(1, 'Jan', 'Kowalski', 'Testowo', 'Testowa 10', '12-3456', 'klient@klient.com', '123456789', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text COLLATE utf8mb4_polish_ci NOT NULL,
  `permissions` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`) VALUES
(1, 'admin@admin.com', '$2y$10$zYWxW3jzenNIDqs6cZ2G7uc8HrgXR5nPr.voURDBhDdkLioDqqBAO', 1),
(2, 'emp@emp.com', '$2y$10$pFu7r.V.pZauxSCVg92RK.9yRlbEWTE8pusb3j2g6cvpKSs6rxEIS', 2),
(3, 'klient@klient.com', '$2y$10$QSM2eRdGY.B9J9DAk0hGBe1d3/6k2TqfiGH.oOo5P7zgjuv6DXUri', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT dla tabeli `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
