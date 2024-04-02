# Projet GSB Medecins : Gestion de visites de commerciaux médicaux.

# Pour lancer l'application :

=> Installer Docker 

# Attention si docker-compose n'a été installé via un manager de package la commande peut devenir docker compose au lieu de docker-compose

"cd" dans le repertoire racine

Entrez dans votre terminal "docker-compose up --build" si premier lancement ou enlever le flag --build sinon afin de consever les données ajoutées

# L'application devrait être accessible sur localhost:4400

Pour tester l'application, utilisez un des profil visiteurs établi.

Pour arrêter l'application, il suffit de taper :

"docker-compose down", utilisez le flag -v pour supprimer les container (Le prochain lancement sera plus long et les données existante seront effacées)
