# 🚀 To-Do List - Symfony Project  

## 📌 Prérequis  
Avant d'exécuter le projet, assurez-vous d'avoir installé :  
- **PHP** (≥ 8.0)  
- **Composer**  
- **Symfony CLI**  
- **Docker & Docker Compose**  
- **MySQL** ou un autre gestionnaire de base de données compatible  

---

## ⚙️ Installation & Exécution  

1️⃣ **Cloner le projet**  
git clone https://github.com/emnaghar09/taskList-APP.git
cd taskList-APP
 

2️⃣ **Installer les dépendances PHP**  
composer install
 

3️⃣ **Créer la base de données**  
symfony console doctrine:database:create
 

4️⃣ **Générer et exécuter les migrations**  
symfony console make:migration  
symfony console doctrine:migrations:migrate
 

5️⃣ **Construire et démarrer les conteneurs Docker**  
docker-compose up -d --build
 

6️⃣ **Installer le serveur Symfony si nécessaire**  
composer require symfony/web-server-bundle
 

7️⃣ **Lancer le serveur**  
symfony server:start
 
🔹 **OU**, si vous ne voulez pas utiliser le serveur Symfony :  
php -S 127.0.0.1:8000 -t public
 

---

## 🛠 Outils intégrés  
- **Symfony Messenger** pour la gestion des files d'attente (RabbitMQ)  
- **Doctrine** pour l'ORM  
- **Docker** pour la gestion des services (RabbitMQ, MySQL...)  

📌 Une fois le serveur démarré, accédez au projet via :  
➡️ `http://127.0.0.1:8000`

---

## 🐳 🔧 Gestion de Docker  

✅ **Vérifier que tous les conteneurs tournent**  
docker ps
 

✅ **Arrêter les conteneurs Docker**  
docker-compose down
 

✅ **Rebuilder les conteneurs si nécessaire**  
docker-compose up -d --build
 

---

**🎯 Votre projet est maintenant prêt à être utilisé !** 🚀  

---