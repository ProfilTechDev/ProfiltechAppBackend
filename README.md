# Profiltech App Backend

Dette er backend-applikationen til Profiltech. Applikationen er baseret på Docker, Laravel og Nginx for en moderne og effektiv udviklingsoplevelse.

## Kom godt i gang

Følg disse trin for at opsætte et lokalt udviklingsmiljø:

### 1. Klon repositoriet
Klon projektet fra GitHub ved at bruge en git-klient eller kør følgende kommando i terminalen:

```bash
git clone https://github.com/mkieler/ProfiltechAppBackend.git
```

### 2. Naviger til projektmappen
Efter kloning skal du åbne projektmappen i terminalen:

```bash
cd ProfiltechAppBackend
```

### 3. Opret en .env-fil
Kopier indholdet fra `.env.example`, og opret en ny fil ved navn `.env`. Derefter skal du udfylde de nødvendige variabler:

```env
APP_URL=http://localhost
APP_PORT=[Ønsket udviklingsport]:80
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ProfiltechApp
DB_USERNAME=dbuser
DB_PASSWORD=
```

> **Bemærk:** root ikke kan blive brugt som DB_USERNAME. Dette vil resultere i genstart loop af mysql serveren
Gem filen, når du er færdig.

### 4. Start Docker-containeren
Start projektets Docker-container ved at køre følgende kommando:

```bash
docker compose up
```

> **Bemærk:** Første gang du kører denne kommando, vil det tage lidt tid, da alle dependencies installeres. Efterfølgende starter containeren hurtigere.

### 5. Gå ind i app-containeren
Når containeren kører, skal du tilgå app-containeren med denne kommando:

```bash
docker compose exec app bash
```

### 6. Installer PHP-dependencies
Kør følgende kommando i containeren for at installere projektets dependencies:

```bash
composer install
```

### 7. Lav en app key
Generer nødvendig app key

```bash
php artisan key:generate
```

### 8. Migrer databasen
Udfør database-migreringer for at opsætte de nødvendige tabeller:

```bash
php artisan migrate
```

### 9. Projektet er nu klar
Efter ovenstående trin er din applikation klar til brug på den konfigurerede URL.

---

## Yderligere Ressourcer

- [Laravel Dokumentation](https://laravel.com/docs)
- [Docker Dokumentation](https://docs.docker.com)
- [Nginx Dokumentation](https://nginx.org/en/docs/)

Hvis du støder på problemer, er du velkommen til at oprette en issue i projektets repository.
