# Le projet a quasiment été réalisé complètement. Mon manque de connaissance en Symfony comme annoncé lors du premier entretien m'a légèrement freiné, devant apprendre à utiliser le framework tout en avancant le projet. Je n'ai malheureusement pas pu faire les Test unitaires, n'en ayant malheureusement jamais fait et m'étant fixé une date limite assez courte afin de ne pas trop vous faire attendre. Il manque également seulement le dernier point qui était de créer une commande afin d'exporter le fichier CSV, commande dans laquelle je n'ai malheureusement pas réussit à injecter mon controller après mintes recherches.

# J'espère avoir pu vous montrer ma motivation à en apprendre d'avantage sur Symfony et pouvoir le faire au sein de votre entreprise.

# Ne pas oublier de lancer ces commandes dans le terminal afin d'installer les dépendances et la BDD :

# composer require symfony/orm-pack

# composer require --dev symfony/maker-bundle

# php bin/console doctrine:database:create

# php bin/console make:migration

# php bin/console doctrine:migrations:migrate

# A l'aide d'un outil de simulation de requêtes tel que postman, nous pouvons créer un questionnaire, grâce à la route localhost:8000/qa, de la forme :

# "title": "test",

# "promoted": false,

# "status": "projet",

# "answers": ["test", "bot"]

# De la même façon, nous pouvons update un questionnaire, grâce à la route localhost:8000/qa/{id}, de la forme :

# "title": "test7",

# "status": "publié"

# Et ensuite, nous pouvons récuperer un CSV de tout l'historique des update faites au préalables, grâce à la route localhost:8000/csv.
