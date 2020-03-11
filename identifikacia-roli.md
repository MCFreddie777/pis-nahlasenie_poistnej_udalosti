# Identifikácia rolí

__Role:__ poistenec, pracovník poisťovne, vodič, hodnotiteľ, systém

__Proces:__

1. Prihlásenie do systému 
   - Úspešné prihlásenie (IN: Meno,Heslo OUT:Prihlásenie)
   - Generovanie nových údajov (IN: žiadosť o nove údaje OUT: Nové údaje)
1. Zadanie detailov udalosti (IN: detaily udalosti OUT: Objekt s údajmy)
   - Overenie detailov
   - Výpočet percenta krytia škody (IN: Objekt s detailmi OUT: hodnota krytia)
1. Pracovník poisťovne dostane poistnú udalosť
   - Vypýtanie dodatočných údajov
   - Uloženie udalosti ako rozpracovaná
   - Posunutie udalosti hodnotiteľovi  Uloženie udalosti ako „pred hodnotením"
   - Posielanie notifikácií používateľovi (IN: Poistná udalosť OUT: Notifikovanie používateľa)

__VSTUP:__ údaje o poistencovi, poistnej udalosti

__VÝSTUP:__ správa pre poistenca
