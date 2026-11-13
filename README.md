# Event Planner

Application web de gestion d'événements développée avec Laravel. Elle permet de
consulter les événements disponibles, de s'y inscrire et de les administrer
depuis un espace réservé aux administrateurs.

## Fonctionnalités

- Consultation, recherche et filtrage des événements.
- Inscription et désinscription des utilisateurs aux événements.
- Affichage des inscriptions de l'utilisateur connecté.
- Authentification : inscription, connexion, déconnexion et profil.
- Gestion des événements par un administrateur : création, modification et
  suppression.
- Gestion des catégories d'événements.
- Gestion et consultation des inscriptions depuis l'espace d'administration.
- Téléversement et affichage des images associées aux événements.

## Technologies

- PHP 8.2 ou supérieur
- Laravel 12
- Laravel Blade
- SQLite par défaut (MySQL également supporté)
- Vite
- Tailwind CSS 4
- Node.js et npm
- Composer

## Installation

### 1. Cloner le projet

```bash
git clone <url-du-depot>
cd Event_Planner
```

### 2. Installer les dépendances

```bash
composer install
npm install
```

### 3. Configurer l'environnement

Copier le fichier d'environnement fourni :

```bash
cp .env.example .env
php artisan key:generate
```

Sous Windows PowerShell, la copie peut être effectuée avec :

```powershell
Copy-Item .env.example .env
```

### 4. Configurer la base de données

La configuration fournie utilise SQLite. Créer le fichier si nécessaire :

```bash
touch database/database.sqlite
```

Sous Windows PowerShell :

```powershell
New-Item database/database.sqlite -ItemType File
```

Vérifier ensuite que `.env` contient :

```dotenv
DB_CONNECTION=sqlite
```

Pour utiliser MySQL, remplacer cette configuration par les paramètres de votre
base de données :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_planner
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Préparer la base et les données de démonstration

```bash
php artisan migrate --seed
php artisan storage:link
```

Le seeder crée un compte administrateur et plusieurs événements de démonstration.

## Lancement en développement

Lancer le serveur Laravel :

```bash
php artisan serve
```

Dans un second terminal, lancer Vite :

```bash
npm run dev
```

L'application est ensuite accessible à l'adresse
[http://localhost:8000](http://localhost:8000).

Il est également possible d'utiliser le script de développement Laravel :

```bash
composer run dev
```

## Compte administrateur de démonstration

Après l'exécution du seeder :

- **Email :** `admin@event.local`
- **Mot de passe :** `admin123`

Ce compte est destiné au développement et doit être remplacé ou supprimé dans
un environnement de production.

## Tests

Exécuter la suite de tests Laravel avec :

```bash
php artisan test
```

## Structure principale

```text
app/
├── Http/Controllers/    Contrôleurs de l'application
├── Http/Middleware/     Middleware d'authentification et d'administration
├── Models/              Modèles User, Event, Category et Registration
└── View/                View composers
database/
├── migrations/          Schéma de la base de données
└── seeders/             Données initiales
resources/
├── css/                 Styles Tailwind
├── js/                  Point d'entrée JavaScript
└── views/               Vues Blade
routes/
└── web.php              Routes web de l'application
```

## Commandes utiles

```bash
php artisan route:list       # Afficher les routes
php artisan migrate:fresh --seed
php artisan config:clear
php artisan cache:clear
npm run build               # Générer les assets de production
```

## Sécurité

Ne jamais versionner le fichier `.env` ni y placer des mots de passe réels.
Utiliser des identifiants différents pour la production et désactiver
`APP_DEBUG` avant tout déploiement.

## Licence

Ce projet est distribué sous licence MIT.
