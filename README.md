# Base Installation

1. Clone the following (https://github.com/PsiTwin/LearningSymfony.git)

```git
git clone https://github.com/PsiTwin/LearningSymfony.git
```

2. Navigate into the project directory you just cloned:

```console
cd LearningSymfony
```

3. Create the containers.

```console
docker-compose up -d
```

4. Start a shell session inside the container environment and install the dependencies.

```console
docker-compose exec php bash
composer install
```

5. Create db by migrations
```console
php bin/console doctrine:migrations:migrate
```

6. For JWT Auth need to generate private and public keys
```console
php bin/console lexik:jwt:generate-keypair
```
