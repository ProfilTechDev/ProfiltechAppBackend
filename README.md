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
Kopier indholdet fra `.env.example`, og opret en ny fil ved navn `.env`. 


### 4. Composer install
Vær sikker på composer er installeret på din pc og tilgængelig.
Herefter skal du kører composer install og hvis der skal bruges en token. Klik på linket som står i teksten og giv adgang til alt

```bash
composer install
```


### 5. Migrer database
Først skal du være sikker på at mysql er installeret på din pc.

> **Bemærk:** Hvis du er på windows skal du være sikker på at mysql og php er tilgængelig der hvor din projekt ligger. Bruger du xampp, skal den ligge i den rigtige mappe. Bruger du WSL skal du installere mysql og PHP på din WSL maskine.

Tjek om mysql er installeret:

```bash
mysql -v
```

Kør nu denne kommando til at migrere database tabellerne

```bash
php artisan migrate
```

### 6. Start laravel Api
Kør artisan kommando for at starte applikationen på localhost port 8000. 
Det er vigitgt at denne port bruges og du skal derfor være sikker på der ikke er andet der kører.

```bash
php artisan serve
```