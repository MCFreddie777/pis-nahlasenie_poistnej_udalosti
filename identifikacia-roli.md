# Identifikácia rolí

**Role:** poistenec, pracovník poisťovne, vodič, hodnotiteľ, systém

**Proces:**

1. Nahlásenie poistnej udalosti online
1. Prihlásenie do systému
   1. Úspešné prihlásenie (IN: Meno,Heslo OUT:Prihlásenie)
   1. Generovanie nových údajov (IN: žiadosť o nove údaje OUT: Nové údaje)
1. Zadanie detailov udalosti (IN: detaily udalosti OUT: Objekt s údajmy)
1. Overenie detailov
   1. Overovanie detailov
   1. Výpočet percenta krytia škody (IN: Objekt s detailmi OUT: hodnota krytia)
1. Pracovník poisťovne dostane poistnú udalosť
   1. Vypýtanie dodatočných údajov
      1. Uloženie udalosti ako rozpracovaná
   1. Posunutie udalosti hodnotiteľovi
      1. Uloženie udalosti ako „pred hodnotením"
      
1. Posielanie notifikácií používateľovi (IN: Poistná udalosť OUT: Notifikovanie používateľa)

**VSTUP:** údaje o poistencovi, poistnej udalosti

**VÝSTUP:** správa pre poistenca
