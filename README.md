# webshop

WordPress + WooCommerce -projekti custom painatuksilla varustetuille tuotteille.

## Windows-kehitysymparisto

Suositeltu tapa ajaa projekti Windowsissa:

- Windows 11 tai uudehko Windows 10
- WSL2 kayttoon
- Docker Desktop asennettuna
- Git asennettuna

Docker Desktopissa varmista:

- WSL2 backend on kaytossa
- Docker Desktop on kaynnissa ennen kuin ajat komentoja

Suositus on avata projekti terminaalissa joko:

- PowerShellissa projektikansiossa
- tai WSL:n puolella, jos haluat Linux-tyokalut kayttoon

## Projektin kaynnistys paikallisesti

Paikallinen stack kaynnistyy Docker Composella. Konttien nimet on pidetty yksiselitteisina, jotta samalla palvelimella voi ajaa muitakin projekteja ilman sekaannusta:

- `webshop-web`
- `webshop-db`
- `webshop-adminer`

### 1. Kloonaa repo

```bash
git clone git@github.com:codenamey/webshop.git
cd webshop
```

Jos SSH ei ole kaytossa, voit kloonata myos HTTPS-urlilla.

### 2. Luo paikallinen `.env`

```bash
cp .env.example .env
```

Windows PowerShellissa voit tarvittaessa kayttaa:

```powershell
Copy-Item .env.example .env
```

Tarvittaessa muuta tiedostosta ainakin:

- `WORDPRESS_PORT`
- `ADMINER_PORT`
- `DB_PORT`
- `WORDPRESS_DB_PASSWORD`
- `MYSQL_ROOT_PASSWORD`

### 3. Luo Dockerin datakansiot

```bash
mkdir -p docker-data/html docker-data/db
```

PowerShellissa:

```powershell
New-Item -ItemType Directory -Force docker-data/html
New-Item -ItemType Directory -Force docker-data/db
```

### 4. Kaynnista Docker-stack

```bash
docker compose up -d
```

WordPress avautuu oletuksena osoitteessa `http://localhost:18080` ja Adminer osoitteessa `http://localhost:18081`.
Tietokanta on tarvittaessa hostilta saavutettavissa portista `13306`.

Tarkista konttien tila:

```bash
docker compose ps
```

### 5. Asenna WordPress selaimessa

Avaa selaimessa:

- `http://localhost:18080`

Tee normaali WordPressin ensiasennus:

1. valitse kieli
2. anna sivuston nimi
3. luo admin-kayttaja nimella `admin`
4. aseta salasanaksi `X*%2Iwz*gXaC%%Bkps`
5. kirjaudu sisaan

Jos ymparisto kaynnistetaan tyhjalla tietokannalla, WordPress-admin luodaan taman wizardin yhteydessa. Tata ei ole tassa vaiheessa automatisoitu tietokanta-importilla, joten ensiasennus tehdaan kasin selaimessa.

### 6. Asenna WooCommerce

WordPressin hallintapaneelissa:

1. mene kohtaan `Plugins`
2. asenna `WooCommerce`
3. aktivoi plugin

Divi ei tule tasta reposta, joten se asennetaan erikseen lisenssin haltijan toimesta.

## Pluginien ja teeman versionhallinta

Kaikkea ei kannata laittaa Git-repoon samalla tavalla.

Suositus:

- omat pluginit ja oma child theme versionhallintaan hakemistoon `wordpress/wp-content/`
- ilmaiset pluginit voi versionhallita, jos haluatte toistettavan setupin
- premium-pluginien lisenssiavaimia ei tallenneta Git-repoon
- premium-pluginien koodi tallennetaan repon sisaan vain jos lisenssiehdot sallivat sen

Kaytannossa:

- lisenssiavaimet lisataan manuaalisesti WordPressin hallintapaneelista paikallisesti ja tuotannossa
- jos plugin tekee asetuksia tietokantaan, ne voidaan jakaa kehittajille SQL-dumpin kautta

## Jaettava tietokantadumppi

Jos haluatte jakaa valmiin lokaaliympariston muille kehittajille ilman etta jokainen asentaa kaikki plugin-asetukset kasin, kayttakaa repoa varten erillista tietokantadumppia.

Hakemisto:

```text
database/init/
```

MariaDB importtaa taman hakemiston `.sql`-tiedostot automaattisesti vain silloin, kun tietokanta on tyhja.

Suositeltu tiedostonimi:

```text
database/init/001-webshop.sql
```

Tama malli toimii hyvin silloin kun haluatte jakaa:

- WooCommerce-asennuksen
- pluginien asetukset
- valmiit WordPress-sivut
- peruskonfiguraation

Mutta huomio:

- lisenssiavaimia ei pideta dumpissa, jos haluatte valttaa niiden jakamisen kaikille
- `uploads`-sisaltoa ei kannata laittaa SQL-dumppiin tai Git-repoon
- dumppi kannattaa paivittaa vain kun haluatte uuden yhteisen lahtotilan

## Tietokannan vienti ja tuonti

Repoon on lisatty apuskriptit:

- `scripts/export-db.sh`
- `scripts/import-db.sh`
- `scripts/export-db.ps1`
- `scripts/import-db.ps1`

### Tee uusi dumppi nykyisesta lokaaliymparistosta

Kun local WordPress on valmiiksi asennettu ja plugin-/sivuasetukset ovat kunnossa:

```bash
set -a
source .env
set +a
./scripts/export-db.sh
```

Windows PowerShellissa:

```powershell
./scripts/export-db.ps1
```

Tama kirjoittaa dumpin oletuksena tiedostoon:

```text
database/init/001-webshop.sql
```

### Ota dumppi kayttoon puhtaaseen lokaaliymparistoon

Jos haluat testata dumpin alusta asti:

```bash
docker compose down
rm -rf docker-data/db/*
docker compose up -d
```

Kun `docker-data/db` on tyhja, MariaDB ajaa automaattisesti kaikki `database/init/*.sql`-tiedostot.

### Tuo dumppi jo kaynnissa olevaan lokaaliin tietokantaan

Jos tietokanta on jo olemassa ja haluat ajaa dumpin kasin:

```bash
set -a
source .env
set +a
./scripts/import-db.sh
```

Windows PowerShellissa:

```powershell
./scripts/import-db.ps1
```

## Tuotantoa vastaava lokaaliymparisto

Jos haluat lokaalisti mahdollisimman lahelle sita tilaa, jossa yhteinen kehitysymparisto nyt on, kayta repossa olevaa tietokantadumppia.

Tama tuo lokaalisti:

- WordPressin perusasennuksen
- WooCommerce-asennuksen
- pluginien asetuksia
- valmiiksi lisattya sisaltoa ja konfiguraatiota
- sen datatilan, jonka viimeisin `database/init/001-webshop.sql` sisaltaa

Tee nain puhtaaseen lokaaliymparistoon:

```bash
cp .env.example .env
mkdir -p docker-data/html docker-data/db
docker compose down
rm -rf docker-data/db/*
docker compose up -d
```

Huomio:

- `database/init/001-webshop.sql` ajetaan automaattisesti vain, jos tietokanta on tyhja
- jos devaajalla on vanha lokaalikanta jo olemassa, automaatti-import ei aja samaa dumppia uudelleen

Jos haluat tuoda repossa olevan dumpin kasin nykyiseen lokaalikantaan:

```bash
set -a
source .env
set +a
./scripts/import-db.sh
```

Windows PowerShellissa:

```powershell
./scripts/import-db.ps1
```

Talla tavalla kehittaja saa ympariston, joka vastaa mahdollisimman lahelle sita yhteista lahtotilaa, johon plugin-asennukset, lisenssit ja asetukset on tallennettu.

## Miten pluginit saadaan tuotantoon

Tuotantoon menee tassa mallissa kaksi eri asiaa:

1. `wp-content`-tiedostot
2. tietokantasisalto

`wp-content` menee jo nykyisella GitHub Actions -deploylla palvelimelle.

Tietokanta ei mene nykyisella pushilla automaattisesti tuotantoon. Se on tarkoituksella erillinen, koska tietokantadeploy on riskisempi kuin tiedostodeploy.

Suositus tuotantoon:

- deployaa teemat ja pluginit Gitilla / Actionsilla
- lisaa lisenssiavaimet tuotannossa manuaalisesti
- vie tietokantamuutokset vain harkitusti, joko WordPressin hallintapaneelin kautta tai erillisella SQL-tuonnilla

Jos haluatte myohemmin automatisoida taman, seuraava askel on erottaa:

- `dumppi` kehittajille
- `migraatio` tuotannolle

Niita ei kannata sotkea yhdeksi samaksi dumpiksi.

## Mista kehitystiedostot loytyvat

Versionhallittu WordPress-sisalto on hakemistossa:

```text
wordpress/wp-content/
```

Sinne kuuluvat esimerkiksi:

- `themes/`
- `plugins/`
- `mu-plugins/`

Ajatus on se, etta:

- WordPressin core tulee Docker-imagesta
- tietokanta elaa paikallisessa Docker-datassa
- oma kehitys tapahtuu `wp-content`-hakemiston alla

## Tyypillinen paikallinen kehityskierros

1. Kaynnista stack komennolla `docker compose up -d`
2. Tee muutokset teemaan tai pluginiin hakemistossa `wordpress/wp-content/`
3. Paivita selaimessa sivu
4. Tarkista tarvittaessa lokit

PHP-, CSS-, JS- ja teematiedostojen muutokset eivat normaalisti vaadi Dockerin restarttia.

## Hyodylliset komennot

Kaynnista ymparisto:

```bash
docker compose up -d
```

Pysayta ymparisto:

```bash
docker compose down
```

Nayta konttien tila:

```bash
docker compose ps
```

Katso lokit:

```bash
docker compose logs -f
```

Katso vain WordPress-kontin lokit:

```bash
docker compose logs -f webshop-web
```

Rakentele stack uudestaan muutosten jalkeen:

```bash
docker compose up -d --force-recreate
```

Tata tarvitaan vain jos muutat itse Docker-stackia. Tavalliseen teema- tai pluginikehitykseen sita ei yleensa tarvita.

## Ensimmainen toimiva testi

Yksinkertainen ensitesti paikallisesti:

1. kaynnista stack
2. avaa `http://localhost:18080`
3. asenna WordPress
4. asenna ja aktivoi WooCommerce
5. varmista, etta WordPressin hallintapaneeli ja WooCommerce-valikko avautuvat ilman virhetta
6. varmista, etta `http://localhost:18081` avaa Adminerin

Jos nama toimivat, paikallinen kehitysymparisto on pystyssa.

## Vianhaku

Jos `docker compose up -d` ei kaynnisty:

- varmista, etta Docker Desktop on paalla
- varmista, ettei portti `18080`, `18081` tai `13306` ole jo kaytossa
- tarkista lokit komennolla `docker compose logs -f`

Jos WordPress ei yhdista tietokantaan:

- tarkista `.env`-arvot
- tarkista, etta `webshop-db` on kaynnissa
- odota hetki ja paivita sivu, koska MariaDB voi kaynnistya hitaammin kuin web-kontti

Jos tiedostomuutokset eivat nay selaimessa:

- tee hard refresh selaimessa
- tarkista, etta muokkasit tiedostoa polussa `wordpress/wp-content/...`
- tarkista, etta mountit ovat voimassa komennolla `docker compose ps`

## Deploy-malli

Deploy ei restarttaa Docker Compose -stackia normaalien teemojen tai pluginien muutosten yhteydessa.

Periaate:

- Docker pitaa WordPressin ja tietokannan kaynnissa palvelimella
- repo deployaa vain `wordpress/wp-content`-hakemiston versionhallittavat tiedostot
- GitHub Actions synkkaa muutokset palvelimelle osoitteeseen `/srv/webshop/app/wp-content`
- konttia ei restartata, koska WordPress lukee teema- ja pluginitiedostot suoraan levyilta

Docker-stackin ja palvelimen infra-muutokset hoidetaan erillisena toimenpiteena, ei sisaltodeployna.

## Palvelinrakenne

Suositeltu rakenne palvelimella:

```text
/srv/webshop/
  stack/         docker-compose.yml, .env ja mahdolliset infrafilet
  app/
    wp-content/  deployattavat teemat, pluginit ja muu versionhallittu sisalto
  data/          tietokanta ja muu pysyva runtime-data
```

## GitHub Actions salaisuudet

Deploy-workflow odottaa seuraavaa salaisuutta:

- `WEBSHOP_DEPLOY_KEY` = yksityinen SSH-avain, jolla GitHub Actions paasee palvelimelle

Jos kaytatte eri deploy-kayttajaa kuin `root`, vaihda workflowssa kohdeyhteys vastaamaan sita.
