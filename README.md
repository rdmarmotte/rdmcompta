## rdmCompta

### Installze

- installer apache 2
- installer MySQL 5.7
- installer PHP 7.1 to 7.4
- installer composer pour PHP
- utiliser git pour récupérer le project :

```bash
git clone git@gitlab.bappli.com:rdmarmotte/rdmcompta
cd rdmcompta
composer update
cp loc.example.php loc.php
cp pwd.example.php pwd.php
cp rdm.php ../
```

- configurer loc.php et pwd.php
- dans votre navigateur, appeler l'équivalent sur votre poste de http://localhost/rdm?X&Z
- cocher 'verbose' et lancer le recalcul du cache
- ouvrir la base de données et créer un utilisateur admin (algorithme de hash du mot de passe : SHA1)
- vous pouvez vous connecter et apprécier
