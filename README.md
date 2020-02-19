# Nahlásenie poistnej udalosti
Project at FIIT STUBA for PIS course


**Vstup**: údaje o poistencovi, poistnej udalosti
**Výstup**: správa pre poistenca
**Cieľ procesu**: nahlásenie poistnej udalosti poisťovni a posunutie udalosti hodnotiteľovi

Tento proces umožní poistencovi nahlásiť poistnú udalosť. Môže tak učiniť telefonicky,
poštou, osobne na pobočke alebo online. Namodelujte poslednú možnosť.
Najprv je nutné vyriešiť podproces prihlasovania. Poistenec by prihlasovacie údaje mal
mať, ale mohol ich zabudnúť, vtedy treba generovať nové heslo do systému.
Každá poistná udalosť sa viaže na konkrétnu poistnú zmluvu. Po zadaní detailov
o udalosti systém overí, či zadané údaje sedia, napr. či hlásená škoda nie je vyššia ako
hodnota vozidla, krytie poistky. Systém určí percento krytia škody na základe doby
od poslednej nehody poistenca.
Zadanú poistnú udalosť dostane pracovník poisťovne. Predpokladajte, že všetky údaje
nemá pracovník poisťovne okamžite k dispozícii a môže si dodatočnú dokumentáciu
vypýtať od poistenca. Udalosť sa v takomto prípade uloží ako rozpracovaná. Po zadaní
všetkých údajov a dokumentov, môže pracovník posunúť udalosť hodnotiteľovi a udalosť
sa uloží do stavu „pred hodnotením“. Po každom medzikroku (prebraní udalosti
pracovníkom, vyžiadaní dodatočnej dokumentácie aj posunutí na hodnotenie) sa odošle
poistencovi notifikácia spôsobom, ktorý si zvolil pri prihlasovaní sa do poisťovne.

Ste biznis analytikom vo firme, ktorá dostala zákazku na informačný systém
pre poisťovňu. Vám bola na projekte pridelená práca týkajúca sa modelovania niektorých
konkrétnych procesov, ktoré sa vyskytujú v poisťovni. Vaša úloha je oboznámiť sa
s doménovou oblasťou a vytvoriť jeden a viac procesov. Musíte navrhnúť jednotlivé časti
tohto procesu – biznis roly, ľudské úlohy a systémové úlohy, t. j., navrhnúť webové
služby, ktoré vám zabezpečia cieľ vášho procesu. Niektoré webové služby už boli vopred
vytvorené a zdokumentované. Ak by sa vám zišla nejaká ďalšia služba, môžete využiť aj
iné služby ako sú na stránke predmetu: http://pis.predmety.fiit.stuba.sk/
Namodelujte potrebné rozhodovania a podmienky, za ktorých sa proces musí ukončiť.
Vytvorte dátový model a definujte biznis objekty, ktoré budú vystupovať v procese.
Na modelovanie budete používať nástroj Camunda Modeler. Návrh môžete
implementovať ľubovoľnými technológiami.
Pozorne si prečítajte, aký proces máte namodelovať. Opíšte, ako dosiahnete cieľ procesu
a kroky, ktorými sa k nemu musíte dostať. Myslite na to, že niektoré kroky sa môžu
vykonať paralelne.
